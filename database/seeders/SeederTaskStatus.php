<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * model
 */
use App\Models\TaskStatus;

class SeederTaskStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TaskStatus::create([
            'name'  => 'Done'
        ]);

        TaskStatus::create([
            'name'  => 'In-Progress'
        ]);

        TaskStatus::create([
            'name'  => 'TO-DO'
        ]);
    }
}
