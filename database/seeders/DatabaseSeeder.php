<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@techstore.com'],
            [
                'name' => 'Administrador TechStore',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@techstore.com'],
            [
                'name' => 'Cliente Teste',
                'password' => Hash::make('cliente123'),
                'role' => 'cliente',
            ]
        );

        $categorias = collect(['Celulares', 'Notebooks', 'Acessorios', 'Perifericos', 'Componentes'])
            ->map(fn ($name) => Category::firstOrCreate(['name' => $name], ['description' => "Categoria de {$name}."]));

        if (Product::count() === 0) {
            foreach ($categorias as $categoria) {
                Product::create([
                    'category_id' => $categoria->id,
                    'name' => "{$categoria->name} Premium",
                    'description' => "Produto de exemplo da categoria {$categoria->name}.",
                    'price' => 199.90,
                    'stock' => 25,
                    'brand' => 'TechStore',
                ]);
            }
        }
    }
}
