@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>My Bookings</h3>
    </div>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead class="">
                <tr>
                    <th scope="col">Package Name</th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @if(!$bookings->count())
                    <tr>
                        <td colspan="3" class="text-center">No data!</td>
                    </tr>
                @endif
                @foreach($bookings as $booking)
                    <tr scope="row">
                        <td>{{ $booking->package }}</td>
                        <td>{{ $booking->schedule }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
@endsection
