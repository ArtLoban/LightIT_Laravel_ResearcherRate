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
         $this->call([
             RoleSeeder::class,
             PermissionSeeder::class,
             UserSeeder::class,
             PermissionRoleSeeder::class,
             FacultySeeder::class,
             DepartmentSeeder::class,
             AcademicDegreeSeeder::class,
             AcademicTitleSeeder::class,
             PositionSeeder::class,
             ProfileSeeder::class,
             PublicationTypeSeeder::class,
             JournalTypeSeeder::class,
             JournalSeeder::class,
         ]);
    }
}
