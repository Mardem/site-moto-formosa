<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Admin\Product\CategoryProduct::class, 30)->create()->each(function($category) {
            for($i = 0; $i < 10; $i++){
                $category->products()->save(factory(\App\Models\Admin\Product\Product::class)->make());
            }
        });
    }
}
