<div class="Videos">
  @if(!empty($videos))
    @foreach($videos as $video)
      <div class="item play">          
      <a href="#"><img src="{{URL::asset('uploads/' . @$video->image1)}}" width="100%" height="auto" alt=""></a>
      <span class="text-light d-block mt-2">{{@$video->title}}</span>
    <p><a href="#" class="text-dark">{{@$video->shortDescription}}</a></p>			
      </div>
    @endforeach
  @else
    <div><h2>No Videos Available..</h2></div>
  @endif
  </div>