<?php
require 'Seed.php';
require MODELS."ProductModel.php";

$faker = Faker\Factory::create();

for($i = 0; $i < 20; $i++) {
    $random = [2, 3 , 4];
    $price = array_rand($random);

    $data = array(
        "barcode" => $faker->ean13,
        "description" => $faker->sentence(2),
        "price" => $faker->randomNumber($random[$price]),
        "picture" => $faker->imageUrl(800, 400, 'sports', true, 'Faker')
    );

    $ProductModel->create($data);
}
?>