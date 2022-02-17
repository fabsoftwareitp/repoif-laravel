<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLikedCommentQueued extends Notification implements ShouldQueue
{
    use Queueable;

    private $project;
    private $comment;
    private $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $comment, $url)
    {
        $this->project = $project;
        $this->comment = $comment;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $comment = '';

        if ($this->comment->related_user) {
            $comment .= '@' . $this->comment->related_user->name . ' ';
        }

        $comment .= $this->comment->content;

        return (new MailMessage)
            ->subject('Nova curtida em um comentário')
            ->line('Alguém curtiu seu comentário "' . $comment . '", no projeto "' . $this->project->title . '".')
            ->action('Visualizar comentário', $this->url);
    }
}
