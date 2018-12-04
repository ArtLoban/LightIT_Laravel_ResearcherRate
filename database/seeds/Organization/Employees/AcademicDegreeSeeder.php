<?php

use Illuminate\Database\Seeder;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Facades\DB;

class AcademicDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $academicDegreeData = $configRepository->get('Organization.Employees.academic_degrees');

        if ($academicDegreeData && is_array($academicDegreeData)) {
            $transformedData = $this->transform($academicDegreeData);

            DB::table('academic_degrees')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $academicDegrees): array
    {
        $result = [];

        foreach ($academicDegrees as $academicDegree) {
            $result[] = ['name' => $academicDegree];
        }

        return $result;
    }
}
