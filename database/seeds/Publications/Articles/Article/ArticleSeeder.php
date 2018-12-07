<?php

use Illuminate\Database\Seeder;
use App\Models\Publications\Articles\Article;

class ArticleSeeder extends Seeder
{
    const MIN_AUTHORS_PER_ARTICLE = 1;
    const MAX_AUTHORS_PER_ARTICLE = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 200)->create()->each(function ($article) {
            $article->authors()->attach($this->getRandomSetOfAuthors());;
        });
    }

    /**
     * @return array
     */
    private function getRandomSetOfAuthors(): array
    {
        $quantity = mt_rand(
            self::MIN_AUTHORS_PER_ARTICLE,
            self::MAX_AUTHORS_PER_ARTICLE
        );

        return $authorsIds = $this->getRandomData(1,UserSeeder::FAKE_USERS, $quantity);
    }

    /**
     * @param int $min
     * @param int $max
     * @param int $quantity
     * @return array
     */
    public function getRandomData(int $min, int $max, int $quantity): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);

        return array_slice($numbers, 0, $quantity);
    }
}
