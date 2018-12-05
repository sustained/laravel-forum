<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'author_id' => function () {
            return factory('App\User')->create()->id;
        },
        'parent_id' => function () {
            return factory('App\Thread')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
