<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Booking;
use Carbon\Carbon;

class BookingCancelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $booking = Booking::find(request()->booking);
        $date = Carbon::parse($booking->schedule)->subDays(2);
        request()->schedule = Carbon::now();

        return [
            'schedule' => 'required|date|before:'.$date->format('Y-m-d'),
        ];
    }
}
