@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')
            <div class="col-10">
                <div class="container-fluid mb-3 " align="right">
                    <a class="btn btn-primary " href="{{ route('createVariant') }}">Add Variant</a>
                </div>

                <div class="row">
                    @if (count($variants) > 0)
                        @foreach ($variants as $variant)
                            <div class="col-md-4 mb-4">
                                <div class="card-rounded" style="width:20rem">
                                    <img class="card-img-top  img-fluid" style="height: 300px"
                                        src="{{ url('storage/img/' . $variant->image) }}" alt="card image">

                                    <div class="card-body">
                                        <h4 class="card-title text-center">{{ $variant->name }}</h4>
                                        <h4 class="card-title variant-description text-center">
                                            {{ $variant->description }}</h4>
                                            <a href="{{ route('editVariant', $variant) }}" class="btn btn-primary display-block w-100"> Update </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-secondary">
                            No Variants Available
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
