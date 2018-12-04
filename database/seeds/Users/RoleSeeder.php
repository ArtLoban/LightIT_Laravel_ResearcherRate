<?php

use App\Models\Users\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert($this->getTableData());
    }

    /**
     * @return array
     */
    private function getTableData(): array
    {
        return [
            ['id' => Role::USER ,'name' => 'User'],
            ['id' => Role::SENIOR_ADMIN ,'name' => 'Senior Admin'],
            ['id' => Role::SUPER_ADMIN ,'name' => 'Super Admin'],
            ['id' => Role::ADMIN ,'name' => 'Admin'],
        ];
    }
}
