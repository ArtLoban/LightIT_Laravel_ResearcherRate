<?php

use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     *
     */
    const FAKE_USERS = 27;

    /**
     * Previous 3 are the custom users
     */
    const MIN_FAKE_RANDOM = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getTableData());
        factory(User::class, self::FAKE_USERS)->create();
    }

    /**
     * @return array
     */
    private function getTableData(): array
    {
        return [
            [
                'email' => 'user@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::USER,
                'remember_token' => str_random(10)
            ],
            [
                'email' => 'senior_admin@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::SENIOR_ADMIN,
                'remember_token' => str_random(10)
            ],
            [
                'email' => 'super_admin@mail.com',
                'password' => bcrypt(111111),
                'role_id' => Role::SUPER_ADMIN,
                'remember_token' => str_random(10)
            ],
        ];
    }
}
