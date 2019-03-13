<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (
  Faker $faker,
  $userIds = array(),
  // $catgIds = array()
) {

  // dd($userIds[0]["_id"]);

    return [
        'title' => $faker->sentence,
        'body' => $faker->text,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => function ($data) {
          //

          //
          // if ($user === null) {
          //   return 1;
          // }

            // $max = App\User::count();
            $max = sizeof($data['userId']) - 1;


            return $data['userId'][mt_rand(0, $max)]["_id"];
        },
        'category_id' => function () {
          // $max = sizeof($data['catgId']);
          //
          // return $data['catgId'][mt_rand(0, $max)]["_id"];
          $max = 1000;

          return mt_rand(1, $max);
        },
        'cover_image' => 'noimage.jpg',
    ];
});
