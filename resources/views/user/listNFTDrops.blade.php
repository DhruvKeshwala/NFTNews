@extends('layouts.user.header')

@section('title', 'NFT Markets | NFT Drop')

@section('content')
<section class="hero-wrap hero-wrap-2">
    <div class="overlay"></div>
    <div class="container">
    <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate">
        <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>NFT Drop</span></p>
        </div>
    </div>
    </div>
</section>

<section class="ftco-section pb-0 drops-section">
    <div class="container">
        <table class="table border text-dark table-responsive-sm table-striped table-borderless">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Name</th>
                    <th>Token</th>
                    <th>Blockchain</th>
                    <th>Price of Sale</th>
                    <th>Sale Date</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if(@$allDropManagement)
                @foreach($allDropManagement as $dropManagement)
                    <tr>
                    <td><img src="{{URL::asset('uploads/' . @$dropManagement->logo) }}" class="rounded-pill" width="34" height="34" alt="" /></td>
                    <td>{{@$dropManagement->name}}</td>
                        <td>{{@$dropManagement->token}}</td>
                        <td><strong>{{@$dropManagement->blockChain}}</strong></td>
                        <td>{{@$dropManagement->priceOfSale}}</td>
                        <td>{{@$dropManagement->saleDate}}</td>
                        <td><a href="{{@$dropManagement->twitterLink}}" target="_blank"><i class="fa fa-twitter mr-3"></i> <a href="{{@$dropManagement->discordLink}}" target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
                @else
                <p>No Data Found..</p>
                @endif
            </tbody>
        </table>
    </div>
</section>

@endsection