<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PracticeAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'id' => Str::uuid(),
                'image' => 'services/contract.png',
                'title_id' => 'Penyusunan & Finalisasi Kontrak',
                'title_en' => 'Contract Drafting & Finalisation',
                'description_id' => 'Layanan penyusunan dan finalisasi kontrak secara profesional.',
                'description_en' => 'Professional contract drafting and finalisation service.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'services/advice.png',
                'title_id' => 'Nasihat Rutin & Retainer',
                'title_en' => 'Regular Advice & Retainership',
                'description_id' => 'Memberikan nasihat hukum rutin dan retainer untuk bisnis Anda.',
                'description_en' => 'Providing regular legal advice and retainership for your business.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'image' => 'services/consultation.png',
                'title_id' => 'Konsultasi & Pendapat Hukum',
                'title_en' => 'Consultation & Opinion',
                'description_id' => 'Memberikan konsultasi dan pendapat hukum.',
                'description_en' => 'Providing legal consultation and opinion.',
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
