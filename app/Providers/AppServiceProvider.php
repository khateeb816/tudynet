<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer for Layout
        view()->composer('layouts.app', function ($view) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if ($user) {
                // Get unread notifications for the user
                $notifications = \App\Models\Notification::where(function ($query) use ($user) {
                        $query->where('to', $user->id)
                              ->orWhere('to_role', $user->role);
                    })
                    ->where('is_read', false)
                    ->latest();

                $unreadCount = $notifications->count();
                $topNotifications = $notifications->take(3)->get();

                $view->with('unreadNotificationsCount', $unreadCount)
                     ->with('topNotifications', $topNotifications);
            }
        });
    }
}
