<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Model::unguard();
        /*
        $this->call(TiposDocumentosTableSeeder::class);
        $this->call(TiposAnexosTableSeeder::class);
        $this->call(TiposAsuntosTableSeeder::class);
        $this->call(TiposAreasTableSeeder::class);
        $this->call(EstatusDocumentosTableSeeder::class);
        $this->call(PrioridadesDocumentosTableSeeder::class);
        $this->call(ImportanciaContenidosTableSeeder::class);
        $this->call(TemasTableSeeder::class);
        $this->call(InstruccionesTableSeeder::class);
        $this->call(PersonalTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(ParametrosTableSeeder::class);
        */
        $this->call(PuestosTableSeeder::class);
        $this->call(AdscripcionesTableSeeder::class);

        Model::reguard();
    }
}
