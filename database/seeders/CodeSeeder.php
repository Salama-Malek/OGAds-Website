<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Code;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Code::create([
                'code' => str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
