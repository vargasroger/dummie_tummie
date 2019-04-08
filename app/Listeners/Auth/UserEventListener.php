<?php

namespace App\Listeners\Auth;

use App\LogSessions;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        $ip_address = request()->getClientIp();
        $browser = request()->header('User-Agent');
        // Update the logging in users time & IP

        $logSession = new LogSessions();
        $logSession->fill([
            'user_id' => $event->user->id ,
            'ip' => $ip_address,
            'user_agent' => $browser
        ]);
        $logSession->save();
    }

    /**
     * @param $event
     */
    public function onLoggedOut($event)
    {
        $currentSession = $event->user->currentSession;
        $currentSession->touch();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\Auth\UserEventListener@onLoggedIn'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\Auth\UserEventListener@onLoggedOut'
        );

    }
}
