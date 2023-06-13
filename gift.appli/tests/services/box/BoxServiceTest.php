<?php
declare(strict_types=1);

namespace gift\test\services\coffret;

use Faker\Factory;
use gift\app\models\Categorie;
use gift\app\models\Prestation;
use gift\app\services\box\BoxServices;
use \PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as DB ;

final class BoxServiceTest extends TestCase {

    private static array $prestations  = [];
    private static array $categories = [];
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $db = new DB();
        $db->addConnection(parse_ini_file(__DIR__ . '/../../../src/conf/db.test.conf.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
        $faker = Factory::create('fr_FR');

        $c1= Categorie::create([
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3)
        ]);
        $c2=Categorie::create([
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(4)
        ]);
        self::$categories= [$c1, $c2];

        for ($i=1; $i<=4; $i++) {
            $p=Prestation::create([
                'id' => $faker->uuid(),
                'libelle' => $faker->word(),
                'description' => $faker->paragraph(3),
                'tarif' => $faker->randomFloat(2, 20, 200),
                'unite' => $faker->numberBetween(1, 3)
            ]);
            array_push(self::$prestations, $p);
        }

        self::$prestations[0]->categorie()->associate($c1); self::$prestations[0]->save();
        self::$prestations[1]->categorie()->associate($c1); self::$prestations[1]->save();
        self::$prestations[2]->categorie()->associate($c2); self::$prestations[2]->save();
        self::$prestations[3]->categorie()->associate($c2); self::$prestations[3]->save();

    }

    public static function tearDownAfterClass(): void
    {
        foreach (self::$categories as $c) {
            $c->delete();
        }
        foreach (self::$prestations as $prestation) {
            $prestation->delete();
        }
    }

    public function testGetBoxByID() {
        $bs = new BoxServices();
        $box = $bs->getBoxByID("1");
    }

}



