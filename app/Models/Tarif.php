<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarif extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the materiels that owns the Tarif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiels(): BelongsTo
    {
        return $this->belongsTo(Materiel::class, 'materiels_id', 'id');
    }

    /**
     * Get the typelocations that owns the Tarif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typelocations(): BelongsTo
    {
        return $this->belongsTo(Typelocation::class, 'typelocations_id', 'id');
    }
}
