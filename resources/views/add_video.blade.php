@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Video</h3>
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
                    <select name="categoryId[]" data-placeholder="Select Category" multiple>
                        <option value=""></option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(in_array($category->id,explode(",",@$news->categoryId))) selected  @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="newsId" value="{{@$id}}">
                    <div id="categoryIdError"></div>
                </td>
            </tr>            
            {{-- <tr>
                <td><label>Author</label></td>
                <td>
                    <select name="authorId" data-placeholder="Select Author">
                        <option value=""></option>
                        @foreach($authors as $author)
                            <option value="{{$author->id}}" @if($author->id == @$news->authorId) selected @endif>{{$author->name}}</option>
                        @endforeach
                    </select>
                    <div id="authorIdError"></div>
                </td>
            </tr> --}}

            <tr>
                <td><label>Title</label></td>
                <td><input type="text" value="{{ @$news->title }}" name="title" placeholder="Title"><div id="titleError"></div></td>
            </tr>
             <tr>
                <td><label>Slug</label></td>
                <td>
                    <input type="text" value="{{@$news->slug}}" name="slug" placeholder="Slug"><div id="slugError"></div>
                    <small>Note* : Please do not enter special characters and space in slug</small>
                </td>
            </tr>
            <tr>
                <td><label>Short Description</label></td>
                <td><textarea rows="5" cols="30" name="shortDescription" id="shortDescription" placeholder="Short Description">{{@$news->shortDescription}}</textarea><div id="shortDescriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Full Description</label></td>
                <td><textarea rows="5" cols="30" name="fullDescription" id="fullDescription" placeholder="Full Description">{{ @$news->fullDescription }}</textarea><div id="fullDescriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Image 1</label><small class="text-muted">Thumbnail size of 269x153 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$news->image1 }}" placeholder="Upload Image" id="image1" 
                                name="image1" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$news->image1 != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$news->image1 }}" width="100"
                                        alt="{{ @$news->image1_alt }}"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('image1')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('image1')" data-id="image1" class="btn btn-danger remove-image">Remove</a>
                        </div>
                        <div id="image1Error"></div>
                    </div>
                    {{-- <input type="file" name="image1" id="image1">
                    @if(@$news->image1 != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->image1}}" width = "100" alt="{{ @$news->image1_alt }}"></div>
                    @endif
                    
                    <div id="image1Error"></div> --}}
                </td>
            </tr>
             <tr>
                <td><label>Image 1 alt</label></td>
                <td>
                   <input type="text" value="{{ @$news->image1_alt }}" name="image1_alt" placeholder="Image 1 alt tag"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 2</label><small class="text-muted">Bigger size image of 528x300 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$news->image2 }}" placeholder="Upload Image" id="image2" 
                                name="image2" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$news->image2 != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$news->image2 }}" width="100"
                                        alt="{{ @$news->image2_alt }}"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('image2')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('image2')" data-id="image2" class="btn btn-danger remove-image">Remove</a>
                        </div>
                        <div id="image2Error"></div>
                    </div>
                    {{-- <input type="file" name="image2" id="image2">
                    @if(@$news->image2 != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->image2}}" width = "100" alt="{{ @$news->image2_alt }}"></div>
                    @endif
                    <div id="image2Error"></div> --}}

                </td>
            </tr>
             <tr>
                <td><label>Image 2 alt</label></td>
                <td>
                   <input type="text" value="{{ @$news->image2_alt }}" name="image2_alt" placeholder="Image 2 alt tag"></div>
                </td>
            </tr>
            <tr>
                <td><label>Embedded Video Code</label></td>
                <td><textarea name="code" placeholder="Code" cols="30" rows="5">{{@$news->code}}</textarea><div id="codeError"></div>
            </tr>
            <tr>
                <td><label>Select Section to Publish In</label></td>
                <td>
                    <table>
                        <tr>
                            <th>Section Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                        <tr>
                            <td>Featured Video</td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$news->start_date }}" name="start_date" placeholder="Start Date">
                            </td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$news->end_date }}" name="end_date" placeholder="End Date">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label>Order Index</label></td>
                <td><input type="number" value="{{ @$news->orderIndex != null || @$news->orderIndex != 0  ? @$news->orderIndex : 0 }}" name="orderIndex" placeholder="Order Index Number"><div id="orderIndexError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Title</label></td>
                <td><input type="text" value="{{ @$news->metaTitle }}" name="metaTitle" placeholder="Meta Title"><div id="metaTitleError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Description</label></td>
                <td><textarea rows="5" cols="30" name="description" id="description" placeholder="Meta Description">{{@$news->description}}</textarea><div id="descriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Meta Keywords</label></td>
                <td><textarea rows="5" cols="30" name="keywords" id="keywords" placeholder="Meta Keywords">{{ @$news->keywords }}</textarea><div id="keywordsError"></div></td>
            </tr>
            <tr>
                <td><label>Upload Social Banner</label></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$news->uploadSocialBanner }}" placeholder="Upload Image" id="uploadSocialBanner" 
                                name="uploadSocialBanner" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$news->uploadSocialBanner != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$news->uploadSocialBanner }}" width="100"
                                        alt="{{ @$news->image2_alt }}"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('uploadSocialBanner')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('uploadSocialBanner')" data-id="uploadSocialBanner" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="uploadSocialBanner" id="uploadSocialBanner">
                    @if(@$news->uploadSocialBanner != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->uploadSocialBanner}}" width = "100" alt="{{ @$news->social_banner_alt }}"></div>
                    @endif
                    <div id="uploadSocialBannerError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Social Banner alt</label></td>
                <td>
                   <input type="text" value="{{ @$news->social_banner_alt }}" name="social_banner_alt" placeholder="Social Banner alt"></div>
                </td>
            </tr>
            <tr>
                <td><label>Publish Date</label></td>
                <td>
                    <input type="text" value="{{ date('Y-m-d', strtotime(@$news->publish_date)) }}" name="publish_date" class="publish_date" placeholder="Publish Date">
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveVideo()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('videos') }}" class="btn btn-danger">Cancel</a>
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
    $(".publish_date").datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
    });
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        duration: "fast",
        minDate: 0
    });
    $("select[name=\"categoryId[]\"]").select2({
        multiple:true,
    });
    $("select[name=\"authorId\"]").select2({
    });
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
    function saveVideo() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var metaTitle = $("input[name=\"metaTitle\"]").val();
        var description = $("#description").val();
        var keywords = $("#keywords").val();
        var orderIndex = $("input[name='orderIndex']").val();
        var categoryId              = $("select[name='categoryId[]']").val();
        // var authorId                = $("select[name='authorId']").val();
        var title                   = $("input[name='title']").val();
        var slug                   = $("input[name='slug']").val();
        var code                    = $("textarea[name='code']").val();
        var shortDescription        = $("#shortDescription").val();
        var fullDescriptionValidate = CKEDITOR.instances['fullDescription'].getData().replace(/<[^>]*>/gi, '').length;
        var fullDescription = CKEDITOR.instances['fullDescription'].getData();
        var newsId                  = $("input[name='newsId']").val();
        var start_date              = $("input[name='start_date']").map(function(){return $(this).val();}).get();
        var end_date                = $("input[name='end_date']").map(function(){return $(this).val();}).get();
        var videoType               = "Featured Video";
        var image1_alt = $("input[name=\"image1_alt\"]").val();
        var image2_alt = $("input[name=\"image2_alt\"]").val();
        var social_banner_alt = $("input[name=\"social_banner_alt\"]").val();
        var image1 = $("input[name=\"image1\"]").val();
        var image2 = $("input[name=\"image2\"]").val();
        var uploadSocialBanner = $("input[name=\"uploadSocialBanner\"]").val();
        var publish_date = $("input[name=\"publish_date\"]").val();
        const regexExp = /^[a-z0-9]+(?:-[a-z0-9]+)*$/g;
        var fd = new FormData();
        if(newsId == ''){
            newsId = 0;
        }
        // Append image1 
        // var files = $('#image1')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image1',files[0]);
        // }
        // Append article 1 
        // var files = $('#image2')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image2',files[0]);
        // }
        // // Append article 1
        // var files = $('#article_2')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('article_2',files[0]);
        // }
        fd.append('categoryId', categoryId);
        // fd.append('authorId', authorId);
        fd.append('title', title);
        fd.append('code', code);
        fd.append('shortDescription', shortDescription);
        fd.append('fullDescription', fullDescription);
        fd.append('newsId', newsId);
        fd.append('start_date', start_date);
        fd.append('end_date', end_date);
        fd.append('videoType', videoType);
        fd.append('metaTitle', metaTitle);
        fd.append('description', description);
        fd.append('keywords', keywords);
        fd.append('orderIndex', orderIndex);
        fd.append('slug', slug);
        fd.append('image1_alt', image1_alt);
        fd.append('image2_alt', image2_alt);
        fd.append('social_banner_alt', social_banner_alt);
        fd.append('image1', image1);
        fd.append('image2', image2);
        fd.append('uploadSocialBanner', uploadSocialBanner);
        fd.append('publish_date', publish_date);
        
        // Append article 1 
        // var files = $('#uploadSocialBanner')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('uploadSocialBanner',files[0]);
        // }

        if (categoryId == '' || categoryId == null) 
        {
            flag = 0;
            $("#categoryIdError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
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
        if (orderIndex == '') 
        {
            flag = 0;
            $("#orderIndexError").html('<span class="errorMessage" style="color:red;">Order Index Required</span>');
        }
        // if (authorId == '' || authorId == null) 
        // {
        //     flag = 0;
        //     $("#authorIdError").html('<span class="errorMessage" style="color:red;">Author Required</span>');
        // } 
        if (title == '') 
        {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
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
        if (code == '') 
        {
            flag = 0;
            $("#codeError").html('<span class="errorMessage" style="color:red;">Video URL Required</span>');
        }
        
        //function for URL validation
        // function isValidHttpUrl(string) {
        //     let url;
        //     try {
        //         url = new URL(string);
        //     } catch (_) {
        //         return false;
        //     }
        //     return url.protocol === "http:" || url.protocol === "https:";
        // }
        // URL validation
        // if(videoURL != '' && isValidHttpUrl(videoURL) == false)
        // {
        //     flag = 0;
        //     $("#videoURLPatternError").html('<span class="errorMessage" style="color:red;">Given Invalid URL..</span>');
        // }
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
                url: "{{ url('siteadmin/save_video') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/videos') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>