<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


Artisan::command('mail:send {user}', function (string $user) {
    $this->info("Sending email to: {$user}!");
});