<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     */
    protected $table = "tasks";

    /**
     * fillable
     */
    protected $fillable = [
        'task_status_id',
        'creator_id',
        'title',
        'content',
        'image',
        'is_publish',
    ];

    /**
     * with (eager load)
     */
    protected $with = [
        'getTaskStatus',
        'getPostedBy'
    ];

    public function getTaskStatus() : HasOne{
        return $this->hasOne(TaskStatus::class, 'id', 'task_status_id');
    }

    public function getPostedBy() : HasOne{
        return $this->hasOne(User::class, 'id', 'creator_id');
    }
}
