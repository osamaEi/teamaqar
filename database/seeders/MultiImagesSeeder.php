<?php

namespace Database\Seeders;

use App\Models\MultiImages;
use App\Models\Property;
use Illuminate\Database\Seeder;

class MultiImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();

        $images = [
            'property1_1.jpg',
            'property1_2.jpg',
            'property1_3.jpg',
            'property2_1.jpg',
            'property2_2.jpg',
            'property3_1.jpg',
            'property3_2.jpg',
            'property4_1.jpg',
            'property4_2.jpg',
            'property5_1.jpg',
        ];

        foreach ($properties as $index => $property) {
            for ($i = 0; $i < 2; $i++) {
                MultiImages::create([
                    'propery_id' => $property->id,
                    'images' => $images[($index * 2 + $i) % count($images)],
                ]);
            }
        }
    }
}
