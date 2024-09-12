<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Seed the kelas table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            'kode_kelas' => 'XIIPPLG1',
            'nama_kelas' => '12 PPLG 1',
        ]);
    }
}
