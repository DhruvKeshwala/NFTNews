@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Press Release</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_pressRelease')}}" class="btn btn-info">Add Press Release</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $pressRelease->links('vendor.pagination.custom') }}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_pressRelease') }}" method="get">
                <td class="pr-0"><input type="text" name="filterPressTitle" size="45" placeholder="Title" value="<?php 
                if (!empty($_GET['filterPressTitle'])) {
                    $q = $_GET['filterPressTitle'];
                    echo $q;
                } ?>"></td>
                <td><select name="filterCategoryId" data-placeholder="Select Category">
                        <option value="">Select Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ @$category->id }}" <?php 
                            if (!empty($_GET['filterCategoryId']) && $_GET['filterCategoryId'] == @$category->id) 
                            {
                            ?>   selected
                            <?php } ?>>{{ @$category->name }}</option>
                        @endforeach
                    </select></td>
                <td>
                    <input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white">
                    <a href="{{ route('pressRelease')}}"  class="btn btn-danger py-1 px-2 text-white">Reset</a>
                </td>
            </form>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="38%">Press-Release Title</th>
                    <th width="15%">Category</th>
                    {{-- <th width="13%">Author</th> --}}
                    {{-- <th width="15%">Listed In</th> --}}
                    <th width="15%">Posted On</th>
                    <th width="5%">Order Index</th>
                    <th width="5%">Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count(@$pressRelease)<=0)
                <tr>
                    <td colspan="8" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($pressRelease as $pressReleaseDetails)
                    @php 
                        @$selection_types = '';
                        @$imgsrc = $pressReleaseDetails -> image;
                        @$dateArray = json_decode(@$pressReleaseDetails->pressType,true);
                    @endphp
                    @foreach(config('constant.press_type') as $key=>$presstype)
                        @if (!empty($dateArray[$key]['start_date']) && !empty($dateArray[$key]['end_date']))
                            @php
                                @$selection_types .= $presstype.', ';
                            @endphp                            
                        @endif                        
                    @endforeach
                <tr>
                    <td>{{@$loop->index + 1}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/').'/'. @$imgsrc}}" width="100" alt="{{ @$pressReleaseDetails->image1_alt }}"> @else <span>—</span> @endif</td>
                    <td>{{@$pressReleaseDetails->title}}</td>
                    <td>{{@$pressReleaseDetails->category}}</td>
                    {{-- <td>{{$pressReleaseDetails->author->name}}</td> --}}
                    {{-- <td>
                        {{ rtrim( $selection_types, ', ') }}
                    </td> --}}
                    <td>{{ @$pressReleaseDetails->created_at->format('d-m-Y') }}</td>
                    <td class="text-center">@if(@$pressReleaseDetails->orderIndex != null || @$pressReleaseDetails->orderIndex == ''){{@$pressReleaseDetails->orderIndex}} @else <span>0</span> @endif</td>
                    <td align="center">
                        @if ($pressReleaseDetails->fld_status=='Active')
                            <a href="{{ route('press_updateStatus',@$pressReleaseDetails->id)}}" class="text-success"><span class="fa fa-check"></span></a>
                        @else
                            <a href="{{ route('press_updateStatus',@$pressReleaseDetails->id)}}" class="text-danger"><span class="fa fa-times"></span></a>
                        @endif
                    </td>
                    <td>
                        <a title="Edit" href="{{ route('add_pressRelease',@$pressReleaseDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript::void(0)" onclick="deletePressRelease('{{@$pressReleaseDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <a href="{{ route('pressRelease_detail',@$pressReleaseDetails->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $pressRelease->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deletePressRelease(id) {
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
                    url: "{{ url('siteadmin/delete_pressRelease') }}",
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