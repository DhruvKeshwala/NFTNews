<div class="featured-drops owl-carousel ftco-owl ">
    @if(!empty($videos))
      @foreach($videos as $video)
        <div class="item play">          
        <a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}"><img src="{{URL::asset('uploads/' . @$video->image1)}}" width="100%" height="auto" alt="{{@$video->title}}"></a>
        <span class="text-light d-block mt-2" title="{{@$video->title}}">{{substr(@$video->title, 0, 30)}}..</span>
      <p class="text-justify"><a href="{{ route('user.video_detail', ['id' => @$video->slug]) }}" title="{{ @$video->shortDescription }}" class="text-dark">{{substr(@$video->shortDescription, 0, 40)}}..</a></p>			
        </div>
      @endforeach
    @else
      <div><h2>No Videos Available..</h2></div>
    @endif
</div>


<a href="{{ route('user.videos') }}" class="btn d-block btn-outline-light py-2 mt-4">More Videos</a>