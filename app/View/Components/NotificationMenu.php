<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationMenu extends Component
{

      public $notifications;

      public $unreadnotifications;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user=auth()->guard('admin')->user();

        if($user){

            $this->notifications=$user->notifications;
            $this->unreadnotifications=$user->unreadNotifications()->count();

        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-menu');
    }
}
