<?php

use App\Models\Organization\Employees\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    static $userPrimaryKey = 4;

    return [
        'user_id' => $userPrimaryKey++,
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'patronymic' => 'Ivanovich',
        'birth_date' => $faker->date('Y-m-d', '-20 years'),
        'position_id' => mt_rand(1, 6),
        'ac_degree_id' => mt_rand(1, 2),
        'ac_title_id' => mt_rand(1, 2),
        'department_id' => mt_rand(1, 10),
    ];
});
