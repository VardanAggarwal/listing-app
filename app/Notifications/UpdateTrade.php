<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Trade;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\Resources\AndroidNotification;

class UpdateTrade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $trade;
    public function __construct($id)
    {
        $this->trade=Trade::find($id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FcmChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toFcm($notifiable){
        $trade=$this->trade;
        return FcmMessage::create()->setData(['url' => 'https://app.seedsaversclub.com/e2e/bid-form/'.$trade->id])
        ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
            ->setTitle('People are showing interest in '.$trade->item->name)
            ->setBody('Update your trade to get noticed.')
            ->setImage($trade->item->image_url)
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
