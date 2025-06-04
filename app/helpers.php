<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    function user(): \App\Models\User
    {
        return Auth::user();
    }
}