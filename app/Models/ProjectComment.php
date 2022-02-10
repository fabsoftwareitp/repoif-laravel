<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function related_user()
    {
        return $this->belongsTo(User::class, 'replied_to_user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'projects_comments_likes');
    }

    public function current_user_liked()
    {
        return $this->likes()
            ->where('user_id', Auth::id());
    }
}
