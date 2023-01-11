@extends('layouts.user.header')

@section('title', 'NFT Markets | NFT Drops')

@section('content')
    <section class="hero-wrap hero-wrap-2">
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate">
                    <p class="breadcrumbs mb-0"><span><a href="{{ route('user.home') }}">Home</a><i
                                class="fa fa-angle-right"></i></span><span>NFT Drops</span></p>
                </div>
            </div>
        </div>
    </section>
    <div class="container news-banner mb-3"><a href="#" class="text-dark"><img src="{{ URL::asset('uploads/banner/' . @$banners->image)}}" width="100%" height="auto" alt=""></a></div>
    <section class="ftco-section pt-0 pb-5 bg-info-gradient">
        <form action="{{ route('user.filter_nftdrops') }}" id="nft_form" method="POST">
            @csrf
            <div class="container">

                <div class="row my-2">

                    <div class="col-md-12 text-right py-4">
                        <input type="hidden" name="filterValue" id="filterValue" value="{{ @$filterParam }}">

                        <a href="{{ route('user.submitnft') }}"
                            class="rounded px-4 btn bg-white btn-outline-light-gradient border mt-md-n5 pb-2">SUBMIT NFT</a>
                    </div>
                    @php
                    // dd($filterValue);
                    @endphp
                    <div class="col-md-4 d-flex">
                        <a onclick="filterForNFTDrops('upcoming')" class="page-link py-3 {{ @$filterParam == 'upcoming' ? 'active' : '' }}">UPCOMING</a>
                        <a onclick="filterForNFTDrops('past')" class="py-3 page-link px-4 mx-2 {{ @$filterParam == 'past' ? 'active' : '' }}">PAST</a>
                        <a onclick="filterForNFTDrops('mostPopular')" class="py-3 page-link px-4 {{ @$filterParam == 'mostPopular' ? 'active' : '' }}">MOST POPULAR</a>
                    </div>

                    <div class="col-md-3 px-0">
                        <div class="form-group d-flex searchform border mb-0 mx-0 bg-white">
                            <input type="text" name="nft_search" value="{{ @$nftsearch }}"
                                class="form-control text-center" placeholder="SEARCH NFT DROPS">
                            <button type="submit" placeholder="" class="form-control w-auto"><span
                                    class="fa fa-search text-light"></span></button>
                        </div>
                    </div>

                    <div class="col-md-2 text-right pr-0">
                        <select class="form-control" id="filternftcategoryValue" name="filternftcategoryValue"
                            onchange="filterForNFTDrops('category')">
                            <option value="">Select Categories</option>
                            {{-- <option value="all" {{ @$filterValue == 'all' || @$filterValue == '' || @$filterValue == null ? 'selected' : '' }}>
                                All</option> --}}
                            @foreach ($categories as $category)
                                <option value="{{ @$category->id }}"
                                    {{ @$filterValue == @$category->id ? 'selected' : '' }}>{{ @$category->name }}</option>
                            @endforeach
                            {{-- <option value="avalanche">Avalanche</option> --}}
                        </select>
                    </div>
                    {{-- <div class="col-md-3 text-right">
            <div class="block-27 pt-2">
              <ul>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
           </div> --}}

                </div>
                <br>
                {{ @$allDropManagement->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}

                {{-- <div class="row">
                <div class="col-md-12 mt-5 text-center">
                    <div class="tag-widget post-tag-container">
                        <div class="tagcloud">
                          <a style="cursor:pointer;" onclick="filterForNFTDrops('all')" class="{{ @$filterValue == 'all' || @$filterValue == ''  ? "active" : "" }}">All</a>
                            @foreach ($categories as $category)
                            <a style="cursor:pointer;" onclick="filterForNFTDrops('{{ $category->id }}')" class="{{ @$filterValue == $category->id ? "active" : "" }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div> --}}
            </div>
        </form>
    </section>

    <section class="ftco-section pt-0 pb-5">
        <div class="container">
            <div class="row d-flex">
                @if (@$allDropManagement)
                    @foreach ($allDropManagement as $dropManagement)
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="blog-entry rounded shadow align-self-stretch">
                                {{-- {{ $dropManagement->start_date }} --}}
                                @if ($dropManagement->start_date && $dropManagement->end_date)
                                    <span class="badge_featured badge-light text-light">Featured</span>
                                @endif
                                <a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}" class="block-30 rounded"
                                    style="background-image: url(@if($dropManagement->image != null) {{ URL::asset('uploads/' . @$dropManagement->image) }} @else {{ URL::asset('images/default-image-1.png') }} @endif);">
                                </a>
                                <div class="text px-4 mt-3 text-center">

                                    <h3 class="heading pt-3"><a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}">{{ @$dropManagement->name }}</a>
                                    </h3>
                                    <div class="row pb-4">
                                        <div class="col-md-6 pb-3 text-left">
                                            <a href="{{ @$dropManagement->twitterLink }}" class="btn-sm bg-light"><i
                                                    class="fa fa-twitter" title="Twitter"></i></a>
                                            <a href="{{ @$dropManagement->websiteLink }}" class="btn-sm bg-light"><i
                                                    class="fa fa-globe" title="Website"></i></a>
                                            <a href="{{ @$dropManagement->discordLink }}" class="btn-sm bg-light"><i
                                                    class="fa fa-github-alt" title="Discord" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="col-md-5 ml-auto text-right">
                                            <small class="btn-light py-1 px-2 rounded"><i class="fa fa-calendar"></i>
                                                {{ @$dropManagement->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div class="col-md-6 pr-0 text-left">
                                            <span class="text-dark"><strong>Blockchain</strong> <span
                                                    class="text-black-50">|</span>
                                                {{ @$dropManagement->blockChain }}</span><br>
                                            {{-- <span class="text-dark"><strong>Supply</strong> <span
                                                    class="text-black-50">|</span>
                                                {{ @$dropManagement->priceOfSale }}</span><br> --}}
                                            <span class="text-dark"><strong>Price</strong> <span
                                                    class="text-black-50">|</span>{{ @$dropManagement->priceOfSale }}</span>
                                        </div>

                                        <div class="col-md-6 pt-1 text-right">
                                            <a href="#" class="btn btn-outline-light-gradient border py-1 mb-2 w-100"
                                                style="font-size: 12px;">Add to Calendar</a>
                                            <a href="{{ route('user.nftDrop_detail', ['id' => @$dropManagement->slug]) }}"
                                                class="btn btn-outline-light-gradient border w-100 py-1 mb-2"
                                                style="font-size: 12px;">View Project</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
