<?php

use Illuminate\Database\Seeder;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $facultiesData = $configRepository->get('Organization.Facility.faculties');

        if ($facultiesData && is_array($facultiesData)) {
            $transformedData = $this->transform($facultiesData);

            DB::table('faculties')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $faculties): array
    {
        $result = [];

        foreach ($faculties as $faculty) {
            $result[] = ['name' => $faculty, 'slug' => 'test_string'];
        }

        return $result;
    }
}
