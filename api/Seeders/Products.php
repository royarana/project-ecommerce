<?php

require './../Libraries/Faker-master/src/autoload.php';
require './../core/db.php';

$faker = Faker\Factory::create();

for($i = 0; $i < 20; $i++) {
    $data = array(
        "barcode" => $faker->ean13,
        "description" => $faker->sentence(2)

    );

    print_r($data);
}

?>