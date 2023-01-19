@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Banner</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('add_banner') }}" class="btn btn-info">Add Banner</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $data->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_banner') }}" method="get" id="bannerSearchForm">
                @csrf
                <td class="pr-0">
                <select name="filterSize" data-placeholder="Select Banner Size">
                        <option value="">Banner Size</option>
                        <option value="280 x 400 pixels" <?php 
                            if (!empty($_GET['filterSize']) && $_GET['filterSize'] == '280 x 400 pixels') 
                            {
                            ?>   selected
                            <?php } ?>>280 x 400 pixels</option>
                        <option value="375 x 400 pixels" <?php 
                            if (!empty($_GET['filterSize']) && $_GET['filterSize'] == '375 x 400 pixels') 
                            {
                            ?>   selected
                            <?php } ?>>375 x 400 pixels</option>
                        <option value="900 x 200 pixels" <?php 
                            if (!empty($_GET['filterSize']) && $_GET['filterSize'] == '900 x 200 pixels') 
                            {
                            ?>   selected
                            <?php } ?>>900 x 200 pixels</option>
                        <option value="1210 x 210 pixels" <?php 
                            if (!empty($_GET['filterSize']) && $_GET['filterSize'] == '1210 x 210 pixels') 
                            {
                            ?>   selected
                            <?php } ?>>1210 x 210 pixels</option>
                    </select>
                    
                </td>
                <td>
                    <select name="location" data-placeholder="Select Banner Location">
                        <option value="">Select Banner Location</option>
                        @foreach(config('constant.banner_location') as $key=>$bannerlocation)
                        <option value="{{ $key }}" <?php 
                            if (!empty($_GET['location']) && $_GET['location'] == @$key) 
                            {
                            ?>   selected
                            <?php } ?>>{{$bannerlocation}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white">
                    <a href="{{ route('banner')}}"  class="btn btn-danger py-1 px-2 text-white">Reset</a>
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
                    <th width="54%">Size</th>
                    <th width="20$">Location</th>
                    <th width="4%">URL</th>
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
                        $bannerlocation = config('constant.banner_location'); 
                        $selection_types = '';
                        $imgsrc = $row->image;
                    @endphp
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/banner/').'/'.$imgsrc}}" width="100">@endif</td>
                    <td>{{$row->size}}</td>
                    <td>{{$bannerlocation[$row->location]}}</td>
                    <td class="text-center"><a href="{{$row->url}}" title="View URL" target="_blank">
                        <span class="fa fa-play fa-lg"></span>
                    </a></td>
                    <td>
                        <a title="Edit" href="{{ route('add_banner',$row->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a title="Delete" href="javascript:;" onclick="deleteBanner('{{$row->id}}')" class="text-danger mr-2">
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
function resetFormFields() {
  document.getElementById("bannerSearchForm").reset();
}
</script>
<script>
    $("select[name=\"filterSize\"]").select2({
    });
    $("select[name=\"location\"]").select2({
    });
    function deleteBanner(id) {
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
                    url: "{{ url('siteadmin/delete_banner') }}",
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