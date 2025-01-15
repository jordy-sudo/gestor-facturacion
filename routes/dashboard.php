<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('setting', 'pages.auth.verify-email')
    ->name('settings.account');

Volt::route('setting/privacy', 'pages.auth.verify-email')
    ->name('settings.privacy');


