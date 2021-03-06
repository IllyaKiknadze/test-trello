<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Labels;
use App\Models\User;
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
        User::factory(30)->create();
        Board::factory(5)->create();

        $this->call(ImageTypesSeeder::class);
        $this->call(TaskStatusesSeeder::class);
    }
}
