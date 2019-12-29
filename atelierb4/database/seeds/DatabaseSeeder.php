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
        //les truncate doivent se faire en ordre inverse des créations de DB pour les FK
        //pour cela il faut virer les FK puis faire les delete, puis remettre les FK
        //autre appel possible
        //DB::table('clients')->truncate();
        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\User::truncate();
        App\profil::truncate();
        App\chantier::truncate();
        App\corps_metier::truncate();
        App\prestation::truncate();
        App\client::truncate();
        App\adresse::truncate();
        App\ville::truncate();

        /*
        App\ville::create(
            [
                'ville' => 'Bruxelles',
                'CP' => '1000',
            ]
        );
        App\ville::create(
            [
                'ville' => 'Wavre',
                'CP' => '1300',
            ]
        );
        App\adresse::create(
            [
                'rue' => 'Ma rue',
                'num' => '53b',
                'ville_id' => '1',
            ]
            );
        App\client::create(
            [
                'nom' => 'Dupont',
                'prenom' => 'Paul',
                'phone' => '012345678',
                'sexe' => '1',
                'email' => 'Dupont@test.com',
                'adresse_id' => '1',
            ]
            );
        App\client::create(
            [
                'nom' => 'Durant',
                'prenom' => 'Pierre',
                'phone' => '02345543',
                'sexe' => '1',
                'email' => 'Durant@test.com',
            ]
            );
        App\client::create(
            [
                'nom' => 'VanPiperseel',
                'prenom' => 'Jeanne',
                'phone' => '010234312',
                'sexe' => '0',
                'email' => 'VPJ@test.com',
                'adresse_id' => null,
            ]
            );

        App\corps_metier::create(
            [
                'nom' => 'VanPiperseel',
                'description' => 'L’ambiance familiale dans un cadre rigoureux fait la particularité de ce cabinet d’architecture',
            ]
        );

        App\chantier::create(
            [
                'description' => 'Description',
            ]
        );*/

        App\profil::create(
            [
                'nom' => 'admin',
                'description' => 'Le profil administrateur',
                'accesContrat' => '4',
                'accesIntervenant' => '4',
                'accesUser' => '4',
            ]
        );
        App\profil::create(
            [
                'nom' => 'viewer',
                'description' => 'Le profil viewer peut tout consulter',
                'accesContrat' => '1',
                'accesIntervenant' => '1',
                'accesUser' => '1',
            ]
        );

        App\User::create(
            [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'profil_id' => '1',
                'password' => \Hash::make('admin'),
            ]
        );
        App\User::create(
            [
                'name' => 'view',
                'email' => 'view@test.com',
                'profil_id' => '2',
                'password' => \Hash::make('view'),
            ]
        );
        //j'importe les communes
        $this->call(UsersTableSeeder::class);
        //je réactive les FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Eloquent::reguard();
    }
}

use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;

class UsersTableSeeder extends SpreadsheetSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/Villes.csv'; // specify relative to Laravel project base path
        $this->tablename = 'villes';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger spreadsheets
	    DB::disableQueryLog();
	    parent::run();
    }
}
