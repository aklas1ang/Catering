@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-10">
                <div class="container">
                    @if (count($reservations) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Package Name</th>
                                    <th>Booked By</th>
                                    <th>Scheduled Date</th>
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
                                        <td class="d-flex">
                                            @if ($reservation->status == 'pending')
                                                <form method="post" action="/reservation/confirm/{{ $reservation->id }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-primary me-2" value="Accept">
                                                    @method('PATCH')
                                                </form>
                                                <form method="post" action="/reservation/decline/{{ $reservation->id }}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger" value="Decline">
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
