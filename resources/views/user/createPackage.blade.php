@extends ('layouts.app')

@section('content')
    <div class="container">
        <h1>Hello Create Package</h1>

         @if($errors->any())

            <div class="alert alert-danger">
               <strong>Ooopss!!</strong> There were some errors as listed below.
                  @foreach($errors->all() as $error)
                     <li>{{$error}}</li>
                  @endforeach
            </div>

         @endif

        <form method="POST" action="/package" enctype="multipart/form-data">
            @csrf
             <div class="name">
                Name <input type="text" name="name">
             </div>
             <div class="description">
                <p>Description</p>
                <textarea name="description" id="" cols="30" rows="10"></textarea>
             </div>
             <div class="price">
                Price <input type="text" name="price">
             </div>
             <div class="userId">
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
             </div>

            <div class="variants">
               Choose any of the following variants you created
               <br>
               @foreach($data as $element)
                  <input type="checkbox" name="variants[]" value={{$element->id}}>
                  <label for="">{{$element->name}}</label><br>
               @endforeach
            </div>

             <div class="image">
                Image <input type="file" name="image">
             </div>
             <input type="submit" value="Submit">
        </form>
    </div>
@endsection