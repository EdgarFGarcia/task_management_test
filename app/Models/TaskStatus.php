<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     */
    protected $table = "task_statuses";

    /**
     * fillables
     */
    protected $fillable = [
        'name'
    ];
}
