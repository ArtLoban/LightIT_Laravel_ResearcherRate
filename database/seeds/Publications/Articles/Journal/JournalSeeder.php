<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository as ConfigRepository;

class JournalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ConfigRepository $configRepository)
    {
        $journalsData = $configRepository->get('Publications.Articles.Journal.journals');

        if ($journalsData && is_array($journalsData)) {
            $transformedData = $this->transform($journalsData);

            DB::table('journals')->insert($transformedData);
        }
    }

    /**
     * @param array $departments
     * @return array
     */
    private function transform(array $journals): array
    {
        $result = [];

        foreach ($journals as $journal) {
            $result[] = [
                'name' => $journal['name'],
                'issn' => $journal['issn'],
                'subject_area' => $journal['subject_area'],
                'journal_type_id' => $journal['journal_type_id'],
            ];
        }

        return $result;
    }
}
