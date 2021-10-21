<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "title",
        "description",
        "type",
        "path",
        "path_web",
        "file_name",
        "url",
        "views",
        "user_id"
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
}
