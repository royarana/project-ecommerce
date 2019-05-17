<?php
require 'Seed.php';
require MODELS."UserModel.php";

$faker = Faker\Factory::create();
$gender = ['M', 'F'];
for($i = 0; $i < 2; $i++) {
    $data = array(
        "email" => $faker->freeEmail,
        "full_name" => $faker->sentence(3),
        "birthday" => '1995-01-01',
        "gender" => $gender[array_rand($gender, 1)],
        "password" => sha1('password')
    );
    
    $UserModel->create($data);
}
?>