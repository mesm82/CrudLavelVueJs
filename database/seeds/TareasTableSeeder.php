<?php

use Illuminate\Database\Seeder;
use App\Tarea;
class TareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(Tarea::class,35)->create();
    }
}
