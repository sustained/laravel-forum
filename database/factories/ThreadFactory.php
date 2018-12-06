<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'author_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
