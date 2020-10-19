<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusesSeeder extends Seeder
{
    private const STATUSES = [
        ['title' => 'backlog'],
        ['title' => 'development'],
        ['title' => 'done'],
        ['title' => 'review']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::truncate();
        TaskStatus::insert(self::STATUSES);
    }
}
