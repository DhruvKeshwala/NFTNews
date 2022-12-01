@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>News</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_news')}}" class="btn btn-info">Add News</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $newsDetails)
                @php 
                $imgsrc = $newsDetails -> image;
                @endphp
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$newsDetails->category}}</td>
                    <td>{{$newsDetails->title}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/').'/'.$imgsrc}}" width="100">@endif</td>
                    <td><a title="Edit" href="{{ route('add_news',$newsDetails->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a> <a onclick="deleteNews('{{$newsDetails->id}}')" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-trash" style="color:white;"></i></a> <a href="{{ route('news_detail',$newsDetails->id)}}" title="View Detail" class="btn btn-sm btn-primary fancybox fancybox.iframe" class=" text-success"  id="fancybox-manual-b" ><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $news->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteNews(id) {
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
                    url: "{{ url('delete_news') }}",
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
</script>