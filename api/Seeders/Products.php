<?php
require 'Seed.php';
require MODELS."ProductModel.php";

$faker = Faker\Factory::create();

for($i = 0; $i < 20; $i++) {
    $random = [2, 3 , 4];
    $price = array_rand($random);
    $gender = ['M', 'F', 'U'];
    $categories = [1, 2, 3];
    $genderValue = $gender[$price];
    $categoryValue = $categories[$price];
    
    $data = array(
        "barcode" => $faker->ean13,
        "description" => $faker->sentence(2),
        "info" => substr("Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis impedit, quibusdam nam in minima iure nemo aspernatur unde eaque asperiores, quo, similique porro odit quidem eius praesentium! Consequatur, cupiditate at?", 0, 50),
        "price" => $faker->randomNumber($random[$price]),
        "picture" => $faker->imageUrl(800, 400, 'sports', true, 'Faker'),
        "category_id" => $categories[$price],
        "gender" => $gender[$price]
    );

    $ProductModel->create($data);
}
?>