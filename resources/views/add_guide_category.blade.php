@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Guide Category</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">

        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Name</label></td>
                <td><input type="text" value="{{@$category->name}}" name="name" placeholder="Name"><input type="hidden" name="categoryId" value="{{@$id}}"><div id="nameError"></div></td>
            </tr>
            <!-- <tr>
                <td><label>Slug</label></td>
                <td><input type="text" value="{{@$category->slug}}" name="slug" placeholder="Slug"><div id="slugError"></div></td>
            </tr> -->
            <tr>
                <td><label>Meta Title</label></td>
                <td><input type="text" value="{{ @$category->title }}" name="title" placeholder="Meta Title"><div id="titleError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Description</label></td>
                <td><textarea rows="5" cols="30" name="description" id="description" placeholder="Meta Description">{{@$category->description}}</textarea><div id="descriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Keywords</label></td>
                <td><textarea rows="5" cols="30" name="keywords" id="keywords" placeholder="Meta Keywords">{{ @$category->keywords }}</textarea><div id="keywordsError"></div></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveCategory()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('guide_category') }}" class="btn btn-danger">Cancel</a>
                </td>
            </tr>
        </table>


        <div class="clearfix"></div>

    </div>


</div>

<!-- Footer -->
@include('layouts.footer')
<script>
    function saveCategory() 
    {
        //Remove validation errors
        $('.errorMessage').hide();
        var flag = 1;
        var name = $("input[name=\"name\"]").val();
        //var slug = $("input[name=\"slug\"]").val();
        var title = $("input[name=\"title\"]").val();
        var description = $("#description").val();
        var keywords = $("#keywords").val();
        var categoryId = $("input[name=\"categoryId\"]").val();        
        if(categoryId == '')
        {
            categoryId = 0;
        }        
        if (name == '') 
        {
            flag = 0;
            $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        }        
        if (title == '') 
        {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
        }
        if (description == '') 
        {
            flag = 0;
            $("#descriptionError").html('<span class="errorMessage" style="color:red;">Description Required</span>');
        }
        if (keywords == '') 
        {
            flag = 0;
            $("#keywordsError").html('<span class="errorMessage" style="color:red;">Keywords Required</span>');
        } 
        if(flag == 1) 
        {
            var saveBtn                 = document.getElementById("saveBtn");
            saveBtn.innerHTML           = "Wait..";
            $('#saveBtn').addClass('disabled');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('siteadmin/save_guide_category') }}",
                type: "POST",
                data: {
                    name: name,
                    categoryId: categoryId,
                    title: title,
                    description: description,
                    keywords:keywords,
                },
                // dataType: 'json',
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.success) {
                        //enable the button
                        saveBtn.innerHTML           = "SAVE";
                        $('#saveBtn').removeClass('disabled');
                        swal({
                            title: "Success!",
                            text: data.message + " :)",
                            icon: "success",
                            buttons: 'OK'
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.href =  "{{ URL::to('siteadmin/guide_category') }}"
                            }
                        })

                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>