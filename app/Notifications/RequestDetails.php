<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Trade;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Notifications\Notification;

class RequestDetails extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $trade;
    public $name;
    public function __construct($id,$name)
    {
        $this->name=$name;
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
    public function toFcm($notifiable)
    {
        $trade=$this->trade;
        return FcmMessage::create()->setData(['url' => url('/e2e/bid-form/'.$trade->id)])
        ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
            ->setTitle(__('e2e.notification.request_details.title',['name'=>$this->name,'item'=>$trade->item->name]))
            ->setBody(__('e2e.notification.request_details.body',['item'=>$trade->item->name]))
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
