<?php

namespace App\Http\Controllers\Infaq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfaqController extends Controller
{
    public function index()
    {
        return view('Infaq.infaq');
    }
}
