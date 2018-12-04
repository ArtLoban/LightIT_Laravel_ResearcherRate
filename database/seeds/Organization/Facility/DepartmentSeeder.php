<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository as ConfigRepository;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $departmentsData = $configRepository->get('Organization.Facility.departments');

        if ($departmentsData && is_array($departmentsData)) {
            $transformedData = $this->transform($departmentsData);

            DB::table('departments')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $departments): array
    {
        $result = [];

        foreach ($departments as $department) {
            $result[] = ['name' => $department, 'slug' => 'test_string', 'faculty_id' => mt_rand(1,5)];
        }

        return $result;
    }
}
