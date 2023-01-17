<div class="featured-drops owl-carousel ftco-owl ">
    @if(!empty($videos))
      @foreach($videos as $video)
        <figure class="effect-lily video-section item play">
          <figcaption>
          <span class="badge_featured badge-light text-light">Featured</span>
          <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}"><img
                  src="{{ URL::asset('uploads/' . @$video->image1) }}" width="100%"
                  height="auto" alt="{{ @$video->title}}"></a>
          
              <p class="text-center" style="margin-bottom: 10px !important;"><a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5 js-anchor-link" data-toggle="modal" data-target="#myModal-{{@$video->id}}">Watch Now</a> <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" class="btn btn-primary border py-1 mt-n5">View Details</a></p>
          </figcaption>       
          <span class="text-light d-block"
              title="{{ @$video->title }}">{{ substr(@$video->title, 0, 30) }}..</span>
          {{-- <p class="text-justify"><a
                  href="{{ route('user.video_detail', ['id' => @$video->slug]) }}"
                  title="{{ @$video->shortDescription }}"
                  class="text-dark">{{ substr(@$video->shortDescription, 0, 40) }}..</a>
          </p> --}}
      </figure>
      @endforeach
    @else
      <div><h2>No Videos Available..</h2></div>
    @endif
</div>


<a href="{{ route('user.videos') }}" class="btn d-block btn-outline-light py-2 mt-4">More Videos</a>