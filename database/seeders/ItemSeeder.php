<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\item_table;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        item_table::create([
            'item_name' => 'dragon1',
            'price' => 20,
            'description' => '3d dragon1',
            'added_date' => '4/23/2024',
            'image' => 'dragon1.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon2',
            'price' => 30,
            'description' => '3d dragon2',
            'added_date' => '4/23/2024',
            'image' => 'dragon2.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon3',
            'price' => 40,
            'description' => '3d dragon3',
            'added_date' => '4/23/2024',
            'image' => 'dragon3.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon1',
            'price' => 20,
            'description' => '3d dragon1',
            'added_date' => '4/23/2024',
            'image' => 'dragon1.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon2',
            'price' => 30,
            'description' => '3d dragon2',
            'added_date' => '4/23/2024',
            'image' => 'dragon2.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon3',
            'price' => 40,
            'description' => '3d dragon3',
            'added_date' => '4/23/2024',
            'image' => 'dragon3.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon1',
            'price' => 20,
            'description' => '3d dragon1',
            'added_date' => '4/23/2024',
            'image' => 'dragon1.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon2',
            'price' => 30,
            'description' => '3d dragon2',
            'added_date' => '4/23/2024',
            'image' => 'dragon2.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon3',
            'price' => 40,
            'description' => '3d dragon3',
            'added_date' => '4/23/2024',
            'image' => 'dragon3.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon1',
            'price' => 20,
            'description' => '3d dragon1',
            'added_date' => '4/23/2024',
            'image' => 'dragon1.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon2',
            'price' => 30,
            'description' => '3d dragon2',
            'added_date' => '4/23/2024',
            'image' => 'dragon2.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);

        item_table::create([
            'item_name' => 'dragon3',
            'price' => 40,
            'description' => '3d dragon3',
            'added_date' => '4/23/2024',
            'image' => 'dragon3.jpg',
            'file' => 'female head.blend',
            'status' => 'available'
        ]);
    }
}
