<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Section;
use Illuminate\Database\Seeder;

class catsDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = Section::create([
            'name' => 'المكياج',
            'slug' => 'make-up',
            'order' => 1,
        ]);


        Cat::insert(
            [
                [
                'name' => 'الوجه',
                'slug' => 'face',
                'order' => 1,
                'section_id' => $section->id,
                ],
                [
                'name' => 'الشفاه',
                'slug' => 'the-lips',
                'order' => 2,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العيون',
                'slug' => 'eyes',
                'order' => 3,
                'section_id' => $section->id,
                ],
                [
                'name' => 'الحواجب',
                'slug' => 'eyebrows',
                'order' => 4,
                'section_id' => $section->id,
                ],
                [
                'name' => 'الخدود',
                'slug' => 'cheeks',
                'order'=> 5,
                'section_id' => $section->id,
                ],
                [
                'name' => 'الإضاءه',
                'slug' => 'illumination',
                'order' => 6,
                'section_id' => $section->id,
                ],
                [
                'name' => 'الادوات وفرش التجميل',
                'slug' => 'brushes-and-tools',
                'order' => 7,
                'section_id' => $section->id,
                ],
                [
                'name' => 'رموش',
                'slug' => 'false-eyelashes',
                'order' => 8,
                'section_id' => $section->id,
                ],
            ]
        );

        ///////////////////////////////////////////////////////


        $section = Section::create([
            'name' => 'العناية',
            'slug' => 'care',
            'order' => 2,
        ]);


        Cat::insert(
            [
                [
                'name' => 'العناية بالبشرة',
                'slug' => 'skin-care',
                'order' => 1,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية بالشعر',
                'slug' => 'hair-care',
                'order' => 2,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية بالجسم',
                'slug' => 'body-care',
                'order' => 3,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية باليدين',
                'slug' => 'hand-care',
                'order' => 4,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية بالقدم',
                'slug' => 'foot-care',
                'order' => 5,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية بالوجه',
                'slug' => 'face-care',
                'order' => 6,
                'section_id' => $section->id,
                ],
                [
                'name' => 'العناية بالشفاه',
                'slug' => 'lip-care',
                'order' => 7,
                'section_id' => $section->id,
                ],
            ]
        );

        ///////////////////////////////////////////////////////


        $section = Section::create([
            'name' => 'العطور',
            'slug' => 'perfumes',
            'order' => 3,
        ]);


        Cat::insert(
            [
                [
                'name' => 'زيوت عطرية',
                'slug' => 'essential-oils',
                'order' => 1,
                'section_id' => $section->id,
                ],
                [
                'name' => 'معطر الشعر',
                'slug' => 'Hair-freshener',
                'order' => 2,
                'section_id' => $section->id,
                ],
            ]
        );

        ///////////////////////////////////////////////////////



        $section = Section::create([
            'name' => 'عدسات',
            'slug' => 'anastasia',
            'order' => 4,
        ]);


        Cat::insert(
            [
                [
                'name' => 'انستازيا',
                'slug' => 'anastasia',
                'order' => 1,
                'section_id' => $section->id,
                ],
                [
                'name' => 'ديفا',
                'slug' => 'diva',
                'order' => 2,
                'section_id' => $section->id,
                ],
                [
                'name' => 'لنس مي',
                'slug' => 'lens-me',
                'order' => 3,
                'section_id' => $section->id,
                ],
            ]
        );

//        1608,8,871,,
//1609,8,872,,
//1610,8,873,,
//1611,8,874,,
//1612,8,875,,
//1613,8,876,,
//1614,8,877,,
//1615,8,878,,
//1616,8,879,,
//1617,8,880,,
//1618,8,881,,

        ///////////////////////////////////////////////////////


        $section = Section::create([
            'name' => 'أجهزة و أدوات',
            'slug' => 'hardware-and-tools',
            'order' => 5,
        ]);


        Cat::insert(
            [
                [
                'name' => 'أجهزة الجسم',
                'slug' => 'body-systems',
                'order' => 1,
                'section_id' => $section->id,
                ],
                [
                'name' => 'أجهزة الشعر',
                'slug' => 'hair-devices',
                'order' => 2,
                'section_id' => $section->id,
                ],
                [
                'name' => 'أجهزه الوجه',
                'slug' => 'facial-organs',
                'order' => 3,
                'section_id' => $section->id,
                ],
            ]
        );

        ///////////////////////////////////////////////////////


    }
}
