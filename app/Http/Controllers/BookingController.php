<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;

class BookingController extends Controller
{
    public function myBookings($userId)
    {
        $bookings = Booking::where('book_by_id', $userId)
                        ->get();
        return view('user.myBookings', compact('bookings'));
    }

    public function reservations($userId)
    {
        $reservations = Booking::with('package', 'bookBy')
                        ->where('reserved_to_id' , $userId)
                        ->get();
        return view('user.reservations', compact('reservations'));
    }
    
    public function confirmBooking(Booking $booking)
    {
        $booking->status = Booking::CONFIRMED;
        $booking->save();

        return redirect("reservations/$booking->reserved_to_id")
                ->with('success', 'The booking has been confirmed!');
    }

    public function declineBooking(Booking $booking)
    {
        $booking->status = Booking::DECLINED;
        $booking->save();
        return redirect("reservations/$booking->reserved_to_id")
                ->with('success', 'The booking has been declined!');
    }
}
