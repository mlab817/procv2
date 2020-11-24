<?php

namespace App\Models;

use App\Traits\HasModifier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasModifier;

    protected $fillable = [
			'action_id', // action required
			'user_id', // staff assigned
			'completed', //if completed or not
			'details', // details of the assignment
			'remarks', // any other details
			'status_id', // current status of the task
            'due_at',
			'completed_at', //
			'created_by',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function procurement_requests(): BelongsToMany
    {
    	return $this->belongsToMany(ProcurementRequest::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function enduser(): BelongsTo
    {
        return $this->belongsTo(Enduser::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCompletedAttribute(): bool
    {
    	return (bool) $this->completed_at;
    }

    public function scopeOwn($query)
    {
    	$user = auth()->user()->staff_id;

    	if (! $user) {
    		return $query;
	    }

    	return $query->where('staff_id', $user);
    }

    public function scopeOngoing($query)
    {
      return $query->where('status_id', 1);
    }

    public function scopeCompleted($query)
    {
      return $query->where('status_id', 2);
    }

    public function getDueDateAttribute()
    {
        if ($this->due_at) {
            return $this->due_at->format('d-m-Y');
        }
        return null;
    }
    
}
