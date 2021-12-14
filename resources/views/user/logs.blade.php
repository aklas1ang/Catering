@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            @include('user.navigation')
            @if ($errors->count())
                @dd($errors)
            @endif
            <div class="col-md-10">
                <div class="container">
                    <h3>My Logs</h3>
                </div>
                <div class="container">
                    @if (!$logs->count())
                        <div class="alert alert-secondary">
                            No Logs!
                        </div>
                    @else
                        <table class="table table-bordered table-hover">
                            <thead class="">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Created At</th>
                                    {{-- <th scope="col">Status</th> --}}
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr scope="row">
                                        <td>{{ strtoupper($log->type) }}</td>
                                        <td>{{ $log->message }}</td>
                                        <td>{{ $log->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            const dateNow = (new Date()).toLocaleDateString();
            const scheduleInputs = $('.schedule').toArray();
            scheduleInputs.forEach(schedule => {
                $(schedule).val(dateNow)
            })
        })

    </script>
@endsection
