@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Guide</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Category</label></td>
                <td>
                    <select name="category" data-placeholder="Select Category">
                        <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == @$guide->category) selected  @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="guideId" value="{{@$id}}">
                    <div id="categoryError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Question</label></td>
                <td><textarea rows="5" cols="30" name="question" id="question" placeholder="Question">{{ @$guide->question }}</textarea><div id="questionError"></div></td>
            </tr>
            <tr>
                <td><label>Slug</label></td>
                <td>
                    <input type="text" value="{{@$guide->slug}}" name="slug" placeholder="Slug"><div id="slugError"></div>
                    <small>Note* : Please do not enter special characters and space in slug</small>
                </td>
            </tr>
            <tr>
                <td><label>Answer</label></td>
                <td><textarea rows="5" cols="30" name="answer" id="answer" placeholder="Answer">{{ @$guide->answer }}</textarea><div id="answerError"></div></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveGuide()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('guide') }}" class="btn btn-danger">Cancel</a>
                </td>
            </tr>
        </table>
        <div class="clearfix"></div>
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    CKEDITOR.replace( 'answer', {
        fullPage: false,						
        allowedContent: false,
        width: '98%',height: '200px',
        filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    function saveGuide() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var category             = $("select[name='category']").val();
        var question        = $("#question").val();
        var answer        = $("#answer").val();
        var slug        = $("input[name=\"slug\"]").val();
        var answerValidate = CKEDITOR.instances['answer'].getData().replace(/<[^>]*>/gi, '').length;
        var answer = CKEDITOR.instances['answer'].getData();
        var guideId = $("input[name='guideId']").val();
        const regexExp = /^[a-z0-9]+(?:-[a-z0-9]+)*$/g;

        var fd = new FormData();
        if(guideId == ''){
            guideId = 0;
        }
        fd.append('category', category);
        fd.append('question', question);
        fd.append('answer', answer);
        fd.append('guideId', guideId);
        fd.append('slug', slug);
        if (category == '' || category == null) 
        {
            flag = 0;
            $("#categoryError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
        }
        if (question == '') 
        {
            flag = 0;
            $("#questionError").html('<span class="errorMessage" style="color:red;">Question Required</span>');
        } 
        if (slug == '') 
        {
            flag = 0;
            $("#slugError").html('<span style="color:red;">Slug Required</span>');
        } 
        else if(!regexExp.test(slug))
        {
            flag = 0;
            $("#slugError").html('<span style="color:red;">Remove special character & space from slug</span>');
        }
        if (answer == '') 
        {
            flag = 0;
            $("#answerError").html('<span class="errorMessage" style="color:red;">Answer Required</span>');
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
                url: "{{ url('siteadmin/save_guide') }}",
                type: "POST",
                data:fd,
                cache: false,
                processData: false,
                contentType: false,
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
                                window.location.href =  "{{ URL::to('siteadmin/guide') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>