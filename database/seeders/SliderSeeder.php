<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // misalnya mau isi 5 slider
        for ($i = 1; $i <= 5; $i++) {
            $data = new Slider();
            $data->id = (string) Str::uuid();
            $data->queue = $i;

            // judul & deskripsi ID / EN
            $data->title_id = $faker->sentence(3);
            $data->title_en = $faker->sentence(3);
            $data->description_id = $faker->paragraph();
            $data->description_en = $faker->paragraph();

            // gambar dummy & link
            $data->image = 'slider' . $i . '.jpg'; // atau $faker->imageUrl()
            $data->link = '#';

            // caption link
            $data->link_caption_id = 'Selengkapnya';
            $data->link_caption_en = 'Read More';

            // status aktif
            $data->status = 1;

            $data->save();
        }
    }
}
