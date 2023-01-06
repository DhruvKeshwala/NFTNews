@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Manage Pages</h3>
        </div>
        {{-- <div class="col-md-6 text-right">
            <a href="{{route('add_page')}}" class="btn btn-info">Add Page</a>
        </div> --}}
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $pages->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="44%">Page</th>
                    <th width="44%">Template</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($pages)<=0)
                <tr>
                    <td colspan="4" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($pages as $page)
                <tr>
                    <td>{{@$loop->index + 1}}</td>
                    <td>{{@$page->name}}</td>
                    <td>@if(@$page->selectTemplate == 'basicpage-layout') Basic-page Layout @elseif(@$page->selectTemplate == 'education') Education Layout  @endif</td>
                    <td>
                        <a title="Edit" href="{{ route('add_page',$page->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deletePage('{{$page->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <a href="{{ route('page_detail',$page->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $pages->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deletePage(id) {
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
                    url: "{{ url('siteadmin/delete_page') }}",
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