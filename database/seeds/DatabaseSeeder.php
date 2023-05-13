<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTable::class);
        $this->call(UsersTable::class);
        $this->call(ClassesTable::class);
        $this->call(StudentTable::class);
        $this->call(CheckedSedTable::class);
    }
}
