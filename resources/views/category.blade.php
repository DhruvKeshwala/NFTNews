@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
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
    {{ $category->links('vendor.pagination.custom') }}
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="24%">Name</th>
                    <th width="10%">Slug</th>
                    <th width="20%">Meta Title</th>
                    <th width="20%">Meta Description</th>
                    <th width="14%">Meta Keywords</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($category)<=0)
                <tr>
                    <td colspan="7" class="text-center"> No records found </td>
                </tr> 
                @endif
                @php
                    $page = app('request')->input('page');
                    $sr_no = $page==1 ? $page : $page * 10;
                @endphp
                @foreach($category as $categoryDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$categoryDetails->name}}</td>
                    <td>{{$categoryDetails->slug}}</td>
                    <td>{{$categoryDetails->title}}</td>
                    <td>{{$categoryDetails->description}}</td>
                    <td>{{$categoryDetails->keywords}}</td>
                    <td>
                        <a title="Edit" href="{{ route('add_category',$categoryDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a title="Delete" href="javascript:;" onclick="deleteCategory('{{$categoryDetails->id}}')" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a>
                    </td>
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