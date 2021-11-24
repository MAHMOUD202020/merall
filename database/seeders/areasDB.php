<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class areasDB extends Seeder
{

    public function run()
    {


        $country = Country::create([
            'name' =>'المملكة العربية السعودية',
            'slug' => Str::slug('Saudi Arabia')
        ]);
        $areas_saudi = [
            ["name" => "Abha" , "slug" => Str::slug("Abha") , 'country_id' => $country->id],
            ["name" => "Abha" , "slug" => Str::slug("Abha") , 'country_id' => $country->id],
            ["name" => "Abqaiq" , "slug" => Str::slug("Abqaiq") , 'country_id' => $country->id],
            ["name" => "Al Bahah" , "slug" => Str::slug("Al Bahah") , 'country_id' => $country->id],
            ["name" => "Al Faruq" , "slug" => Str::slug("Al Faruq") , 'country_id' => $country->id],
            ["name" => "Al Hufuf" , "slug" => Str::slug("Al Hufuf") , 'country_id' => $country->id],
            ["name" => "Al Qatif" , "slug" => Str::slug("Al Qatif") , 'country_id' => $country->id],
            ["name" => "Al Yamamah" , "slug" => Str::slug("Al Yamamah") , 'country_id' => $country->id],
            ["name" => "At Tuwal" , "slug" => Str::slug("At Tuwal") , 'country_id' => $country->id],
            ["name" => "Buraidah" , "slug" => Str::slug("Buraidah") , 'country_id' => $country->id],
            ["name" => "Dammam" , "slug" => Str::slug("Dammam") , 'country_id' => $country->id],
            ["name" => "Dhahran" , "slug" => Str::slug("Dhahran") , 'country_id' => $country->id],
            ["name" => "Hayil" , "slug" => Str::slug("Hayil") , 'country_id' => $country->id],
            ["name" => "Jazirah" , "slug" => Str::slug("Jazirah") , 'country_id' => $country->id],
            ["name" => "Jazirah" , "slug" => Str::slug("Jazirah") , 'country_id' => $country->id],
            ["name" => "Jeddah" , "slug" => Str::slug("Jeddah") , 'country_id' => $country->id],
            ["name" => "Jizan" , "slug" => Str::slug("Jizan") , 'country_id' => $country->id],
            ["name" => "Jubail" , "slug" => Str::slug("Jubail") , 'country_id' => $country->id],
            ["name" => "Khamis Mushait" , "slug" => Str::slug("Khamis Mushait") , 'country_id' => $country->id],
            ["name" => "Khobar" , "slug" => Str::slug("Khobar") , 'country_id' => $country->id],
            ["name" => "Khulays" , "slug" => Str::slug("Khulays") , 'country_id' => $country->id],
            ["name" => "Linah" , "slug" => Str::slug("Linah") , 'country_id' => $country->id],
            ["name" => "Madinat Yanbu` as Sina`iyah" , "slug" => Str::slug("Madinat Yanbu` as Sina`iyah") , 'country_id' => $country->id],
            ["name" => "Mecca" , "slug" => Str::slug("Mecca") , 'country_id' => $country->id],
            ["name" => "Medina" , "slug" => Str::slug("Medina") , 'country_id' => $country->id],
            ["name" => "Mina" , "slug" => Str::slug("Mina") , 'country_id' => $country->id],
            ["name" => "Najran" , "slug" => Str::slug("Najran") , 'country_id' => $country->id],
            ["name" => "Rabigh" , "slug" => Str::slug("Rabigh") , 'country_id' => $country->id],
            ["name" => "Rahimah" , "slug" => Str::slug("Rahimah") , 'country_id' => $country->id],
            ["name" => "Rahman" , "slug" => Str::slug("Rahman") , 'country_id' => $country->id],
            ["name" => "Ramdah" , "slug" => Str::slug("Ramdah") , 'country_id' => $country->id],
            ["name" => "Ras Tanura" , "slug" => Str::slug("Ras Tanura") , 'country_id' => $country->id],
            ["name" => "Riyadh" , "slug" => Str::slug("Riyadh") , 'country_id' => $country->id],
            ["name" => "Sabya" , "slug" => Str::slug("Sabya") , 'country_id' => $country->id],
            ["name" => "Safwa" , "slug" => Str::slug("Safwa") , 'country_id' => $country->id],
            ["name" => "Sakaka" , "slug" => Str::slug("Sakaka") , 'country_id' => $country->id],
            ["name" => "Sambah" , "slug" => Str::slug("Sambah") , 'country_id' => $country->id],
            ["name" => "Sayhat" , "slug" => Str::slug("Sayhat") , 'country_id' => $country->id],
            ["name" => "Tabuk" , "slug" => Str::slug("Tabuk") , 'country_id' => $country->id],
            ["name" => "Yanbu` al Bahr" , "slug" => Str::slug("Yanbu` al Bahr") , 'country_id' => $country->id]
        ];

        $country->areas()->insert($areas_saudi);
    }
}
