@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($bookings) > 0)
            <table class="table">
                <thead>
                    
                </thead>
            </table>
        @else
            <div class="alert alert-secondary">
                You don't have any bookings as of now
            </div>
        @endif
    </div>
@endsection