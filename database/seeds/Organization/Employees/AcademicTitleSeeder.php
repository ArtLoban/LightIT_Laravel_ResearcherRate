<?php

use Illuminate\Database\Seeder;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Support\Facades\DB;

class AcademicTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $academicTitleData = $configRepository->get('Organization.Employees.academic_titles');

        if ($academicTitleData && is_array($academicTitleData)) {
            $transformedData = $this->transform($academicTitleData);

            DB::table('academic_titles')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $academicTitles): array
    {
        $result = [];

        foreach ($academicTitles as $academicTitle) {
            $result[] = ['name' => $academicTitle];
        }

        return $result;
    }
}
