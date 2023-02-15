@extends('layouts.user.header')

@section('title', 'NFT Markets | Markets')

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
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Market News</span></p>
          </div>
          
        </div>
      </div>
    </section>

<div class="container news-banner mb-3">
  @if(@$marketTopBanner->location != null)
      <a href="{{@$marketTopBanner->url}}" class="text-dark" target="_blank"><img
      src="{{ URL::asset('uploads/' . @$marketTopBanner->image) }}" width="100%"
      height="auto" @if($marketTopBanner->banner_image_alt != null || $marketTopBanner->banner_image_alt != '') alt="{{@$marketTopBanner->banner_image_alt}}" @else alt="Top Banner Image" @endif></a>
  @endif
</div>
<section class="ftco-section py-5 bg-info-gradient">
       <div class="container">
       <form action="{{ route('user.filter_marketsNews') }}" id="market_form" method="GET">
        {{-- @csrf --}}
         <div class="row">
            
            <div class="col-md-4 d-flex">
              <input type="hidden" name="filterValue" id="filterValue" value="{{@$filterValue}}">
              <a onclick="filterForMarkets('all')" id="allData" class="page-link py-3 {{ @$filterValue == 'all' || @$filterValue == '' ? 'active' : '' }}">ALL</a> <a onclick="filterForMarkets('latest')" class="py-3 page-link px-4 mx-2 {{ @$filterValue == 'latest' ? 'active' : '' }}">LATEST</a> <a onclick="filterForMarkets('featured')" class="py-3 page-link px-4 {{ @$filterValue == 'featured' ? 'active' : '' }}">FEATURED</a>
            </div>
            
            <div class="col-md-3 px-0">
              {{-- <form action="#" class="w-100"> --}}
                <div class="form-group d-flex bg-white searchform border mb-0 mx-0">
                  <input type="text" name="search" class="form-control text-center" placeholder="SEARCH NEWS" value="{{@$search}}">
                  <button type="submit" placeholder="" class="form-control w-auto"><span class="fa fa-search text-light"></span></button>
                </div>
              {{-- </form> --}}
            </div>

          <div class="col-md-2 text-right pr-0">
          <select class="form-control" id="filternftcategoryValue" name="filternftcategoryValue" onchange="filterForMarkets('category')">
            <option value="">Select Categories</option>
            {{-- <option value="all" {{ @$filtercategoryId == 'all' || @$filtercategoryId == ''  ? "selected" : "" }}>All</option> --}}
            @foreach($categories as $category)
                <option value="{{base64_encode(@$category->id)}}" {{ base64_encode(@$filtercategoryId) == base64_encode(@$category->id)  ? "selected" : "" }}>{{@$category->name}}</option>
            @endforeach
            {{-- <option value="avalanche">Avalanche</option> --}}
          </select>
          </div>
          </div>
        </form>
          <br> 
          <div>
            {{ $getAllNewses->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
          </div>
      </div>
    </section>
    
    @php
        $i = 1;
        $ln = 0;
        $ln2 = 0;
        $sb = 0;
        $bz = 0;
        $sbcount = count($banners_small);
        $bzcount = count($banners_horizontal);
    @endphp
    <section class="ftco-section pt-0 pb-5">
      <div class="container">
      <div class="row d-flex">
                @if (count(@$getAllNewses))
                    @foreach ($getAllNewses as $news)
                        @if ($i == 5 || $i - $ln == 5)
                            {{-- Ad Banner small --}}
                            <div class="col-md-4 d-flex ftco-animate rounded">
                                <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                                    @if($sbcount == 0)
                                    <span><img src="{{ URL::asset('user/images/middle-list-ads.jpg') }}"
                                            width="100%" @if($banners_small[$sb]['banner_image_alt'] != null || $banners_small[$sb]['banner_image_alt'] != '') alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" @else alt="Middle Ad Banner" @endif class="img-fluid"></span>
                                    @else 
                                    <a href="{{@$banners_small[$sb]['url']}}"><img src="{{ URL::asset('uploads/'.@$banners_small[$sb]['image']) }}"
                                            width="100%" @if($banners_small[$sb]['banner_image_alt'] != null || $banners_small[$sb]['banner_image_alt'] != '') alt="{{ @$banners_small[$sb]['banner_image_alt'] }}" @else alt="Middle Ad Banner" @endif class="img-fluid"></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse(@$news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $ln = $i;
                                $sb++;
                                if($sb>=$sbcount)
                                {
                                    $sb = 0;
                                }
                            @endphp
                        @elseif($i == 6 || $i - $ln2 == 5)
                            {{-- horizontal Ad --}}
                            <div class="col-md-12 d-flex mb-4 ftco-animate">
                                    @if($bzcount == 0)
                                    <span><img src="{{ URL::asset('user/images/banner-full-width.jpg') }}" width="100%"
                                    height="auto" class="img-fluid rounded" @if($banners_horizontal[$bz]['banner_image_alt'] != null || $banners_horizontal[$bz]['banner_image_alt'] != '') alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}" @else alt="Horizontal Banner Image" @endif></span>
                                    @else 
                                    <a href="{{ @$banners_horizontal[$bz]['url'] }}"><img src="{{ URL::asset('uploads/'.@$banners_horizontal[$bz]['image']) }}" width="100%"
                                    height="auto" class="img-fluid rounded" 
                                    @if($banners_horizontal[$bz]['banner_image_alt'] != null || $banners_horizontal[$bz]['banner_image_alt'] != '') alt="{{@$banners_horizontal[$bz]['banner_image_alt']}}" @else alt="Horizontal Banner Image" @endif
                                    ></a>
                                    @endif
                            </div>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse(@$news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $ln2 = $i;
                                $bz++;
                                if($bz >= $bzcount)
                                {
                                    $bz = 0;
                                }
                            @endphp
                        @else
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry rounded shadow align-self-stretch">
                                    <a href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                        class="block-30 rounded"
                                        @if(@$news->image4 != null || @$news->image4 != '' || file_exists($news->image4) == true)
                                            style="background-image: url({{ URL::asset('uploads/' . @$news->image4) }});"
                                        @else
                                            style="background-image: url({{ URL::asset('images/default-news-with-banner-section.png') }});"
                                        @endif
                                        >
                                    </a>
                                    <div class="text px-4 mt-3">
                                        <h3 class="heading"><a
                                                href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}">{{ $news->title }}</a>
                                        </h3>
                                        <div class="mb-5">
                                            <div class="float-left"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="meta-chat">Admin</a></div>
                                            <div class="float-right"><a
                                                    href="{{ route('user.news_detail', ['category'=> @$news->category->name,'id' => @$news->slug]) }}"
                                                    class="text-light"><span class="fa fa-calendar"></span> {{ \Carbon\Carbon::parse(@$news->publish_date)->diffForHumans(\Carbon\Carbon::now()) }} </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php      $i++;   @endphp
                    @endforeach
                @endif
            </div>
        <div>
            {{ $getAllNewses->appends(Request::except('page'))->links('vendor.pagination.userCustom') }}
        </div>
      </div>
    </section>

    @endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>

      // $(document).ready(function(){
      //   $("#categoryList").change(function () {
      //       console.log("you selected..");
      //   });
      // });


    	$(function () {
		  $(".ddl-select").each(function () {
			$(this).hide();
			var $select = $(this);
			var _id = $(this).attr("id");
			var wrapper = document.createElement("div");
			wrapper.setAttribute("class", "ddl ddl_" + _id);
		
			var input = document.createElement("input");
			input.setAttribute("type", "text");
			input.setAttribute("class", "ddl-input");
			input.setAttribute("id", "ddl_" + _id);
			input.setAttribute("readonly", "readonly");
			input.setAttribute(
			  "placeholder",
			  $(this)[0].options[$(this)[0].selectedIndex].innerText
			);
		
			$(this).before(wrapper);
			var $ddl = $(".ddl_" + _id);
			$ddl.append(input);
			$ddl.append("<div class='ddl-options ddl-options-" + _id + "'></div>");
			var $ddl_input = $("#ddl_" + _id);
			var $ops_list = $(".ddl-options-" + _id);
			var $ops = $(this)[0].options;
			for (var i = 0; i < $ops.length; i++) {
			  $ops_list.append(
				"<div data-value='" +
				  $ops[i].value +
				  "'>" +
				  $ops[i].innerText +
				  "</div>"
			  );
			}
		
			$ddl_input.click(function () {
			  $ddl.toggleClass("active");
			});
			$ddl_input.blur(function () {
			  $ddl.removeClass("active");
			});
			$ops_list.find("div").click(function () {
			  $select.val($(this).data("value")).trigger("change");
			  $ddl_input.val($(this).text());
			  $ddl.removeClass("active");
			});
		  });
		});
    </script>

  <script>
  	const $menu = $('#navbarToggleExternalContent');
	$menu.on('show.bs.collapse', function () {
	  $menu.addClass('menu-show');
	});
	
	$menu.on('hide.bs.collapse', function () {
	  $menu.removeClass('menu-show');
	});
  </script>
  
  <!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

  <!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>

  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
  
  <script>
 	(function(){
  
  var shareButtons = document.querySelectorAll(".share-btn");

  if (shareButtons) {
      [].forEach.call(shareButtons, function(button) {
      button.addEventListener("click", function(event) {
 				var width = 650,
            height = 450;

        event.preventDefault();

        window.open(this.href, 'Share Dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width='+width+',height='+height+',top='+(screen.height/2-height/2)+',left='+(screen.width/2-width/2));
      });
    });
  }

})();



  </script>
@endsection