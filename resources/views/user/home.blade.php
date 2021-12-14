@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('inc.sidebar')
            <div class="col">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    @if (count($packages) > 0)
                                        @foreach ($packages as $package)
                                            <ul>
                                                <li>
                                                    {{ $package->name }}
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
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        ...
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">...
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">...
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
