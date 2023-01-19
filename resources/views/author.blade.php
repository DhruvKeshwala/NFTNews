@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Author</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('add_author') }}" class="btn btn-info">Add Author</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $data->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_author') }}" method="get">
                @csrf
                <td class="pr-0"><input type="text" name="filterAuthorName" size="45" value="<?php 
                if (!empty($_GET['filterAuthorName'])) {
                    $q = $_GET['filterAuthorName'];
                    echo $q;
                } ?>" placeholder="Name"></td>
                <td class="pr-0"><input type="text" name="filterEmail" size="45" placeholder="Email" value="<?php 
                if (!empty($_GET['filterEmail'])) {
                    $q = $_GET['filterEmail'];
                    echo $q;
                } ?>"></td>
                <td class="pr-0"><input type="text" name="filterMobile" size="10" placeholder="Mobile" value="<?php 
                if (!empty($_GET['filterMobile'])) {
                    $q = $_GET['filterMobile'];
                    echo $q;
                } ?>"></td>
                <td>
                    <input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white">
                    <a href="{{ route('author')}}"  class="btn btn-danger py-1 px-2 text-white">Reset</a>
                </td>
            </form>
                {{-- <td class="pr-0"><input type="number" size="" placeholder="Meta Description"></td>
           <td class="pr-0"><select>
           	<option>Select</option>
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
           </select></td> --}}
           {{-- <td>
           	<a onclick="filterCategory()" class="btn btn-dark py-1 px-2 text-white"><span class="fa fa-search fa-lg"></span></a>
           </td> --}}
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="26%">Name</th>
                    <th width="12%">Email</th>
                    <th width="12%">Mobile</th>
                    <th width="28%">Short Bio</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data)<=0)
                <tr>
                    <td colspan="7" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($data as $row)
                    @php 
                        $selection_types = '';
                        $imgsrc = $row->image;
                    @endphp
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/').'/'.$imgsrc}}" width="100">@endif</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->mobile}}</td>
                    <td>{{$row->short_bio}}</td>
                    <td>
                        <a title="Edit" href="{{ route('add_author',$row->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a title="Delete" href="javascript:;" onclick="deleteAuthor('{{$row->id}}')" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $data->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
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
</script>