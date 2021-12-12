<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class BookingRequest extends FormRequest
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
        $date = Carbon::now()->addDays(3);
        return [
            'package_id' => 'required|exists:packages,id',
            'book_by_id' => 'required|exists:users,id',
            'reserved_to_id' => 'required|exists:users,id',
            'schedule' => 'required|date|after:'.$date->format('Y-m-d'),
        ];
    }
}
