<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return Auth::check() && Auth::user()->tipo === 'admin';
    }
}

if (!function_exists('isPadrao')) {
    function isPadrao()
    {
        return Auth::check() && Auth::user()->tipo === 'padrao';
    }
}