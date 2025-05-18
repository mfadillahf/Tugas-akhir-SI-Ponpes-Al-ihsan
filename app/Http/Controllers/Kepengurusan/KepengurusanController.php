<?php

namespace App\Http\Controllers\Kepengurusan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KepengurusanController extends Controller
{
    public function index()
    {
        return view('Kepengurusan.Kepengurusan');
    }
}
