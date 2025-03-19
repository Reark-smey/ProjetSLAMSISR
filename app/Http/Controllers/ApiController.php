<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMessage()
    {
        return response()->json(['message' => 'Hello depuis Laravel']);
    }
}

