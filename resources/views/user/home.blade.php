@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')

            <div class="col">
                <div class="container-fluid mb-3" align="right">
                    <a class="btn btn-primary" href="{{ route('createPackage') }}">Add Packages</a>
                </div>
                <div class="row">
                    @if (count($packages) > 0)
                        @foreach ($packages as $package)
                            <div class="col-md-4 mb-4">
                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                    <div>
                                        <div class="card rounded" style="width:20rem;">
                                            <img class="card-img-top img-fluid package-image rounded-top" style="height: 300px"
                                                src="{{ url('storage/img/' . $package->image) }}" alt="card image">
                                            <div class="card-body">
                                                <h4 class="card-title text-center">{{ $package->name }}</h4>
                                                <p class="text-danger h4 text-center price"> PHP {{ $package->price }}
                                                </p>
                                                <a href="{{ route('editPackage', $package) }}" class="btn btn-primary display-block w-100"> Update </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-secondary">
                            No Packages Available
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>







@endsection
