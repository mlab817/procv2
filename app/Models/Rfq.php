<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rfq extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];

    public function pr_prases(): BelongsToMany
    {
        return $this->belongsToMany(PrPras::class);
    }
}
