<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;

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

    public function store(BookingRequest $request)
    {
        DB::beginTransaction();

        try {
            Booking::create($request->all());
            DB::commit();
            return redirect()->route()->route('myBookings');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return redirect()->withErrors(['msg' => 'Something wen\'t wrong']);
        }


    }
}
