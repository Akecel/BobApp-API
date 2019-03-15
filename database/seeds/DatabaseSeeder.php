<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        Eloquent::unguard();
        $this->call('UserTableSeeder');
        $this->call('FolderCategorieTableSeeder');
        $this->call('FileTypeTableSeeder');
    }
}

class UserTableSeeder extends Seeder {
    public function run()
    {
      DB::table('users')->delete();

      DB::table('users')->insert([
        'admin' => 1,
        'email' => 'admin@admin.com',
        'password' => bcrypt('password'),
        'phone_number' => '+33651520836',
        'lastName' => 'Admin',
        'firstName' => 'Admin',
        'birthdate' => '2000-01-01',
        'address' => '15 rue Jhon Doe',
        'postal_code' => '75016',
        'city' => 'Paris',
        'country' => 'France'
      ]);
    }
  }

  class FolderCategorieTableSeeder extends Seeder {
    public function run()
    {
      DB::table('folders_categories')->delete();

      DB::table('folders_categories')->insert([
        'id' => 1,
        'title' => 'Identité',
        'icon' => $_ENV['APP_URL'] . '/assets/img/category/category_1.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit viverra fusce.'
      ]);

      DB::table('folders_categories')->insert([
        'id' => 2,
        'title' => 'Garant',
        'icon' => $_ENV['APP_URL'] . '/assets/img/category/category_2.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit viverra fusce.'
      ]);

      DB::table('folders_categories')->insert([
        'id' => 3,
        'title' => 'Domicile',
        'icon' => $_ENV['APP_URL'] . '/assets/img/category/category_3.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit viverra fusce.'
      ]);

      DB::table('folders_categories')->insert([
        'id' => 4,
        'title' => 'Emploi',
        'icon' => $_ENV['APP_URL'] . '/assets/img/category/category_4.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit viverra fusce.'
      ]);

      DB::table('folders_categories')->insert([
        'id' => 5,
        'title' => 'Supplémentaire',
        'icon' => $_ENV['APP_URL'] . '/assets/img/category/category_5.png',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit viverra fusce.'
      ]);

    }
  }


  class FileTypeTableSeeder extends Seeder {
    public function run()
    {
      DB::table('files_types')->delete();

      DB::table('files_types')->insert([
          'title' => "Pièce d'identité",
          'folder_category_id' => 1
      ]);

      DB::table('files_types')->insert([
        'title' => 'Passeport',
        'folder_category_id' => 1
      ]);

    DB::table('files_types')->insert([
      'title' => 'Permis de conduire',
      'folder_category_id' => 1
    ]);


    DB::table('files_types')->insert([
      'title' => "Pièce d'identité",
      'folder_category_id' => 2
    ]);

    DB::table('files_types')->insert([
      'title' => 'Justificatif de domicile',
      'folder_category_id' => 2
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-1',
      'folder_category_id' => 2
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-2',
      'folder_category_id' => 2
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-3',
      'folder_category_id' => 2
    ]);

    DB::table('files_types')->insert([
      'title' => "Dernier avis d'imposition / non imposition",
      'folder_category_id' => 2
    ]);






    DB::table('files_types')->insert([
      'title' => 'Quittance de loyer',
      'folder_category_id' => 3
    ]);

    DB::table('files_types')->insert([
      'title' => "Attestation d'hébergement",
      'folder_category_id' => 3
    ]);

    DB::table('files_types')->insert([
      'title' => 'Taxe foncière',
      'folder_category_id' => 3
    ]);

    DB::table('files_types')->insert([
      'title' => 'Titre de propriété',
      'folder_category_id' => 3
    ]);

    DB::table('files_types')->insert([
      'title' => "Facture d'eau / gaz / électricité",
      'folder_category_id' => 3
    ]);





    DB::table('files_types')->insert([
      'title' => "Contrat d'emploi",
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Carte professionnelle',
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Extrait de Kbis',
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-1',
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-2',
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Bulletin de salaire M-3',
      'folder_category_id' => 4
    ]);

    DB::table('files_types')->insert([
      'title' => 'Autre',
      'folder_category_id' => 5
    ]);

    }
  }
