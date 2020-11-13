<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
			'action_id',
			'staff_id',
			'completed',
			'document_id',
			'enduser_id',
			'details',
			'remarks',
			'status_id',
			'completed_at',
			'created_by'
    ];

    public function pr_prases(): BelongsToMany
    {
    	return $this->belongsToMany(PrPras::class);
    }

    public function creator(): BelongsTo
    {
    	return $this->belongsTo(User::class,'created_by','id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function enduser()
    {
        return $this->belongsTo(Enduser::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
