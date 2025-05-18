<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
        public function index()
    {
        return view('Donatur.Donatur');
    }
}
