@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($packages) > 0)
                @foreach($packages as $package)
                    <ul>
                        <li>
                            {{$package->name}}
                        </li>
                    </ul> 
                @endforeach
            @else
                <div class="alert alert-secondary">
                    No Packages Available
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
