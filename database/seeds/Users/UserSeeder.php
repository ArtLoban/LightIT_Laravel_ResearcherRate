<?php

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
//                'name' => 'Random User Name',
                'email' => 'user@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::USER,
                'remember_token' => str_random(10)
            ],
            [
//                'name' => 'Admin Name',
                'email' => 'admin@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::ADMIN,
                'remember_token' => str_random(10)
            ],
            [
//                'name' => 'Senior Admin Name',
                'email' => 'senior_admin@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::SENIOR_ADMIN,
                'remember_token' => str_random(10)
            ],
            [
//                'name' => 'SuperAdmin Name',
                'email' => 'super_admin@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::SUPER_ADMIN,
                'remember_token' => str_random(10)
            ],

        ]);

        factory(User::class, 3)->create();
    }
}
