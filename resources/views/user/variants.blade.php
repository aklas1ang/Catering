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
                    @if (Session::has('errors'))
                        <div class="alert alert-danger">
                            <span>{{ Session::get('errors')->first() }}</span>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <span>{{ Session::get('success') }}</span>
                        </div>
                    @endif
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
                                        <div class="w-100 text-center"
                                            style="display: grid;grid-template-columns: 1fr 1fr;">
                                            <div>
                                                <a href="{{ route('editVariant', $variant) }}"
                                                    class="btn btn-primary display-block w-75"> Update </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('deleteVariant', $variant) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger display-block w-75"> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
