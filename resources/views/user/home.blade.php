@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')

            <div class="col">    
                @if (Session::has('errors'))
                    <div class="alert alert-danger">
                        <span>{{ Session::get('errors')->first() }}</span>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                                            <img class="card-img-top img-fluid package-image rounded-top"
                                                style="height: 300px" src="{{ url('storage/img/' . $package->image) }}"
                                                alt="card image">
                                            <div class="card-body">
                                                <h4 class="card-title text-center">{{ $package->name }}</h4>
                                                <p class="text-danger h4 text-center price"> PHP {{ $package->price }}
                                                </p>
                                                <div style="display: flex">
                                                    <div class="w-50 text-center">
                                                        <a href="{{ route('editPackage', $package) }}"
                                                            class="btn btn-primary display-block w-75"> Update </a>
                                                    </div>
                                                    <div class="w-50 text-center">
                                                        <form action="{{ route('deletePackage', $package) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger display-block w-75">
                                                                Delete </button>
                                                        </form>
                                                    </div>
                                                </div>
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
