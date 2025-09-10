<?php

namespace App\Notifications\MBO\Campaign;

use App\Support\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;

class ObjectiveAdded extends BaseNotification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    // public function toApp(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
