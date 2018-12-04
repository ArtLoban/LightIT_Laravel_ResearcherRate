<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository as ConfigRepository;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $publicationTypesData = $configRepository->get('Publications.publication_types');

        if ($publicationTypesData && is_array($publicationTypesData)) {
            $transformedData = $this->transform($publicationTypesData);

            DB::table('publication_types')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $publicationTypes): array
    {
        $result = [];

        foreach ($publicationTypes as $publicationType) {
            $result[] = ['name' => $publicationType];
        }

        return $result;
    }
}
