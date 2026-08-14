<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ListaLectura;

class ListaLecturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = User::all();
        $libros = Libro::all();
        $usuarios->each(function(User $usuario) use ($libros) {
            $listas = ListaLectura::factory(rand(1, 3))->create([
                'user_id' => $usuario->id,
            ]);

            $listas->each(function(ListaLectura $lista) use ($libros) {
                $librosAleatorios = $libros->random(rand(2, 5));

                foreach($librosAleatorios as $libro) {
                    $lista->libros()->attach($libro->id, [
                        'puntaje' => rand(1, 5),
                        'estado' => fake()->randomElement(['pendiente', 'leyendo', 'completado']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });
        });
    }
}
