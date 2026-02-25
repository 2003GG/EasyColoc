<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            DepenseSeeder::class,
             ColocationSeeder::class,
            CategorieSeeder::class,
        ]);

    user::factory(10)->create([
        'role_id'=>2,
        ]
    );

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@example.com',
            'role_id'=>1,
            'condition'=>'notbanne',
            'note'=>0,
        ]);





    }
}
