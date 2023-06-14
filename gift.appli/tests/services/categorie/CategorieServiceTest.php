<?php
declare(strict_types=1);

namespace gift\test\services\categorie;

use Faker\Factory;
use gift\app\models\Categorie;
use gift\app\services\categories\CategoriesServices;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;

final class CategorieServiceTest extends TestCase
{
    private static array $categories = [];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $db = new DB();
        $db->addConnection(parse_ini_file(__DIR__ . '/../../../src/conf/db.test.conf.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
        $faker = Factory::create('fr_FR');

        $c1 = Categorie::create([
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3)
        ]);
        $c2 = Categorie::create([
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(4)
        ]);
        self::$categories = [$c1, $c2];
    }

    public static function tearDownAfterClass(): void
    {
        foreach (self::$categories as $c) {
            $c->delete();
        }

    }

    public function testgetCategories(): void
    {

        $categService = new CategoriesServices();
        $categories = $categService->getCategories();

        $this->assertEquals(count(self::$categories), count($categories));
        $this->assertEquals(self::$categories[0]['id'], $categories[0]['id']);
        $this->assertEquals(self::$categories[0]['libelle'], $categories[0]['libelle']);
        $this->assertEquals(self::$categories[0]['description'], $categories[0]['description']);
        $this->assertEquals(self::$categories[1]['libelle'], $categories[1]['libelle']);
        $this->assertEquals(self::$categories[1]['description'], $categories[1]['description']);
        $this->assertEquals(self::$categories[1]['id'], $categories[1]['id']);
    }

    public function testgetCategoriesById(): void
    {

        $categService = new CategoriesServices();
        $categorie = $categService->getCategoriesById(self::$categories[0]['id']);

        $this->assertEquals(self::$categories[0]['id'], $categorie['id']);
        $this->assertEquals(self::$categories[0]['libelle'], $categorie['libelle']);
        $this->assertEquals(self::$categories[0]['description'], $categorie['description']);

        $this->expectException(\gift\app\services\prestations\PrestationServiceNotFoundException::class);
        $categService->getCategoriesById(-1);
    }

}