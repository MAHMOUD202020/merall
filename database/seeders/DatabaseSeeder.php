<?php

namespace Database\Seeders;

use App\Models\CatBlog;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
//        $this->call(catsDB::class);
//        $this->call(jsonDB::class);
//        $this->call(areasDB::class);
//        $this->call(roleDB::class);

        CatBlog::factory(10)->create();
        Post::factory(200)->create();
    }
}
