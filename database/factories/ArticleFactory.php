<?php

use Faker\Generator as Faker;
use App\Models\Publications\Articles\Article;
use App\Utilities\LanguageRepository\Contracts\Repository as LanguageRepository;

$languageRepository = app(LanguageRepository::class );

$factory->define(Article::class, function (Faker $faker) use($languageRepository) {
    static $userPrimaryKey = UserSeeder::MIN_FAKE_RANDOM;
    $pageFrom = mt_rand(5, 150);
    $pageTo = $pageFrom + mt_rand(2, 10);
    $languages = $languageRepository->all();

    return [
        'name' => $faker->sentence(6, true),
        'journal_id' => mt_rand(1, 11),
        'publication_type_id' => mt_rand(1, 2),
        'journal_number' => $faker->numberBetween(1, 12),
        'year' => $faker->numberBetween(2010, 2018),
        'pages' => $pageFrom . '-' . $pageTo,
        'language' => $faker->randomElement($languages),
        'description' => $faker->text($maxNbChars = 200),
        'user_id' => $faker->numberBetween($userPrimaryKey, UserSeeder::FAKE_USERS),
    ];
});
