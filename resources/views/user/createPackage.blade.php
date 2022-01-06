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
                            Name <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="price">
                            Price <input class="form-control " type="number" name="price" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="limit">
                            Limit <input class="form-control " type="number" name="limit" value="{{ old('limit') }}">
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <div class="description">
                            <p>Description</p>
                            <textarea class="form-control" name="description" id="description" cols="30"
                                rows="10">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="image">
                            Image <input type="file" id="image" name="image">
                        </div>
                        <img id="preview" class="form-control" style="display:none;" src="" alt="">
                    </div>
                </div><br>
                <div class="row">
                    <div class="variants">
                        Choose any of the following variants you created
                        <br>
                        @foreach ($data as $key => $types)
                            <div class="row">
                                <h2 class="mt-4">{{ $key }}</h2>
                                @foreach ($types as $element)
                                    <div class="col-md-4">
                                        @if(in_array($element->id, (old('variants')? old('variants'): [])))
                                        <input type="checkbox" name="variants[]" value={{ $element->id }} checked>
                                    @else
                                        <input type="checkbox" name="variants[]" value={{ $element->id }}>
                                @endif
                                <label for="">{{ $element->name }}</label><br>
                                <img class="card-img-top  img-fluid" style="height: 318px"
                                    src="{{ url('storage/img/' . $element->image) }}">
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
    </div><br>
    <a class="btn btn-danger w-25 text-center " style="float:right; margin-left: 6px"
        href="{{ route('myPackages', Auth::user()->id) }}">Back</a>
    <input type="submit" class="btn btn-primary w-25 text-center" style="float:right;" value="Submit">
    <br><br>
    <div class="userId">
        <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
    </div>
    </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(() => {
            $('#image').change(event => {
                let fileReader = new FileReader()

                fileReader.onload = function() {
                    // console.log(fileReader.result)
                    $('#preview').attr('src', fileReader.result).css({
                        display: 'block',
                        height: '260px'
                    })

                }
                // console.log(event.target)
                fileReader.readAsDataURL(event.target.files[0])
            })
        })

    </script>
@endsection
