<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the materiels that owns the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materiels(): BelongsTo
    {
        return $this->belongsTo(Materiel::class, 'materiels_id', 'id');
    }

    /**
     * Get the clients that owns the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clients(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'clients_id', 'id');
    }

    // public function prixmateriel($materiels)
    // {
    //     $prix = Tarif::findbymaterielid($materiels);
    //     if (\count($prix)>0) {
    //         return $prix->montant;
    //     }

    //     return 0;
    // }
}
