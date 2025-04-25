<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perte extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the materiels that owns the Perte
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiels(): BelongsTo
    {
        return $this->belongsTo(Materiel::class, 'materiels_id', 'id');
    }
}
