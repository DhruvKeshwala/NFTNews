@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Category</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_category')}}" class="btn btn-info">Add Category</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">

        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Meta Keywords</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category as $categoryDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$categoryDetails->name}}</td>
                    <td>{{$categoryDetails->slug}}</td>
                    <td>{{$categoryDetails->title}}</td>
                    <td>{{$categoryDetails->description}}</td>
                    <td>{{$categoryDetails->keywords}}</td>
                    <td><a href="{{ route('add_category',$categoryDetails->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a> <a onclick="deleteCategory('{{$categoryDetails->id}}')" class="btn btn-sm btn-danger"><i class="fa fa-trash" style="color:white;"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>

    </div>
    {{ $category->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteCategory(id) {
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
                    url: "{{ url('delete_category') }}",
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