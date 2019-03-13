<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = App\User::select('_id')->get()->toArray();
      //$catgIds = App\Category::select('_id')->get()->toArray();
        factory(App\Post::class, 5)->create(['userId' => $userIds]);
    }
}
