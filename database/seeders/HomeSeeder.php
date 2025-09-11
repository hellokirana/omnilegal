<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Home;

class HomeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title_id' => 'Layanan & Bidang Praktik Kami',
                'description_id' => 'Kami fokus pada layanan hukum komersial & korporasi dan litigasi komersial.',
                'title_en' => 'Our Services & Practice Areas',
                'description_en' => 'We focus on commercial & corporate legal services and commercial litigation.',
            ],
            [
                'title_id' => 'Mengapa mempercayai kami?',
                'description_id' => 'Sekilas perjalanan kami sejauh ini.',
                'title_en' => 'Why trust us?',
                'description_en' => 'Here’s a glimpse of our journey so far.',
            ],
            [
                'title_id' => 'Kenali Tim Kami',
                'description_id' => 'Bertemu dengan tim profesional kami.',
                'title_en' => 'Meet Our Team',
                'description_en' => 'Meet our professional team.',
            ],
            [
                'title_id' => 'Berita',
                'description_id' => 'Informasi terbaru kami.',
                'title_en' => 'News',
                'description_en' => 'Our latest news.',
            ],
        ];

        foreach ($data as $item) {
            Home::create(array_merge($item, [
                'id' => (string) Str::uuid(),
            ]));
        }
    }
}

