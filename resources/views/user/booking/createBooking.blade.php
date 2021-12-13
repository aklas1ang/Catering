@extends('layouts.app')

@section('css')
<link href="{{ asset('css/user/booking.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div id="alert-error" style="display: none;" class="alert alert-danger">
        <span id="times-close">&times;</span>
        <span>Something went wrong</span>
    </div>
</div>

<div class="container">
    <h1>{{ $package->name }}</h1>
</div>

<div class="container">
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <input type="hidden" name="book_by_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <input type="hidden" name="reserved_to_id" value="{{ $package->user->id }}">
        <div class="form-group">
            <label for="">Schedule</label>
            <input type="date" class="form-control" name="schedule" id="" value="{{ old('schedule') }}">
            @if($errors->has('schedule'))
                <small class="error-msg">*{{ $errors->first('schedule') }}</small>
            @endif
        </div>
        <div class="container text-center">
            <button type="submit" class="btn btn-warning mt-3">Submit</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#times-close').click(() => {
            $('#alert-error').hide()
        })
    })
</script>
@endsection
