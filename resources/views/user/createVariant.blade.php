@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello Create Variant</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ooopss!!</strong> There were some errors listed below
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/variant" method="post" enctype="multipart/form-data">
            @csrf

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="name ml-25">
                            Name <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-6 type">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="Food">Food</option>
                            <option value="Drinks">Drinks</option>
                        </select>
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
            </div><br>

            <a class="btn btn-danger w-25 text-center " style="float:right; margin-left: 6px"
                href="{{ route('myVariants', Auth::user()->id) }}">Back</a>
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
                console.log('Just a test!')

                fileReader.onload = function() {
                    $('#preview').attr('src', fileReader.result).css({
                        display: 'block',
                        height: '260px'
                    })

                }
                fileReader.readAsDataURL(event.target.files[0])
            })
        })

    </script>
@endsection
