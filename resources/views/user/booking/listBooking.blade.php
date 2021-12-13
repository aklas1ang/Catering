@extends('layouts.app')

@section('content')
    @if($errors->count())
        @dd($errors)
    @endif
    <!-- <div class="container">
        <div class="alert alert-danger">
            <span>Something went wrong</span>
        </div>
    </div> -->
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
                    <th scope="col">Action</th>
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
                        <td>{{ $booking->package->name }}</td>
                        <td>{{ $booking->schedule }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <form action="{{ route('cancelBooking', $booking) }}" method="POST">
                                @csrf
                                <input type="hidden" name="schedule">
                                <button type="submit" class="btn btn-danger">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
@endsection
