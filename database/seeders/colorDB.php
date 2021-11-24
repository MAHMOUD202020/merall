<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class colorDB extends Seeder
{


    public function run()
    {
        return response()->file(asset('att_colors.json'));
    }
}
