<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('practice_areas')->insert([
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/corporate.png',
                'title_id' => 'Hukum Korporasi',
                'title_en' => 'Corporate Law',
                'description_id' => 'Layanan hukum dalam bidang korporasi.',
                'description_en' => 'Legal services in corporate law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/ip.png',
                'title_id' => 'Hak Kekayaan Intelektual',
                'title_en' => 'Intellectual Property',
                'description_id' => 'Layanan hukum HKI.',
                'description_en' => 'Intellectual property legal services.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'practice/commercial.png',
                'title_id' => 'Hukum Komersial',
                'title_en' => 'Commercial Law',
                'description_id' => 'Layanan hukum dalam bidang komersial.',
                'description_en' => 'Legal services in commercial law.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
