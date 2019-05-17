<?php
require 'Seed.php';
require MODELS."ProductModel.php";

$faker = Faker\Factory::create();

for($i = 0; $i < 20; $i++) {
    $data = array(
        "barcode" => $faker->ean13,
        "description" => $faker->sentence(2),
        "picture" => $faker->imageUrl(800, 400, 'sports', true, 'Faker')
    );

    $ProductModel->create($data);
}
?>