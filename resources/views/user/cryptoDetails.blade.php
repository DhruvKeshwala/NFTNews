@extends('layouts.user.header')

@if(@$cryptoDetail->metaTitle != null)
  @section('title', @$cryptoDetail->metaTitle)
@else
  @section('title', 'NFT Markets | Crypto Journal')
@endif

@section('content')

<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="index.html">Home</a><i class="fa fa-angle-right"></i></span><span>Crypto Journal</span></p>
          </div>
          
        </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-animate bg-info-gradient-3">
     <div class="container">
       <div class="row">
			<div class="col-md-12">
             
             <h1 class="mb-4 text-center">{{@$cryptoDetail->title}}</h1>
             
             <div id="book1-trigger" class="text-center">
             	<img style="cursor:pointer" src="{{ URL::asset('uploads/' . @$cryptoDetail->image) }}" width="auto" height="500">
             </div>
             <div style="display: none">
	         	<div id="book1"></div>
             </div>
             
             <div class="text-center mt-4">
             	<a href="{{URL::asset('uploads/' . @$cryptoDetail->pdf) }}" target="_blank" class="btn btn-outline-light-gradient bg-white border">DOWNLOAD PDF HERE</a>
             </div>
            
             <div class="text-left my-4 text-justify">
                {!! @$cryptoDetail->fullDescription !!}
            </div>
           </div>
           
           {{-- <div class="col-md-3 pl-md-0">
            @if($banners->size == "280 x 400 pixels")
              <div class="sidebar-box">
                  <a href="{{$banners->url}}" target="_blank"><img src="{{ URL::asset('uploads/banner/' . $banners->image) }}"
                          width="100%" height="auto" alt=""></a>
              </div>
            @endif --}}
            {{-- <div class="sidebar-box">
                <a href="#" target="_blank"><img src="{{URL::asset('images/side-banner.png') }}" width="100%" height="auto" alt=""></a>
             </div>         --}}
          </div>      	
       </div>
     </div>
    </section>	
    
    <!-- Quick View -->
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">  
          <!-- Modal content-->     
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title"><i class="fa fa-calendar"></i> December 15, 2022</h6>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Blockchain Bandicoots Are Coming</h4>
                <p><strong>Company</strong> | Blockchain Bandicoots<br>
                <strong>Price</strong> | 0.2 ETH<br>
                <strong>Supply</strong> | 5000</p>
                
                <p>Blockchain Bandicoot™ is a collection of 5,000 unique NFTs living on the Ethereum blockchain. Bandicoot Guardians are the protectors of the Blockchain World, Burokuchen. An evil mastermind named Korruption has infected the Blockchain, Korrupting Bandicoots all across their world.</p>
            </div>
         </div>
  
        </div>
    </div>
@endsection

@section('script')
<!-- Custom Theme JavaScript -->
  <script type="text/javascript" src="{{ URL::asset('wow_book/pdf.combined.min.js')}}"></script>
  <link rel="stylesheet" href="{{ URL::asset('wow_book/wow_book.css')}}" type="text/css" />
  <script type="text/javascript" src="{{ URL::asset('wow_book/pdf.combined.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('wow_book/wow_book.min.js')}}"></script>
<script type="text/javascript">
    
    $(function () {

      function fullscreenErrorHandler() {
        if (self != top) return "The frame is blocking full screen mode. Click on 'remove frame' button above and try to go full screen again."
      }
      var optionsBook1 = {
        height: 1236
        , width: 800 * 2
        // ,maxWidth : 800
        // ,maxHeight : 800
        , pageNumbers: false

        , pdf: "{{ URL::asset('uploads/' . @$cryptoDetail->pdf) }}"
        , pdfFind: true

        , lightbox: "#book1-trigger"
        , lightboxClass: "lightbox-pdf"
        , centeredWhenClosed: true
        , hardcovers: true
        , curl: false
        , toolbar: "lastLeft, left, currentPage, right, download, lastRight, zoomin, zoomout, slideshow, flipsound, fullscreen, thumbnails"
        , thumbnailsPosition: 'bottom'
        , responsiveHandleWidth: 50

        , onFullscreenError: fullscreenErrorHandler
      };


      var books = {
        "#book1": optionsBook1,
      };
      $("#book1-trigger").on("click", function () {
        buildBook("#" + this.id.replace("-trigger", ""));
      })

      function buildBook(elem) {
        var book = $.wowBook(elem);
        if (!book) {
          $(elem).wowBook(books[elem]);
          book = $.wowBook(elem);
        }
        // book.opts.onHideLightbox = function(){
        //     setTimeout( function(){ book.destroy(); }, 1000);
        // }
        book.showLightbox();
      }


    });
  </script>

@endsection