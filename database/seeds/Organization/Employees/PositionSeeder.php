<?php

use Illuminate\Database\Seeder;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $positionData = $configRepository->get('Organization.Employees.positions');

        if ($positionData && is_array($positionData)) {
            $transformedData = $this->transform($positionData);

            DB::table('positions')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $positions): array
    {
        $result = [];

        foreach ($positions as $position) {
            $result[] = ['name' => $position];
        }

        return $result;
    }
}
