<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;

class SlackNotification extends Notification
{
    use Queueable;
    public $SlackMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($SlackMessage)
    {
        $this->SlackMessage = $SlackMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack(object $notifiable): SlackMessage
    {
        $date = Carbon::now('Asia/Jakarta')->format('d F Y H:i:s');
        $SlackMessage = $this->SlackMessage;

        return (new SlackMessage)
            ->success()
            ->content("Berikut Data Member WakandaSlot Yang Mendapatkan Bonus Dari Mystery Box Pada Tgl {$date}")
            ->attachment(function ($attachment) use ($SlackMessage) {
                $attachment->title('Data Pemenang Mystery Box')
                    ->fields([
                        'Tanggal' => $SlackMessage['created_at'],
                        'username' => $SlackMessage['username'],
                        'Reward' => $SlackMessage['reward'],
                        'ip_address' => $SlackMessage['ip_address'],
                    ]);

            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'username'          => $this->SlackMessage['username'],
            'reward'             => $this->SlackMessage['reward_name'],
            'ip_address'        => $this->SlackMessage['ip_address'],
            'created_at' => $this->SlackMessage['created_at'],
        ];

    }
}
