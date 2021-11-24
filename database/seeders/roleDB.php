<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class roleDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
           [
                'name' => 'admin.index',
            ],[
                'name' => 'admin.create',
            ],[
                'name' => 'admin.update'
            ],[
                'name' => 'admin.destroy',
            ],[
                'name' => 'admin.trash'
            ],[
                'name' => 'admin.restore',
            ],[
                'name' => 'admin.finalDelete',
            ],[
                'name' => 'user.index',
            ],[
                'name' => 'user.create',
            ],[
                'name' => 'user.update'
            ],[
                'name' => 'user.destroy',
            ],[
                'name' => 'user.trash'
            ],[
                'name' => 'user.restore',
            ],[
                'name' => 'user.finalDelete',
            ],[
                'name' => 'product.index',
            ],[
                'name' => 'product.create',
            ],[
                'name' => 'product.update'
            ],[
                'name' => 'product.show',
            ],[
                'name' => 'product.destroy',
            ],[
                'name' => 'product.trash'
            ],[
                'name' => 'product.restore',
            ],[
                'name' => 'product.finalDelete',
            ],[
                'name' => 'order.index',
            ],[
                'name' => 'order.print',
            ],[
                'name' => 'order.update'
            ],[
                'name' => 'order.show',
            ],[
                'name' => 'country.index',
            ],[
                'name' => 'country.create',
            ],[
                'name' => 'country.update'
            ],[
                'name' => 'country.destroy',
            ],[
                'name' => 'country.trash'
            ],[
                'name' => 'country.restore',
            ],[
                'name' => 'country.finalDelete',
            ],[
                'name' => 'area.index',
            ],[
                'name' => 'area.create',
            ],[
                'name' => 'area.update'
            ],[
                'name' => 'area.destroy',
            ],[
                'name' => 'area.trash'
            ],[
                'name' => 'area.restore',
            ],[
                'name' => 'area.finalDelete',
            ],[
                'name' => 'section.index',
            ],[
                'name' => 'section.create',
            ],[
                'name' => 'section.update'
            ],[
                'name' => 'section.trash',
            ],[
                'name' => 'section.destroy',
            ],[
                'name' => 'section.restore',
            ],[
                'name' => 'section.finalDelete',
            ],[
                'name' => 'cat.index',
            ],[
                'name' => 'cat.create',
            ],[
                'name' => 'cat.update'
            ],[
                'name' => 'cat.trash',
            ],[
                'name' => 'cat.destroy',
            ],[
                'name' => 'cat.restore',
            ],[
                'name' => 'cat.finalDelete',
            ],[
                'name' => 'color.index',
            ],[
                'name' => 'color.create',
            ],[
                'name' => 'color.update'
            ],[
                'name' => 'color.trash',
            ],[
                'name' => 'color.destroy',
            ],[
                'name' => 'color.restore',
            ],[
                'name' => 'coupon.index',
            ],[
                'name' => 'coupon.create',
            ],[
                'name' => 'coupon.update'
            ],[
                'name' => 'coupon.trash',
            ],[
                'name' => 'coupon.destroy',
            ],[
                'name' => 'coupon.restore',
            ],[
                'name' => 'coupon.finalDelete',
            ],[
                'name' => 'role.index',
            ],[
                'name' => 'report.index',
            ],[
                'name' => 'report.custom',
            ],
        ];

        foreach ($data as $row) {
            Role::create(
                $row
            );
        }
    }
}
