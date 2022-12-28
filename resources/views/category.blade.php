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
    {{ $category->appends(Request::except('page'))->links('vendor.pagination.custom') }}
    <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_category') }}" method="get">
            @csrf
            <td class="pr-0"><input type="text" name="filterCategoryName" size="50" placeholder="Name" value="<?php 
                if (!empty($_GET['filterCategoryName'])) {
                    $q = $_GET['filterCategoryName'];
                    echo $q;
                } ?>"></td>
            <td class="pr-0"><input type="text" name="filterCategoryMetaTitle" size="50" placeholder="Meta Title" value="<?php 
                if (!empty($_GET['filterCategoryMetaTitle'])) {
                    $q = $_GET['filterCategoryMetaTitle'];
                    echo $q;
                } ?>"></td>
           {{-- <td class="pr-0"><input type="number" size="" placeholder="Meta Description"></td>
           <td class="pr-0"><select>
           	<option>Select</option>
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
           </select></td> --}}
            <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white"></td>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="34%">Name</th>
                    <th width="20%">Meta Title</th>
                    <th width="20%">Meta Description</th>
                    <th width="14%">Meta Keywords</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="showresults">
                @if (count($category)<=0)
                <tr>
                    <td colspan="6" class="text-center"> No records found </td>
                </tr> 
                @endif
                @php
                    $page  = app('request')->input('page');
                    $sr_no = $page==1 ? $page : $page * 10;
                @endphp
                @foreach($category as $categoryDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$categoryDetails->name}}</td>
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
    {{ $category->appends(Request::except('page'))->links('vendor.pagination.custom') }}
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
                    url: "{{ url('siteadmin/delete_category') }}",
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
    function filterCategory(){
        var filterCategoryName = $("input[name=\"filterCategoryName\"]").val();
        var filterCategoryMetaTitle = $("input[name=\"filterCategoryMetaTitle\"]").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('siteadmin/filter_category') }}",
            type: "GET",
            data: {
                filterCategoryName: filterCategoryName,
                filterCategoryMetaTitle:filterCategoryMetaTitle
            },
            dataType: "html",
            success: function(response) {
                console.log('success');
                // var data = JSON.parse(data);
                $('#showresults').html($('#showresults',response).html());
                //$('#showresults').html(response); //for perfect result but view changes of table!!!!!!

                // $.each(response, function (key, value) {
                //     $('#showresults').append("<tr>\
                //                 <td>"+value.column1+"</td>\
                //                 <td>"+value.column2y+"</td>\
                //                 <td>"+value.column3+"</td>\
                //                 </tr>");
                // })
            },
            error: function(xhr, status, error) {}
        });
    }
</script>