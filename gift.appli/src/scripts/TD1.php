<?php

//Box -> id varchar
//Categorie -> id entier auto incremente
//Prestation -> id varchar
//
//Categorie 1 -- * Prestation
//Box * -- * Prestation : Box2Presta -> quantite

declare(strict_types=1);

require "../vendor/autoload.php";

use Cassandra\Uuid;
use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\models\Categorie;
use gift\app\services\Eloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

Eloquent::init("../conf/db.conf.ini");

echo "Question 1 <br>";
foreach (Prestation::all() as $presta) {
    echo $presta->libelle . "<br>";
    echo $presta->description . "<br>";
    echo $presta->tarif . "<br>";
    echo $presta->unite . "<br>";
    echo "-----------------" . "<br>";
}

echo "Question 2 <br>";
foreach (Prestation::with('categorie')->get() as $presta) {
    echo $presta->libelle . "({$presta->categorie->libelle})" . "<br>";
    echo $presta->description . "<br>";
    echo $presta->tarif . "<br>";
    echo $presta->unite . "<br>";
    echo "-----------------" . "<br>";
}

echo "Question 3 <br>";
$categorie = Categorie::find(3);
echo "Libelle : " . $categorie->libelle . "<br><br>";
foreach ($categorie->prestations as $presta) {
    echo $presta->libelle . "<br>";
    echo $presta->description . "<br>";
    echo $presta->tarif . "<br>";
    echo $presta->unite . "<br>";
    echo "-----------------" . "<br>";
}

echo "Question 4 <br>";
try {
    $box = Box::where('id', '=', '360bb4cc-e092-3f00-9eae-774053730cb2')->firstOrFail();
    echo "Libelle : " . $box->libelle . "<br>";
    echo "Description : " . $box->description . "<br>";
    echo "Montant : " . $box->montant . "<br>";
} catch (ModelNotFoundException $e) {
    echo "Box non trouvée";
}

echo "Question 5 <br>";
try {
    $box = Box::with('prestations')->where('id', '=', '360bb4cc-e092-3f00-9eae-774053730cb2')->firstOrFail();
    echo "Libelle : " . $box->libelle . "<br>";
    echo "Description : " . $box->description . "<br>";
    echo "Montant : " . $box->montant . "<br><br>";
    echo "Prestations : <br>";
    foreach ($box->prestations as $presta) {
        echo $presta->libelle . "<br>";
        echo $presta->description . "<br>";
        echo $presta->tarif . "<br>";
        echo $presta->unite . "<br>";
    }
} catch (ModelNotFoundException $e) {
    echo "Box non trouvée";
}

echo "Question 6 <br>";
$box = new Box();
$box->id = "1234567";
$box->token = "1456789";
$box->libelle = "Ajout Box";
$box->description = "Ajout Box";
$box->montant = 100;
$box->save();

$box->prestations()->attach([
    '74af082e-4ed4-4c63-9fd3-602a5349c442' => ['quantite' => 3],
    'b15503a1-9694-485d-a336-874860a3b664' => ['quantite' => 2],
    '4cca8b8e-0244-499b-8247-d217a4bc542d' => ['quantite' => 1],
]);
