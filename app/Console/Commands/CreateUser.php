<?php

namespace App\Console\Commands;

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUser extends Command
{
    protected $signature = 'role:create-user';
    protected $description = 'Create user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $name = $this->ask('name');
        $email = $this->ask('email');
        $password = $this->ask('password');

        try {
            User::factory()->create(['name' => $name, 'email' => $email, 'password' => $password]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}

