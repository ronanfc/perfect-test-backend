<?php

use Illuminate\Database\Seeder;

class ProdutcsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 20)->create();
    }
}
