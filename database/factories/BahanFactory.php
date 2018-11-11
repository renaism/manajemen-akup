<?php

use Faker\Generator as Faker;

$factory->define(App\Bahan::class, function (Faker $faker) {
    $satuan = array('g', 'kg', 'l', 'sat');
    return [
        'nama' => $faker->firstName,
        'satuan' => $satuan[array_rand($satuan)],
        'stok' => $faker->randomFloat($nbMaxDecimals=2, $min=0, $max=1000)
    ];
});
