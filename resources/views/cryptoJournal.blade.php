@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Crypto Journal Management</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_crypto')}}" class="btn btn-info">Add Crypto Journal</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $crypto->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_crypto') }}" method="get">
                @csrf
                <td class="pr-0"><input type="text" name="filterNewsTitle" size="100" placeholder="Title" value="<?php 
                if (!empty($_GET['filterNewsTitle'])) {
                    $q = $_GET['filterNewsTitle'];
                    echo $q;
                } ?>"></td>
                
                <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white"></td>
            </form>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="73%">Title</th>
                    <th width="5%">Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
            @if (count($crypto)<=0)
                <tr>
                    <td colspan="4" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($crypto as $newsDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>@if($newsDetails->image != null)<img src="{{asset('uploads/').'/'.$newsDetails->image}}" width="100">@endif</td>
                    <td>{{$newsDetails->title}}</td>
                    <td align="center">
                        @if ($newsDetails->fld_status=='Active')
                            <a title="Active" href="{{ route('crypto_updateStatus',$newsDetails->id)}}" class="text-success"><span class="fa fa-check"></span></a>
                        @else
                            <a title="Draft" href="{{ route('crypto_updateStatus',$newsDetails->id)}}" class="text-danger"><span class="fa fa-times"></span></a>
                        @endif
                    </td>
                    <td>
                        <a title="Edit" href="{{ route('add_crypto',$newsDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deleteCrypto('{{$newsDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $crypto->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteCrypto(id) {
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
                    url: "{{ url('siteadmin/delete_crypto') }}",
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