@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Crypto Journal</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <input type="hidden" name="newsId" value="{{@$id}}">
            <tr>
                <td><label>Title</label></td>
                <td><input type="text" value="{{ @$crypto->title }}" name="title" placeholder="Title"><div id="titleError"></div></td>
            </tr>
            <tr>
                <td><label>Slug</label></td>
                <td>
                    <input type="text" value="{{@$crypto->slug}}" name="slug" placeholder="Slug"><div id="slugError"></div>
                    <small>Note* : Please do not enter special characters and space in slug</small>
                </td>
            </tr>
            <tr>
                <td><label>Short Description</label></td>
                <td><textarea rows="5" cols="30" name="shortDescription" id="shortDescription" placeholder="Short Description">{{@$crypto->shortDescription}}</textarea><div id="shortDescriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Full Description</label></td>
                <td><textarea rows="5" cols="30" name="fullDescription" id="fullDescription" placeholder="Full Description">{{ @$crypto->fullDescription }}</textarea><div id="fullDescriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Image</label><small class="text-muted">Choose Image size of 270x380 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$crypto->image }}" placeholder="Upload Image" id="image" 
                                name="image" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$crypto->image != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$crypto->image }}" width="100"></div>
                            @endif
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('image')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('image')" data-id="image" class="btn btn-danger remove-image">Remove</a>
                        </div>
                        <div id="imageError"></div>
                    </div>
                    {{-- <input type="file" name="image" id="image">
                    @if(@$crypto->image != '')
                    <div><img src="{{ URL::asset('uploads/').'/'.@$crypto->image}}" width = "100"></div>
                    @endif
                    
                    <div id="imageError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Image alt</label></td>
                <td>
                   <input type="text" value="{{ @$crypto->image_alt }}" name="image_alt" placeholder="Image alt tag"></div>
                </td>
            </tr>
            <tr>
                <td><label>PDF</label></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$crypto->pdf }}" placeholder="Upload Image" id="pdf" 
                                name="pdf" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$crypto->pdf != '')
                                <div><a href="{{ URL::asset('uploads/') . '/' . @$crypto->pdf }}" target="_blank">Download</a></div>
                            @endif
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('pdf')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('pdf')" data-id="pdf" class="btn btn-danger remove-image">Remove</a>
                        </div>
                        <div id="pdfError"></div>
                    </div>
                    {{-- <input type="file" name="pdf" id="pdf">
                    @if(@$crypto->pdf != '')
                    <div><a href="{{ URL::asset('uploads/') . '/' . @$crypto->pdf }}" target="_blank">Download</a></div>
                    @endif
                    
                    <div id="pdfError"></div> --}}
                </td>
            </tr>
             <tr>
                <td><label>Order Index</label></td>
                <td><input type="number" value="{{ @$crypto->orderIndex != null || @$crypto->orderIndex != 0  ? @$crypto->orderIndex : 0 }}" name="orderIndex" placeholder="Order Index Number">
                    <div id="orderIndexError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Meta Title</label></td>
                <td><input type="text" value="{{ @$crypto->metaTitle }}" name="metaTitle" placeholder="Meta Title"><div id="metaTitleError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Description</label></td>
                <td><textarea rows="5" cols="30" name="description" id="description" placeholder="Meta Description">{{@$crypto->description}}</textarea><div id="descriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Keywords</label></td>
                <td><textarea rows="5" cols="30" name="keywords" id="keywords" placeholder="Meta Keywords">{{ @$crypto->keywords }}</textarea><div id="keywordsError"></div></td>
            </tr>
           
            <tr>
                <td><label>Upload Social Banner</label><small class="text-muted">Choose Image size of 530x330 pixels</small><br><small class="text-muted">Home Page | Cryptonaire Weekly | Latest Edition Live Image</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$crypto->uploadSocialBanner }}" placeholder="Upload Image" id="uploadSocialBanner" 
                                name="uploadSocialBanner" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$crypto->uploadSocialBanner != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$crypto->uploadSocialBanner }}" width="100"></div>
                            @endif
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('uploadSocialBanner')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('uploadSocialBanner')" data-id="uploadSocialBanner" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="uploadSocialBanner" id="uploadSocialBanner">
                    @if(@$crypto->uploadSocialBanner != '')
                    <div><img src="{{asset('uploads/').'/'.@$crypto->uploadSocialBanner}}" width = "100"></div>
                    @endif
                    <div id="uploadSocialBannerError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Social Banner alt</label></td>
                <td>
                   <input type="text" value="{{ @$crypto->social_banner_alt }}" name="social_banner_alt" placeholder="Social Banner alt"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveCrypto()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('cryptoJournal') }}" class="btn btn-danger">Cancel</a>
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
     CKEDITOR.replace( 'fullDescription', {
                fullPage: true,						
                allowedContent: true,
                width: '98%',height: '400px',
                // filebrowserBrowseUrl :  'http://localhost/NFTNews/assets/ckeditor/ckfinder/ckfinder.html',
                // filebrowserImageBrowseUrl : 'http://localhost/NFTNews/assets/ckeditor/ckfinder/ckfinder.html?type=Images',
                // filebrowserFlashBrowseUrl : 'http://localhost/NFTNews/assets/ckeditor/ckfinder/ckfinder.html?type=Flash',
                //filebrowserUploadUrl : 'http://localhost/NFTNews/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                // filebrowserImageUploadUrl : 'http://localhost/NFTNews/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                // filebrowserFlashUploadUrl : 'http://localhost/NFTNews/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            } );
    function saveCrypto() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var metaTitle = $("input[name=\"metaTitle\"]").val();
        var description = $("#description").val();
        var keywords = $("#keywords").val();
        var orderIndex = $("input[name='orderIndex']").val();
        var title                   = $("input[name='title']").val();
        var slug = $("input[name=\"slug\"]").val();
        var shortDescription        = $("#shortDescription").val();
        var fullDescriptionValidate = CKEDITOR.instances['fullDescription'].getData().replace(/<[^>]*>/gi, '').length;
        var fullDescription = CKEDITOR.instances['fullDescription'].getData();
        var newsId                  = $("input[name='newsId']").val();
        var image_alt = $("input[name=\"image_alt\"]").val();
        var social_banner_alt = $("input[name=\"social_banner_alt\"]").val();
        var image = $("input[name=\"image\"]").val();
        var pdf = $("input[name=\"pdf\"]").val();
        var uploadSocialBanner = $("input[name=\"uploadSocialBanner\"]").val();
        const regexExp = /^[a-z0-9]+(?:-[a-z0-9]+)*$/g;

        var fd = new FormData();
        if(newsId == ''){
            newsId = 0;
        }
        // Append image1 
        // var files = $('#image')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image',files[0]);
        // }
        // Append article 1 
        // var files = $('#pdf')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('pdf',files[0]);
        // }
        // // Append article 1
        // var files = $('#article_2')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('article_2',files[0]);
        // }
        fd.append('title', title);
        fd.append('slug', slug);
        fd.append('metaTitle', metaTitle);
        fd.append('description', description);
        fd.append('keywords', keywords);
        fd.append('orderIndex', orderIndex);
        fd.append('shortDescription', shortDescription);
        fd.append('fullDescription', fullDescription);
        fd.append('newsId', newsId);
        fd.append('image_alt', image_alt);
        fd.append('social_banner_alt', social_banner_alt);
        fd.append('image', image);
        fd.append('pdf', pdf);
        fd.append('uploadSocialBanner', uploadSocialBanner);
        // Append article 1 
        // var files = $('#uploadSocialBanner')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('uploadSocialBanner',files[0]);
        // }
        if (title == '') 
        {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
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
        if (metaTitle == '') 
        {
            flag = 0;
            $("#metaTitleError").html('<span class="errorMessage" style="color:red;">Meta Title Required</span>');
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
        if (shortDescription == '') 
        {
            flag = 0;
            $("#shortDescriptionError").html('<span class="errorMessage" style="color:red;">Short Description Required</span>');
        } 
        if (fullDescription == '') 
        {
            flag = 0;
            $("#fullDescriptionError").html('<span class="errorMessage" style="color:red;">Full Description Required</span>');
        } 
        if (orderIndex == '') 
        {
            flag = 0;
            $("#orderIndexError").html('<span class="errorMessage" style="color:red;">Order Index Required</span>');
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
                url: "{{ url('siteadmin/save_crypto') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/cryptoJournal') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>