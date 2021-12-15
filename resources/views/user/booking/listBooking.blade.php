@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')
            @if ($errors->count())
                @dd($errors)
            @endif
            <div class="col-md-10">
                <div class="container">
                    <h3>My Bookings</h3>
                </div>
                <div class="container">
                    @if (!$bookings->count())
                        <div class="alert alert-secondary">
                            No Bookings Yet!
                        </div>
                    @else
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
                                @foreach ($bookings as $booking)
                                    <tr scope="row">
                                        <td>{{ $booking->package->name }}</td>
                                        <td>{{ $booking->schedule }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if ($booking->status == 'cancelled' || $booking->status == 'done' || $booking->status == 'declined')
                                                No Action required
                                            @else
                                                <form action="{{ route('cancelBooking', $booking) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="schedule" class="schedule">
                                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $bookings->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            const dateNow = (new Date()).toLocaleDateString();
            const scheduleInputs = $('.schedule').toArray();
            scheduleInputs.forEach(schedule => {
                $(schedule).val(dateNow)
            })
        })

    </script>
@endsection
