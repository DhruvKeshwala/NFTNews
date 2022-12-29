@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif News</h3>
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
            
            <tr>
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
            </tr>

            <tr>
                <td><label>Title</label></td>
                <td><input type="text" value="{{ @$news->title }}" name="title" placeholder="Title"><div id="titleError"></div></td>
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
                <td><label>Image 1</label><small class="text-muted">Choose Image 1 size of 1140x760 pixels</small></td>
                <td>
                    <input type="file" name="image" id="image">
                    @if(@$news->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->image}}" width = "100"></div>
                    @endif
                    <div id="imageError"></div>
                    
                </td>
            </tr>
            <tr>
                <td><label>Image 2</label><small class="text-muted">Choose Image 2 size of 800x460 pixels</small></td>
                <td>
                    <input type="file" name="article_1" id="article_1">
                    @if(@$news->article_1 != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->article_1}}" width = "100"></div>
                    @endif
                    <div id="article1Error"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 3</label><small class="text-muted">Choose Image 3 size of 300x400 pixels</small></td>
                <td>
                    <input type="file" name="article_2" id="article_2">
                    @if(@$news->article_2 != '')
                    <div><img src="{{asset('uploads/').'/'.@$news->article_2}}" width = "100"></div>
                    @endif
                    <div id="article2Error"></div>
                </td>
            </tr>
            <tr>
                <td><label>Video URL</label></td>
                <td><input type="text" value="{{ @$news->videoURL }}" name="videoURL" placeholder="Video URL"><div id="videoURLError"></div><div id="videoURLPatternError"></div></td>
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
                        @php
                        $dateArray = json_decode(@$news->newsType,true);
                        @endphp
                        @foreach(config('constant.news_type') as $key=>$newstype)
                        <tr>
                            <td>{{ $newstype }}</td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dateArray[$key]['start_date'] }}" name="start_date[]" placeholder="Start Date">
                                <input type="hidden" name="newstype[]" value="{{$key}}" >
                            </td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dateArray[$key]['end_date'] }}" name="end_date[]" placeholder="End Date">
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            {{-- @php
            $dateArray = json_decode(@$news->newsType,true);
            @endphp
            @foreach(config('constant.news_type') as $key=>$newstype)
            <tr>
                <td><label>{{ $newstype }}</label></td>
                <td>
                    <input type="text" class="datepicker" value="{{ @$dateArray[$key] }}" name="date[]" placeholder="Date">
                    <input type="hidden" name="newstype[]" value="{{$key}}" >
                </td>
            </tr>
            @endforeach --}}
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveNews()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('news') }}" class="btn btn-danger">Cancel</a>
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
    $( ".datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        duration: "fast",
        minDate: 0
    });
    $("select[name=\"categoryId[]\"]").select2({
        multiple:true,
    });
    $("select[name=\"authorId\"]").select2({
    });
     CKEDITOR.replace( 'fullDescription', {
                fullPage: false,						
                allowedContent: false,
                width: '98%',height: '200px',
                filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            } );
    function saveNews() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var categoryId              = $("select[name='categoryId[]']").val();
        var authorId                = $("select[name='authorId']").val();
        var title                   = $("input[name='title']").val();
        var videoURL                = $("input[name='videoURL']").val();
        var shortDescription        = $("#shortDescription").val();
        var fullDescriptionValidate = CKEDITOR.instances['fullDescription'].getData().replace(/<[^>]*>/gi, '').length;
        var fullDescription = CKEDITOR.instances['fullDescription'].getData();
        var newsId = $("input[name='newsId']").val();
        var start_date = $("input[name='start_date[]']").map(function(){return $(this).val();}).get();
        var end_date = $("input[name='end_date[]']").map(function(){return $(this).val();}).get();
        var newstype = $("input[name='newstype[]']").map(function(){return $(this).val();}).get();

        var fd = new FormData();
        if(newsId == ''){
            newsId = 0;
        }
        // Append data 
        var files = $('#image')[0].files;
        if(files.length > 0)
        {
            fd.append('image',files[0]);
        }
        // Append article 1 
        var files = $('#article_1')[0].files;
        if(files.length > 0)
        {
            fd.append('article_1',files[0]);
        }
        // Append article 1
        var files = $('#article_2')[0].files;
        if(files.length > 0)
        {
            fd.append('article_2',files[0]);
        }
        fd.append('categoryId', categoryId);
        fd.append('authorId', authorId);
        fd.append('title', title);
        fd.append('videoURL', videoURL);
        fd.append('shortDescription', shortDescription);
        fd.append('fullDescription', fullDescription);
        fd.append('newsId', newsId);
        fd.append('start_date', start_date);
        fd.append('end_date', end_date);
        fd.append('newstype', newstype);

        if (categoryId == '' || categoryId == null) 
        {
            flag = 0;
            $("#categoryIdError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
        }
        if (authorId == '' || authorId == null) 
        {
            flag = 0;
            $("#authorIdError").html('<span class="errorMessage" style="color:red;">Author Required</span>');
        } 
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
        if (videoURL == '') 
        {
            flag = 0;
            $("#videoURLError").html('<span class="errorMessage" style="color:red;">Video URL Required</span>');
        }
        
        //function for URL validation
        function isValidHttpUrl(string) {
            let url;
            try {
                url = new URL(string);
            } catch (_) {
                return false;
            }
            return url.protocol === "http:" || url.protocol === "https:";
        }
        // URL validation
        if(videoURL != '' && isValidHttpUrl(videoURL) == false)
        {
            flag = 0;
            $("#videoURLPatternError").html('<span class="errorMessage" style="color:red;">Given Invalid URL..</span>');
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
                url: "{{ url('siteadmin/save_news') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/news') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>