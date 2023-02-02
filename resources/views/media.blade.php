@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Media</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('add_media') }}" class="btn btn-info">Add Media</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        @if (count(@$media)<=0)
            <h1> No records found </h1>
        @endif
        
        <div class="row d-flex">
            @foreach($media as $value)
                @php
                    $imgsrc = $value->image;
                @endphp
                <div class="col-md-3 d-flex ftco-animate rounded">
                    <div class="blog-entry rounded shadow pb-0 w-100 align-self-stretch">
                        
                        @if($imgsrc != null || $imgsrc != '')<img src="{{asset('uploads/').'/'.$imgsrc}}" height="250px"; width="100%" class="card-img" alt="{{ @$value->image_alt }}"> @else <span>Media Image</span> @endif
                        <h5>{{@$value->image}}</h5>
                        <br>
                        <div class = "btn-group">
                            <a href="{{ route('media_detail',$value->id)}}" title="View Info." class="fa fa-eye fa-lg text-dark fancybox fancybox.iframe" id="fancybox-manual-b">View</a>
                            <a  href="{{ route('add_media',$value->id)}}" class="fa fa-edit fa-lg btn btn-primary text-white pull-right">Edit</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
</div>
@include('layouts.footer')
{{-- <script>
    function deleteAuthor(id) {
        swal({
            title: "Warning!",
            text: "Are you sure? You want to delete it",
            icon: "warning",
            buttons: ['No,cancel it','Yes,delete it'],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('siteadmin/delete_author') }}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.success) {
                            swal({
                                title: "Success!",
                                text: data.message + " :)",
                                icon: "success",
                                buttons: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            }
        });
    }
</script> --}}