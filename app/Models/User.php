<?php

namespace App\Models;

use App\Notifications\Auth\ResetPasswordQueued;
use App\Notifications\Auth\VerifyEmailQueued;
use App\Notifications\UserCommentedQueued;
use App\Notifications\UserLikedCommentQueued;
use App\Notifications\UserLikedProjectQueued;
use App\Notifications\UserRepliedCommentQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "description",
        "photo_path",
        "profile_views",
        "completed_profile",
        "email_verified_at"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        "password",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued());
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordQueued($token));
    }

    /**
     * Send the user liked project notification.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function sendUserLikedProjectNotification($project)
    {
        $this->notify(new UserLikedProjectQueued($project));
    }

    /**
     * Send the user liked comment notification.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\ProjectComment  $comment
     * @param  string  $url
     * @return void
     */
    public function sendUserLikedCommentNotification($project, $comment, $url)
    {
        $this->notify(new UserLikedCommentQueued($project, $comment, $url));
    }

    /**
     * Send the user commented notification.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\ProjectComment  $comment
     * @param  string  $url
     * @return void
     */
    public function sendUserCommentedNotification($project, $comment, $url)
    {
        $this->notify(new UserCommentedQueued($project, $comment, $url));
    }

    /**
     * Send the user replied comment notification.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\ProjectComment  $comment
     * @param  string  $url
     * @return void
     */
    public function sendUserRepliedCommentNotification($project, $comment, $url)
    {
        $this->notify(new UserRepliedCommentQueued($project, $comment, $url));
    }
}
