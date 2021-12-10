@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello Create Variant</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Ooopss!!</strong> There were some errors listed below
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/variant" method="post" enctype="multipart/form-data">
            @csrf

            <div class="name">
                Name <input type="text" name="name">
            </div>

            <div class="type">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="Food">Food</option>
                    <option value="Drinks">Drinks</option>
                </select>
            </div>

            <div class="userId">
                <input name="user_id" type="hidden" value={{Auth::user()->id}}>
            </div>

            <div class="description">
                <textarea name="description" id="description" cols="30" rows="10"></textarea>
            </div>

            <div class="image mb-3">
                Image <input type="file" name="image">
            </div>

            <input type="submit" value="Submit">



        </form>
    </div>
@endsection