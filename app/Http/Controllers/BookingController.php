<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;

class BookingController extends Controller
{
    public function myBookings($userId)
    {
        $data = Booking::where('book_by_id', $userId)
                        ->get();
        return $data;
    }

    public function myPackageBookings($userId)
    {
        $data = Booking::where('reserved_to_id' , $userId)
                        ->get();
        return $data;
    }
}
