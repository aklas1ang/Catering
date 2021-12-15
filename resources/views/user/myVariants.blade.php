@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('inc.sidebar')
            <div class="col">
                <a href="/variant/create" class="btn btn-primary">Add Button</a>
                @if(count($variants) > 0)
                    <div class="container row">
                        @foreach($variants as $variant)
                            <div class="col-md-3">
                                <p>{{$variant->name}}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-secondary">
                        No Variants created as of now
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection