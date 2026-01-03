<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Modern Villa in Downtown',
                'number' => 'PROP001',
                'property_type' => 'Villa',
                'location' => 'Downtown',
                'area' => '350',
                'status' => 'Available',
                'description' => 'A stunning modern villa with 4 bedrooms and 3 bathrooms',
                'price' => 500000,
                'land_situation' => 'Urban',
            ],
            [
                'name' => 'Luxury Apartment',
                'number' => 'PROP002',
                'property_type' => 'Apartment',
                'location' => 'Waterfront',
                'area' => '200',
                'status' => 'Available',
                'description' => 'Modern apartment with sea view and premium amenities',
                'price' => 250000,
                'land_situation' => 'Urban',
            ],
            [
                'name' => 'Cozy Apartment for Rent',
                'number' => 'PROP003',
                'property_type' => 'Apartment',
                'location' => 'Residential Area',
                'area' => '120',
                'status' => 'Available',
                'description' => 'Comfortable 2-bedroom apartment in a quiet neighborhood',
                'price' => 1200,
                'land_situation' => 'Urban',
            ],
            [
                'name' => 'Commercial Space',
                'number' => 'PROP004',
                'property_type' => 'Commercial',
                'location' => 'Business District',
                'area' => '500',
                'status' => 'Available',
                'description' => 'Prime commercial space for retail or office',
                'price' => 800000,
                'land_situation' => 'Urban',
            ],
            [
                'name' => 'Land Plot',
                'number' => 'PROP005',
                'property_type' => 'Land',
                'location' => 'Suburban Area',
                'area' => '1000',
                'status' => 'Available',
                'description' => 'Beautiful land plot ready for development',
                'price' => 150000,
                'land_situation' => 'Rural',
            ],
        ];

        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }
    }
}
