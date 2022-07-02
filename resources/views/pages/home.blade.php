@extends('layouts.app')


@section('title')
    .:Klinik PMB Lestari:.
@stop


@section('content')
    <!-- Header  -->
    <header class="text-center">
        <h1>
            The first wealth is health <br/>
            Thats our principal capital asset
        </h1>
        <p class="mt-3">
            "There's nothing more important than our good health"
        </p>
    </header>

    <main>
        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h2>Dokter Klinik</h2>
                        <p>
                            "I Stay at work for you, <br/>
                            you stay at home for us"
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="popularContent">
            <div class="container">
                <div class="section-popular-travel row justify-content-center">
                     @foreach($items as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel img-thumbnail text-center d-flex flex-column" style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">
                            <div class="travel-location">{{ $item->nama_dokter }}</div>
                            <div class="travel-button mt-auto">
                            <a href="{{ route('detail', $item->nama_dokter) }}" class="btn btn-travel-details px-4">
                                View Details
                            </a>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section-network" id="networks">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8 text-center">
                        
                    </div>
                </div>
            </div>
        </section>

        <section class="section-testimonial-heading" id="testimonialHeading">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>
                            They Are Loving  Us 
                        </h2>
                        <p>
                            Terimakasih telah memilih kami untuk <br/>
                            melayani kebutuhan kesehatan anda
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-testimonial-content" id="testimonialContent">
            <div class="container">
                <div class="section-popular-travel row justify-content-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/ic_language.png" alt="User" class="mb-4 rounded-circle">
                                <p class="testimonial">
                                    “The service is very satisfying from year to year,
                                    there is always improvement, Witdiyastuti doctors service is very good 
                                    in serving my family” <br/>
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                NONAME
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/ic_language.png" alt="User" class="mb-4 rounded-circle">
                                <p class="testimonial">
                                    “The service is very satisfying from year to year,
                                    there is always improvement, Witdiyastuti doctors service is very good 
                                    in serving my family” <br/>
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                NONAME
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card card-testimonial text-center">
                            <div class="testimonial-content">
                                <img src="frontend/images/ic_language.png" alt="User" class="mb-4 rounded-circle">
                                <p class="testimonial">
                                    “The service is very satisfying from year to year,
                                    there is always improvement, Witdiyastuti doctors service is very good 
                                    in serving my family” <br/>
                                </p>
                            </div>
                            <hr>
                            <p class="trip-to mt-2">
                                NONAME
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@stop
