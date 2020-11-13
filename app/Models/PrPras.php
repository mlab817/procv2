<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrPras extends Model
{
    use HasFactory;

    protected $fillable = [
    	'number',
        'details',
        'enduser_id',
    ];

    public function enduser(): BelongsTo
    {
    	return $this->belongsTo(Enduser::class);
    }

    public function rfqs(): BelongsToMany
    {
        return $this->belongsToMany(Rfq::class);
    }
}
