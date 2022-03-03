<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'インテリア'],
            ['name' => '食べ物'],
            ['name' => '本'],
            ['name' => 'ゲーム'],
            ['name' => 'その他'],
        ]);
    }
}
