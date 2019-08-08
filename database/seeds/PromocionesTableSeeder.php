<?php

use Illuminate\Database\Seeder;

class PromocionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_promociones')->insert([
            ['promocion' => '2015'],
            ['promocion' => '2016'],
            ['promocion' => '2017'],
            ['promocion' => '2018'],
            ['promocion' => '2019'],
            ['promocion' => '2020'],
            ['promocion' => '2021'],
            ['promocion' => '2022'],
            ['promocion' => '2023'],
            ['promocion' => '2024'],
            ['promocion' => '2025'],
            ['promocion' => '2026'],
            ['promocion' => '2027'],
            ['promocion' => '2028'],
        ]);
    }
}
