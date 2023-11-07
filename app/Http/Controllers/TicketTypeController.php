<?php

namespace App\Http\Controllers;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $tempats = TicketType::all();

        return response()->json([
            'results' => $tempats
        ], 200);
    }
}
