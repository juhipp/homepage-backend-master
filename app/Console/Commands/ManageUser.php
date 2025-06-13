<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageUser extends Command
{
    protected $signature = 'manage:user';

    protected $description = 'Command description';

    protected User $user;

    public function handle()
    {
        $this->findUser();

        $this->selectAction();
    }

    protected function findUser()
    {
        $email = $this->ask('What is the users email address?');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->warn('No user with that email exists.');
            $this->findUser();
        }

        $this->user = $user;
    }

    protected function selectAction()
    {
        match ($this->choice(
            question: 'What do you want to do?',
            choices: ['Change password', 'Change email'],
        )) {
            'Change password' => $this->changePassword(),
            'Change email' => $this->changeEmail(),
            default => exit(1)
        };

        match ($this->choice(
            question: 'Do you want to perform another action?',
            choices: ['On current user', 'On a different user', 'Exit']
        )) {
            'On current user' => $this->selectAction(),
            'On a different user' => $this->handle(),
            default => exit(0)
        };
    }

    protected function changePassword()
    {
        $password = $this->ask('New password');
        $passwordWdh = $this->ask('Reenter new password');

        if ($password !== $passwordWdh) {
            $this->warn('The inputs don\'t match. Nothing changed.');
            return;
        }

        DB::transaction(function () use ($password) {
            $this->user->update(['password' => Hash::make($password)]);
        });

        $this->info('Password changed.');
    }

    protected function changeEmail()
    {
        $email = $this->ask('New email');
        $emailWdh = $this->ask('Reenter new email');

        if ($email !== $emailWdh) {
            $this->warn('The inputs don\'t match. Nothing changed.');
            return;
        }

        DB::transaction(function () use ($email) {
            $this->user->update(['email' => $email]);
        });

        $this->info('Email changed.');
    }
}
