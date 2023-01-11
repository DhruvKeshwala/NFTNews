@extends('layouts.user.header')

@section('title', 'NFT Markets | Guide')

@section('content')
    <style>
        .tagLink {
            cursor: pointer;
        }
    </style>

    <section class="hero-wrap hero-wrap-2">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate">
                    <p class="breadcrumbs mb-0"><span><a href="{{ route('user.home') }}">Home</a><i
                                class="fa fa-angle-right"></i></span><span>Guide</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section py-5 bg-info-gradient-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar-box bg-transparent ftco-animate">
                        <div class="categories">
                            <h3>Articles in this section</h3>
                            @if (count($guides))
                                @foreach ($guides as $guide)
                                    <a href="{{ url('guideList/' . @$guide->category . '/' . @$guide->slug) }}"
                                        class="btn btn-outline-light d-block border my-2 <?php if ($guide->slug == $slug) {
                                            echo 'active';
                                        } ?>">
                                        {!! @$guide->question !!}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row d-flex">
                        <div class="col-md-12 mb-4 pt-5 ftco-animate">
                          @if ($guideDetail)
                            <h2>{!! $guideDetail->question !!}</h2>
                            <p>{!! $guideDetail->answer !!}</p>
                          @else
                            <h2>No Record found</h2>
                          @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection