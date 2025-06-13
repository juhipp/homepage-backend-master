<?php

namespace App\Console\Commands;

use App\Services\User\UserService;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'create:user';

    protected $description = 'Command description';

    public function handle()
    {
        $user = app(UserService::class)->create([
            'email' => $this->ask('E-Mail'),
            'firstname' => $this->ask('Firstname'),
            'lastname' => $this->ask('Lastname'),
            'password' => $this->secret('Password')
        ]);

        $this->info('User with email "' . $user->email . '" has been created.');
    }
}
