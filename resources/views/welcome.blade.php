@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        <div class="text-center">
            <img src="{{ url('/images/logo.PNG') }} " alt="">
        </div> <br>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="height: 550px">
                <div class="carousel-item active w-100">
                    <img src="{{ url('/images/Capture.PNG') }} " class="d-block w-100" alt="Image" />
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/images/slide2.png') }} " class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ url('/images/slide3.png') }} " class="d-block w-100 " alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container">
            <div class="popPack text-center">
                <p id="popPack">Most Popular Packages</p>
                <img src="{{ url('/images/line.png') }}" alt="">
            </div>

            <div class="row d-flex justify-content-center">
                @if (count($packages) > 0)
                    @foreach ($packages as $package)
                        <div class="col-md-4">
                            <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                <div class="mainflip">
                                    <div class="frontside">
                                        <div class="card rounded" style="width:23rem;">
                                            <img class="card-img-top img-fluid package-image rounded-top"
                                            src="{{ url('storage/img/' . $package->image) }}"
                                                alt="card image">
                                            <div class="card-body">
                                                <h4 class="card-title text-center">{{ $package->name }}</h4>
                                                <h6 class="card-title text-center">{{ $package->user->name }}</h6>
                                                <p class="text-danger h4 text-center price"> PHP {{ $package->price }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="backside" style="background-image: url('/images/sample.png')">
                                        <div class="card" style="width:23rem;">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $package->name }}</h4>
                                                <p class="card-text description">{{ $package->description }}
                                                </p>
                                                <a href="{{ route('viewDetails', $package) }}"
                                                    class="btn btn-primary">View Details</a>
                                                <a href="{{ route('createBooking', $package) }}" class="btn btn-warning">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="alert alert-secondary">
                        No Packages Available
                    </div>
                @endif
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

            {{-- <section class="">
                    <form action="">
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <p class="pt-2">
                                    <strong>Sign up for our newsletter</strong>
                                </p>
                            </div>

                            <div class="col-md-5 col-12">
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="form5Example2" class="form-control" />
                                    <label class="form-label" for="form5Example2">Email address</label>
                                </div>
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-light mb-4">
                                    Subscribe
                                </button>
                            </div>
                        </div>
                    </form>
                </section> --}}

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

        .package-image{
            height: 250px;
        }

        .description {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .fa {
            margin: 10px;
        }

        .price {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-style: italic;
            font-weight: bold;
        }

        .card-title {
            font-weight: bold;
        }

        .popPack p {
            /* font-family: "Great Vibes cursive" ; */
            font-family: fantasy;
            font-size: 36px;
            font-weight: 300;
            color: rgb(241, 20, 210);
            margin: 50px 0 10px;
            text-shadow: 1px 1px 1px rgb(150 150 150 / 90%);
        }

        .image-flip:hover .backside,
        .image-flip.hover .backside {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
            -o-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            transform: rotateY(0deg);
        }

        .image-flip:hover .frontside,
        .image-flip.hover .frontside {
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }

        .image-flip {
            margin-bottom: 200px;
            width: 300px;
            height: 250px;
        }

        .mainflip {
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -ms-transition: 1s;
            -moz-transition: 1s;
            -moz-transform: perspective(1000px);
            -moz-transform-style: preserve-3d;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
            position: relative;
        }

        .frontside,
        .backside {
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -ms-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -moz-transition: 1s;
            -moz-transform-style: preserve-3d;
            -o-transition: 1s;
            -o-transform-style: preserve-3d;
            -ms-transition: 1s;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
            position: absolute;
            top: 0;
            left: 0;
        }

        .frontside {
            -webkit-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            z-index: 2;
        }

        .backside {
            background: white;
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            -o-transform: rotateY(-180deg);
            -ms-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
        }

        .card,
        .card-img-top {
            border-radius: 0;
        }

    </style>

@endsection
