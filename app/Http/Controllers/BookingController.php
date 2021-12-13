<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Package;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingCancelRequest;


class BookingController extends Controller
{
    public function myBookings($userId)
    {
        $paginate = $request->paginate ?? 10;
        $bookings = Booking::where('book_by_id', $userId)
                        ->paginate($paginate);
        return view('user.booking.listBooking', ['bookings' => $bookings]);
    }

    public function reservations($userId)
    {
        $reservations = Booking::with('package', 'bookBy')
                        ->where('reserved_to_id' , $userId)
                        ->get();
        return view('user.reservations', compact('reservations'));
    }

    public function cancelBooking(BookingCancelRequest $request, Booking $booking)
    {

        $booking->status = Booking::CANCEL;
        $booking->save();

        return redirect("myBookings/$booking->book_by_id")
                ->with('success', 'The booking has been canceled!');
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

    public function createBooking(Package $package)
    {
        return view('user.booking.createBooking', ['package' => $package]);
    }

    public function store(BookingRequest $request)
    {
        Booking::create($request->all());
        return redirect()->route('myBookings', \Auth::user()->id);
    }
}
