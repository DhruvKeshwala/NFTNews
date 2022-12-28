@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Videos</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_video')}}" class="btn btn-info">Add Video</a>
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        {{-- {{ $news->appends(Request::except('page'))->links('vendor.pagination.custom') }} --}}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_news') }}" method="get">
                @csrf
                <td class="pr-0"><input type="text" name="filterNewsTitle" size="45" placeholder="Title"></td>
                <td><select name="filterCategoryId" data-placeholder="Select Category">
                        <option value=""></option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" >{{ $category->name }}</option>
                        @endforeach
                    </select></td>
                <td><select name="filterAuthorId" data-placeholder="Select Author">
                        <option value=""></option>
                        @foreach($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                        @endforeach
                    </select></td>
                <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white"></td>
            </form>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="15%">News Title</th>
                    <th width="15%">Category</th>
                    <th width="13%">Author</th>
                    <th width="15%">Listed In</th>
                    <th width="15%">Posted On</th>
                    <th width="5%">Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{-- {{ $news->appends(Request::except('page'))->links('vendor.pagination.custom') }} --}}
</div>
@include('layouts.footer')
<script>
    $("select[name=\"filterCategoryId\"]").select2({
    });
    $("select[name=\"filterAuthorId\"]").select2({
    });
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
                    url: "{{ url('siteadmin/delete_news') }}",
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