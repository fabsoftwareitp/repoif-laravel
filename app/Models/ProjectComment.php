<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $table = 'projects_comments';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "content",
        "project_id",
        "user_id",
        "replied_to_user_id"
    ];

    /**
     * The date attributes to convert to Carbon.
     *
     * @var string[]
     */
    protected $dates = ['created_at'];
}
