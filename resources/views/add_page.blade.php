@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Page</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Template Type</label></td>
                <td>
                    <select name="selectTemplate" data-placeholder="Select Template Type">
                        <option value="">Select Template Type</option>
                        <option value="education" {{ @$page->selectTemplate == 'education' ? 'selected' : '' }}>1. Single Column Template</option>
                        <option value="basicpage-layout" {{ @$page->selectTemplate == 'basicpage-layout' ? 'selected' : '' }}>2. Two Columns Template</option>
                    </select>
                    <div id="selectTemplateError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Page Name</label></td>
                <td>
                    @if(@$id != 0)
                        <input type="text" value="{{@$page->name}}" name="name" placeholder="Name" disabled>
                    @else
                        <select name="name" data-placeholder="Select From Below Pages">
                            <option value="">Select Page</option>
                            <option value="Services" {{ @$page->slug == 'services' ? 'selected' : '' }}>Services</option>
                            <option value="Education" {{ @$page->slug == 'education' ? 'selected' : '' }}>Education</option>
                            <option value="Partners" {{ @$page->slug == 'partners' ? 'selected' : '' }}>Partners</option>
                            <option value="Privacy Policy" {{ @$page->slug == 'privacy-policy' ? 'selected' : '' }}>Privacy Policy</option>
                            <option value="Terms & Conditions" {{ @$page->slug == 'terms-and-conditions' ? 'selected' : '' }}>Terms & Conditions</option>
                            <option value="GDPR" {{ @$page->slug == 'gdpr' ? 'selected' : '' }}>GDPR</option>
                            <option value="Terms Of Services" {{ @$page->slug == 'terms-of-service' ? 'selected' : '' }}>Terms Of Service</option>
                            <option value="Investment And Funding" {{ @$page->slug == 'investment-and-funding' ? 'selected' : '' }}>Investment & Funding</option>
                            <option value="Media Enquiries" {{ @$page->slug == 'media-enquiries' ? 'selected' : '' }}>Media Enquiries</option>
                            <option value="Careers" {{ @$page->slug == 'careers' ? 'selected' : '' }}>Careers</option>
                            <option value="About" {{ @$page->slug == 'about' ? 'selected' : '' }}>About</option>

                        </select>
                        
                    @endif
                    <div id="nameError"></div>
                    {{-- <input type="text" value="{{@$page->name}}" name="name" placeholder="Name"> --}}
                    <input type="hidden" name="pageId" value="{{@$id}}">
                </td>
            </tr>
            <tr>
                <td><label>Title</label></td>
                <td>
                    <input type="text" value="{{@$page->title}}" name="title" placeholder="Title">
                    <div id="titleError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Meta Title</label></td>
                <td>
                    <input type="text" value="{{@$page->metaTitle}}" name="metaTitle" placeholder="Meta Title">
                    <div id="metaTitleError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Meta Description</label></td>
                <td><textarea rows="5" cols="30" name="description" id="description" placeholder="Meta Description">{{@$page->description}}</textarea><div id="descriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Keywords</label></td>
                <td><textarea rows="5" cols="30" name="keywords" id="keywords" placeholder="Meta Keywords">{{@$page->keywords}}</textarea><div id="keywordsError"></div></td>
            </tr>
            <tr>
                <td><label>Contents</label></td>
                <td><textarea rows="5" cols="30" name="contents" id="contents" placeholder="Contents">{!!@$page->contents!!}</textarea><div id="contentsError"></div></td>
            </tr>
            <tr>
                <td><label>Image 1</label></td>
                <td>
                    <input type="file" name="image1" id="image1">
                    @if(@$page->image1 != '')
                        <div><img src="{{asset('uploads/').'/'.@$page->image1}}" width = "100"></div>
                    @endif
                    <div id="image1Error"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 2</label></td>
                <td>
                    <input type="file" name="image2" id="image2">
                    @if(@$page->image2 != '')
                        <div><img src="{{asset('uploads/').'/'.@$page->image2}}" width = "100"></div>
                    @endif
                    <div id="image2Error"></div>
                </td>
            </tr>
            <tr>
                <td><label>Upload Social Banner</label></td>
                <td>
                    <input type="file" name="uploadSocialBanner" id="uploadSocialBanner">
                    @if(@$page->uploadSocialBanner != '')
                    <div><img src="{{asset('uploads/').'/'.@$page->uploadSocialBanner}}" width = "100"></div>
                    @endif
                    <div id="uploadSocialBannerError"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="savePage()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('managePages') }}" class="btn btn-danger">Cancel</a>
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
    $("select[name=\"selectTemplate[]\"]").select2({
    });
    CKEDITOR.replace( 'contents', {
                fullPage: true,						
                allowedContent: true,
                width: '98%',height: '200px',
                filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            } );
    function savePage() 
    {
        $('.errorMessage').hide();
        var pageId = $("input[name='pageId']").val();
        if(pageId == ''){
            pageId = 0;
        }
        var flag = 1;
        var selectTemplate = $("select[name='selectTemplate']").val();
        
        if(pageId == 0)
        {
            var name           = $("select[name='name']").val();
        }
        else
        {
           var name = $("input[name='name']").val(); 
        }
        // var name = $("input[name='name']").val();
        var title = $("input[name='title']").val();
        var metaTitle = $("input[name='metaTitle']").val();
        var description = $("#description").val();
        var keywords = $("#keywords").val();
        var contentsValidate = CKEDITOR.instances['contents'].getData().replace(/<[^>]*>/gi, '').length;
        var contents = CKEDITOR.instances['contents'].getData();

        var fd = new FormData();
        
        // Append data 
        var files = $('#image1')[0].files;
        if(files.length > 0)
        {
            fd.append('image1',files[0]);
        }
        var files = $('#image2')[0].files;
        if(files.length > 0)
        {
            fd.append('image2',files[0]);
        }
        fd.append('selectTemplate', selectTemplate);
        
        fd.append('name', name);
        
        fd.append('title', title);
        fd.append('metaTitle', metaTitle);
        fd.append('description', description);
        fd.append('keywords', keywords);
        fd.append('contents', contents);
        fd.append('pageId', pageId);

        // Append article 1 
        var files = $('#uploadSocialBanner')[0].files;
        if(files.length > 0)
        {
            fd.append('uploadSocialBanner',files[0]);
        }
        
        if (selectTemplate == '' || selectTemplate == null) 
        {
            flag = 0;
            $("#selectTemplateError").html('<span class="errorMessage" style="color:red;">Template Type Required</span>');
        }
        if (name == '' || name == null) 
        {
            flag = 0;
            $("#nameError").html('<span class="errorMessage" style="color:red;">Page Name Required</span>');
        }
        if (title == '' || title == null) 
        {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
        }
        if (metaTitle == '' || metaTitle == null) 
        {
            flag = 0;
            $("#metaTitleError").html('<span class="errorMessage" style="color:red;">Meta Title Required</span>');
        }
        if (description == '' || description == null) 
        {
            flag = 0;
            $("#descriptionError").html('<span class="errorMessage" style="color:red;">Description Required</span>');
        }
        if (keywords == '' || keywords == null) 
        {
            flag = 0;
            $("#keywordsError").html('<span class="errorMessage" style="color:red;">Keywords Required</span>');
        }
        if (contents == '' || contents == null) 
        {
            flag = 0;
            $("#contentsError").html('<span class="errorMessage" style="color:red;">Contents Required</span>');
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
                url: "{{ url('siteadmin/save_page') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/managePages') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>