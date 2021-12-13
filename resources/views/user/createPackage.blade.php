@extends ('layouts.app')

@section('content')
    <div class="container-fluid w-75">
        <h1 class="text-center"> Create Package</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ooopss!!</strong> There were some errors as listed below.
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/package" enctype="multipart/form-data">
            @csrf

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="name ml-25">
                            Name <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="price">
                            Price <input class="form-control " type="text" name="price">
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <div class="description">
                            <p>Description</p>
                            <textarea class="form-control" name="description" id="description" cols="30"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="image">
                            Image <input type="file" name="image">
                        </div>
                        <img src="" alt="">
                    </div>
                </div><br>
                <div class="row">
                    <div class="variants">
                        Choose any of the following variants you created
                        <br>
                        @foreach ($data as $element)
                            <input type="checkbox" name="variants[]" value={{ $element->id }}>
                            <label for="">{{ $element->name }}</label><br>
                        @endforeach
                    </div>
                </div>
            </div>




            <input type="submit" value="Submit">






            <div class="userId">
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
            </div>




        </form>
    </div>
@endsection
