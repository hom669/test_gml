<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryGmlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_gml')->truncate();
        DB::table('categories_gml')->insert([
            'name_category' => 'Cliente',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories_gml')->insert([
            'name_category' => 'Proveedor',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('categories_gml')->insert([
            'name_category' => 'Funcionario Interno',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
