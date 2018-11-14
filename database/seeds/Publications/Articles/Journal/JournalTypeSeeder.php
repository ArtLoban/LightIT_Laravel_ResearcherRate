<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository as ConfigRepository;

class JournalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $journalTypesData = $configRepository->get('Publications.Articles.Journal.journal_types');

        if ($journalTypesData && is_array($journalTypesData)) {
            $transformedData = $this->transform($journalTypesData);

            DB::table('journal_types')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $journalTypes): array
    {
        $result = [];

        foreach ($journalTypes as $journalType) {
            $result[] = ['name' => $journalType];
        }

        return $result;
    }
}
