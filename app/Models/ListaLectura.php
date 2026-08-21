<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListaLectura extends Model
{
    use HasFactory;

    protected $table = 'listas_lectura';

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
    ];

    // Relaciones de este modelo con otros modelos
    // Relacion 1:N - La lista de lectura pertenence a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relacion N:M - Una lista puede contener muchos libros
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_lista_lectura')
            ->withPivot('puntaje', 'estado')
            ->withTimestamps();
    }

    // Crear un "scope" local que permita obtener las listas de un usuario puntual
    public function scopeDelUsuario($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
