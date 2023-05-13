<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function process()
    {
        $users = [
            [
                'name'   => 'Administrator',
                'email'  => 'administrator@rabiloo.com',
            ],
            [
                'name'   => 'Trần Tiến Dũng',
                'email'  => 'dungtd@gmail.com',
                'magv' => 123
            ],
        ];

        foreach ($users as $user) {
            $us = User::create([
                'name'              => $user['name'],
                'email'             => $user['email'],
                'email_verified_at' => now(),
                'password'          => Hash::make('a12345678X'),
            ]);
            if ($us->id == 1) {
                $us->assignRole('Administrators');
            } else {
                $us->assignRole('Teachers');
                Teacher::create([
                    'userId' => $us->id,
                    'magv' => $user['magv'],
                    'name' => $user['name']
                ]);
            }
        }
    }
}
