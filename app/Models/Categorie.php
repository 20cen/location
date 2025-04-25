<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the meteriels for the Categorie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meteriels(): HasMany
    {
        return $this->hasMany(Materiel::class, 'categories_id', 'id');
    }
}
