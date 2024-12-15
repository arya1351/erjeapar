<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class ScheduleServiceProvider extends ServiceProvider {
    public function schedule(Schedule $schedule) {
        // Jalankan command check:apar-expiration setiap hari pukul 00:00
        $schedule->command('check:apar-expiration')->dailyAt('00:00');
        \Illuminate\Support\Facades\Mail::failures(function ($failures) {
            Log::error('Mail Failures: ', $failures);
        });
    }
    
}
