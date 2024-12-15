<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Apar;
use App\Mail\AparExpiredNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckAparExpiration extends Command {
    protected $signature = 'check:apar-expiration';
    protected $description = 'Periksa APAR kedaluwarsa dan kirim notifikasi email';

    public function handle() {
        $expiredApars = Apar::where('tanggal_exp', '<', Carbon::now())->get();

        foreach ($expiredApars as $apar) {
            // Kirim email ke admin atau pengguna
            $adminEmail = 'aryadwiprad@gmail.com'; // Ganti dengan email admin atau pengguna
            Mail::to($adminEmail)->send(new AparExpiredNotification($apar));
        }

        $this->info('Notifikasi kedaluwarsa telah dikirim.');
    }
}