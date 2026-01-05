<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command('bntk:bolcom-invoice-requests')->everyFiveMinutes();

Schedule::command('order:bolcom-sync')->everyFiveMinutes();

