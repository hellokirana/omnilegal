<?php

namespace Database\Seeders;

use App\Models\MasterJabatan;
use App\Models\PengaturanPengajuan;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

use Faker\Factory as Faker;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');


        $data = new Website();
        $data->url = 'https://omnilegal.co.id/';
        $data->nama = 'Omnilegal';
        $data->caption = 'Omnilegal Info';

        $data->favicon = 'favicon.png';
        $data->logo = 'logo.png';

        $data->maps = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.9918022898955!2d106.8184317758929!3d-6.395057193595509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec08612d8bed%3A0x567fbca52b1b6f8c!2sDisNakerSos%20Kota%20Depok!5e0!3m2!1sid!2sid!4v1736418981646!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

        $data->address_id = 'Plaza Bisnis Kemang, 2nd Building, Jl. Kemang Raya No.2 RT.13/RW.1 Kel. Bangka, Kec. Mampang Prapatan Kota Jakarta Selatan Daerah Khusus Ibukota Jakarta 12730';
        $data->address_en = 'Merdeka Street';

        $data->email = "cs@email.com";
        $data->phone = "+6281343569579";

        $data->facebook = "";
        $data->instagram = "";
        $data->linkedin = "";
        $data->x = "";

        $data->save();

        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);

        $super = new User();
        $super->name = 'superadmin';
        $super->email = 'superadmin@omnilegal.com';
        $super->password = bcrypt('12345678');
        $super->status = 1;

        $super->save();
        $super->assignRole('superadmin');

    }
}
