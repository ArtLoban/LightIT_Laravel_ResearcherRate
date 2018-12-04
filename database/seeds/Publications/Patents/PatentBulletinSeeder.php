<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatentBulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patent_bulletins')->insert($this->getTableData());
    }

    /**
     * @return array
     */
    private function getTableData(): array
    {
        return [
            ['week' => 41 ,'year' => 2018, 'date' => '2018.11.14'],
            ['week' => 42 ,'year' => 2018, 'date' => '2018.11.21'],
            ['week' => 43 ,'year' => 2018, 'date' => '2018.11.28'],
        ];
    }
}
