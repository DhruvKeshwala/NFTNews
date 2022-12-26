<div class="Newses">
  @if(count($allNews))
    @foreach($allNews as $news)
      <div class="story-wrap p-0 blog-entry d-md-flex align-items-center">
          <a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-dark"><div class="img" style="background-image: url({{ URL::asset('uploads/' . @$news->image)}});"></div></a>
          <div class="text pl-md-3">
            <div class="meta mb-2">
                <div><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="meta-chat">INDUSTRY TALK</a></div>
                <div><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}"><span class="fa fa-clock"></span> {{ @$news->created_at->diffForHumans() }}</a></div>
              </div>
              <h4><a href="{{ route('user.news_detail', ['id' => base64_encode(@$news->id)]) }}" class="text-dark">{{ @$news->title }}</a></h4>
              <p>{{ @$news->shortDescription }}</p>
          </div>
      </div>
    @endforeach
  @else
      <h2>No Data Found For This Category..</h2>
  @endif
</div>