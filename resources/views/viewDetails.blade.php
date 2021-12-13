@extends('layouts.app')

@section('content')
    <div class="container-fluid package">
        <p class="package_name text-center"> {{ $package->name }} </p>
        <p class="text-danger h4 text-center price"> PHP {{ $package->price }} </p>
        <p class=" text-center"> {{ $package->user->name }} </p>

        <div class="row">

            <div class="col-6">
                <img src="{{ url('storage/img/' . $package->image) }}" class="d-block img-fluid w-100" alt="">
            </div>
            <div class="col-6">
                <br>
                <p> {{ $package->description }} </p>
                <a href="{{ route('createBooking', $package) }}" class="btn btn-warning">Book Now</a>
            </div>
        </div>
        <br><br>
    </div>
    <div class="container-fluid">
        <p class="text-center variant-title">Variants</p>

        <div class="row">
            @if (count($package->variants) > 0)
                @foreach ($package->variants as $variant)
                    <div class="col-md-4">
                        <div class="card variant">
                            <img class="card-img-top variant-image img-fluid"
                                src="{{ url('storage/img/' . $variant->image) }}" alt="card image">

                            <div class="card-body">
                            <h4 class="card-title text-center">{{ $variant->name }}</h4>
                            <h4 class="card-title variant-description text-center">{{ $variant->description }}</h4>

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
        <br>
    </div>
    <footer class="bg-black text-center text-white">
        <br>
        <img src="{{ url('/images/footerLogo.png') }}" class="rounded mx-auto d-block " alt="">
        <div class="container p-4">
            <section class="mb-4">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-youtube"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-twitter"></a>

            </section>
            <section class="mb-4">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
                    repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
                    eum harum corrupti dicta, aliquam sequi voluptate quas.
                </p>
            </section>

        </div>

        <div class="text-center p-3" style="background-color: gray;">
            © 2020 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
    <style>


        .variant {
            position: relative;
        }

        .variant-image {
            height: 200px;
            opacity: 1;
            display: block;
            /* width: 100%; */
            /* height: auto; */
            transition: .5s ease;
            backface-visibility: hidden;

        }

        .package {
            transition-delay: 2s;
            background-repeat: no-repeat;
            background-size: 100%;
            margin-top: -30px;
        }

        .variant-title {
            font-size: 40px;
            color: pink;
            text-shadow: 2px 2px 2px rgb(0 0 0 / 100%);

        }

        .package_name {
            /* font-family: "Great Vibes cursive" ; */
            font-family: fantasy;
            font-size: 36px;
            font-weight: 300;
            color: rgb(241, 20, 210);
            margin: 50px 0 10px;
            text-shadow: 1px 1px 1px rgb(150 150 150 / 90%);
        }

        .price {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-style: italic;
            font-weight: bold;
        }

    </style>
@endsection
