<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Package;
use App\Http\Controllers\LogController as Log;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingCancelRequest;


class BookingController extends Controller
{
    public function myBookings()
    {
        $paginate = $request->paginate ?? 10;
        $bookings = Booking::where('book_by_id', Auth::user()->id)
                        ->paginate($paginate);
        return view('user.booking.listBooking', ['bookings' => $bookings, 'booking_nav'=>'active']);
    }

    public function reservations(Request $request)
    {
        $limit = $request->limit ?? 10;
        $reservation_nav = 'active';
        $reservations = Booking::with('package', 'bookBy')
                        ->where('reserved_to_id' , Auth::user()->id)
                        ->paginate($limit);

        return view('user.reservations', compact('reservations', 'reservation_nav'));
    }

    public function cancelBooking(BookingCancelRequest $request, Booking $booking)
    {

        $booking->status = Booking::CANCEL;
        $booking->save();

        // create logs
        Log::store(Booking::CANCEL, 'You cancelled your booking', $booking->book_by_id);
        Log::store(Booking::CANCEL, $booking->bookBy->name . ' cancelled his/her booking', $booking->reserved_to_id);

        return redirect("myBookings/$booking->book_by_id")
                ->with('success', 'The booking has been canceled!');
    }

    public function confirmBooking(Booking $booking)
    {
        $booking->status = Booking::CONFIRMED;
        $booking->save();

        // create logs
        Log::store(Booking::CONFIRMED, 'Your booking was accepted', $booking->book_by_id);
        Log::store(Booking::CONFIRMED, 'You accept '.$booking->bookBy->name . ' booking', $booking->reserved_to_id);

        return redirect("reservations/$booking->reserved_to_id")
                ->with('success', 'The booking has been confirmed!');
    }

    public function declineBooking(Booking $booking)
    {
        $booking->status = Booking::DECLINED;
        $booking->save();

        // create logs
        Log::store(Booking::DECLINED, $booking->reservedTo->name . ' declined your booking', $booking->book_by_id);
        Log::store(Booking::DECLINED, 'You declined '. $booking->bookBy->name. ' booking', $booking->reserved_to_id);

        return redirect("reservations/$booking->reserved_to_id")
                ->with('success', 'The booking has been declined!');
    }

    public function doneBooking(Booking $booking)
    {
        $booking->status = Booking::DONE;
        $booking->save();

        // create logs
        Log::store(Booking::DONE, $booking->reservedTo->name . ' mark your booking as done', $booking->book_by_id);
        Log::store(Booking::DONE, 'You mark '. $booking->bookBy->name. ' booking as done', $booking->reserved_to_id);

        return redirect("reservations/$booking->reserved_to_id")
                ->with('success', 'The booking has been done!');
    }

    public function createBooking(Package $package)
    {
        return view('user.booking.createBooking', ['package' => $package]);
    }

    public function store(BookingRequest $request)
    {
        $user = \Auth::user();

        Booking::create($request->all());

        // create logs
        Log::store(Booking::CREATED, 'You booked new package' , $user->id);
        Log::store(Booking::CREATED, $user->name .' booked your package', $request->reserved_to_id);

        return redirect()->route('myBookings', $user->id);
    }
}
