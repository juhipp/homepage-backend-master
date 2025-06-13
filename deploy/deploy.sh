#!/bin/bash

source /app/.env
test $APP_ENV == 'production' && APP_ENV='PRODUCTION'
readonly HEAD=$(git rev-parse HEAD | cut -c 1-7)
readonly DEPLOY_TEXT="Deployment of commit $HEAD to $APP_NAME ($APP_ENV)"

log() {
    echo "$(date +%F-%T) $1" >> '/app/storage/logs/deploy.log';
}
fail() {
    local step=$1;
    log "ERROR: $step";
    notify ":scream_cat: $DEPLOY_TEXT failed during step: $step";
    exit 255;
}
notify() {
    local data="{\"text\":\"$1\"}"
    curl -X POST -H 'Content-Type: application/json' --data "$data" "https://chat.fjol-digital.de/hooks/$RC_DEPLOY_HOOK"
}

log 'start deployment'
STEP="ssh key update";       rsync --chmod=D700,F600 -r --exclude /.gitignore /app/deploy/ssh-config/ /var/www/.ssh/ || fail "$STEP"; log "$STEP"
STEP="git pull";             git pull --prune --ff-only || { sleep 5 && git pull --prune --ff-only || fail "$STEP"; }; log "$STEP"
STEP="composer install";     composer install --no-dev || fail "$STEP"; log "$STEP"
STEP="dump-autoload";        composer dump-autoload --optimize --no-dev || fail "$STEP"; log "$STEP"
STEP="migrate";              php artisan migrate --force || fail "$STEP"; log "$STEP"
log 'deployment finished'

notify ":smiley_cat: $DEPLOY_TEXT successful!"
