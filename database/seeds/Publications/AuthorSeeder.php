<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\Organization\Employees\Profile\Repository\Contracts\Repository as ProfileRepository;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ProfileRepository $profileRepository)
    {
        $profilesCollection = $profileRepository->all();
        $transformedData = $this->transform($profilesCollection);

        DB::table('authors')->insert($transformedData);
    }

    /**
     * @param Collection $profiles
     * @return array
     */
    private function transform(Collection $profiles): array
    {
        $result = [];

        foreach ($profiles as $profile) {
            $result[] = [
                'name' => $profile->surname . ' ' . $profile->name[0]. '.' . $profile->patronymic[0]. '.',
                'profile_id' => $profile->getKey(),
            ];
        }

        return $result;
    }
}
