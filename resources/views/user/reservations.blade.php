@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="container">
                    @if (count($reservations) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Package Name</th>
                                    <th>Booked By</th>
                                    <th>Scheduled Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $index => $reservation)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $reservation->package->name }}</td>
                                        <td>{{ $reservation->bookBy->name }}</td>
                                        <td>{{ $reservation->schedule->format('F j, Y') }}</td>
                                        <td>{{ $reservation->status }}</td>
                                        <td class="d-flex">
                                            @if ($reservation->status == 'pending' && $reservation->status != 'declined')
                                                <form method="post" action="/reservation/confirm/{{ $reservation->id }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-primary me-2" value="Accept">
                                                    @method('PATCH')
                                                </form>
                                                <form method="post" action="/reservation/declined/{{ $reservation->id }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger me-2" value="Declined">
                                                    @method('PATCH')
                                                </form>
                                            @elseif(($reservation->status != 'pending' && $reservation->status != 'declined')
                                                    && $reservation->status != 'done' && $reservation->status != 'cancelled')
                                                <form method="post" action="/reservation/done/{{ $reservation->id }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-success" value="Done">
                                                    @method('PATCH')
                                                </form>
                                            @else
                                                No Action required
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {!! $reservations->links() !!}
                        </div>
                    @else
                        <div class="alert alert-secondary">
                            No reservations for your packages as of now
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
