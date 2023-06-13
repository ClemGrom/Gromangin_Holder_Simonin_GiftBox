<?php
declare(strict_types=1);

namespace gift\test\services\box;

use Faker\Factory;
use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\services\box\BoxServices;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;

final class BoxServiceTest extends TestCase
{
    private static array $boxes = [];
    private static array $prestations = [];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $db = new DB();
        $db->addConnection(parse_ini_file(__DIR__ . '/../../../src/conf/db.test.conf.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
        $faker = Factory::create('fr_FR');

        $b1 = Box::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),
            'tarif' => $faker->randomFloat(2, 20, 200),
            'unite' => $faker->numberBetween(1, 3),
            'token' => $faker->uuid()
        ]);
        $b2 = Box::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),
            'tarif' => $faker->randomFloat(2, 20, 200),
            'unite' => $faker->numberBetween(1, 3),
            'token' => $faker->uuid()
        ]);
        $b3 = new Box();


        self::$boxes = [$b1, $b2, $b3, $b1];

        for ($i = 1; $i <= 4; $i++) {
            $p1 = Prestation::create([
                'id' => $faker->uuid(),
                'libelle' => $faker->word(),
                'description' => $faker->paragraph(3),
                'tarif' => $faker->randomFloat(2, 20, 200),
                'unite' => $faker->numberBetween(1, 3)
            ]);
            array_push(self::$prestations, $p1);
        }

        self::$boxes[3]->prestations()->attach(self::$prestations[0], ['quantite' => 1]);
        self::$boxes[3]->save();
        self::$boxes[3]->prestations()->attach(self::$prestations[1], ['quantite' => 2]);
        self::$boxes[3]->save();
    }

    public static function tearDownAfterClass(): void
    {
        foreach (self::$boxes as $b) {
            $b->delete();
        }
        foreach (self::$prestations as $p) {
            $p->delete();
        }
    }

    public function testCreationBoxVide(): void
    {
        $bs = new Box();

        $this->assertEquals(self::$boxes[2], $bs);

    }

    public function testGetBox(): void
    {
        $bs = new BoxServices();
        $b0 = $bs->getBox(self::$boxes[0]->id);
        $b1 = $bs->getBox(self::$boxes[1]->id);
        $b2 = $bs->getBox(self::$boxes[2]->id);
        $this->assertEquals(self::$boxes[0]->toArray(), $b0);
        $this->assertEquals(self::$boxes[1]->toArray(), $b1);
        $this->assertEquals(self::$boxes[2]->toArray(), $b2);
    }

    public function testaddPrestationToBox(): void
    {
        $bs = new BoxServices();
        $ps = new PrestationsServices();
        $ba = $bs->getBox(self::$boxes[1]->id);
        $b0 = Box::create([
            'id' => $ba['id'],
            'libelle' => $ba['libelle'],
            'description' => $ba['description'],
            'tarif' => $ba['tarif'],
            'unite' => $ba['unite'],
            'token' => $ba['token']
        ]);
        $b0->prestations()->attach(self::$prestations[0], ['quantite' => 1]);
        $b0->save();
        $b0->prestations()->attach(self::$prestations[1], ['quantite' => 2]);
        $b0->save();

        $this->assertEquals(self::$boxes[1], $b0);
    }




}