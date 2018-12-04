<?php

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @param ConfigRepository $configRepository
     */
    public function run(ConfigRepository $configRepository)
    {
        $permissionsData = $configRepository->get('Users.permissions');

        if ($permissionsData && is_array($permissionsData)) {
            $transformedData = $this->transform($permissionsData);

            DB::table('permissions')->insert($transformedData);
        }
    }

    /**
     * @param array $permissions
     * @return array
     */
    private function transform(array $permissions): array
    {
        $result = [];
        $primaryKey = 1;

        foreach ($permissions as $permission) {
            $result[] = ['id' => $primaryKey, 'name' => $permission];
            $primaryKey++;
        }

        return $result;
    }
}
