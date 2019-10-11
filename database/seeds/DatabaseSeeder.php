<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PuestosTableSeeder::class);
        $this->call(BancosTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CuentasTableSeeder::class);
        $this->call(FormasPagoTableSeeder::class);
        $this->call(EstrategiasTableSeeder::class);
        $this->call(CategoriaBitacorasTableSeeder::class);
        $this->call(CategoriaEstatusTableSeeder::class);
        $this->call(CategoriaServiciosTableSeeder::class);
        //$this->call(CategoriaEgresosTableSeeder::class);
        //$this->call(CatalogoServiciosTableSeeder::class);
        $this->call(EmporioTableSeeder::class);
        $this->call(ClasesTableSeeder::class);
        $this->call(MonedasTableSeeder::class);
        $this->call(PorcentajeIVATableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(RazonSocialTableSeeder::class);
        //$this->call(ListadoEstatusTableSeeder::class);
        $this->call(FranquiciaCategoriaTableSeeder::class);
        $this->call(FranquiciasTableSeeder::class);
        $this->call(ListadoEstatusTableSeeder::class);
        $this->call(RequisitosTableSeeder::class);
        $this->call(LoginImagenesTableSeeder::class);
        $this->call(SubCategoriaServiciosTableSeeder::class);
        $this->call(CategoryServicesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
