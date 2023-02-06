@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>
                @if (@$id == null)
                    Add
                @else
                    Edit
                @endif Media
            </h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Title</label></td>
                <td>
                    <input type="text" value="{{ @$data->title }}" name="title" placeholder="Title">
                    <input type="hidden" name="mediaId" value="{{ @$id }}">
                    <div id="titleError"></div>
                </td>
            </tr>
            {{-- <tr>
                <td><label>Type</label></td>
                <td>
                    <select name="type" data-placeholder="Select Type">
                        <option value="">Select Type</option>
                        <option value="news" {{ @$data->type == 'news' ? 'selected' : '' }}>News</option>
                        <option value="video" {{ @$data->type == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="crypto" {{ @$data->type == 'crypto' ? 'selected' : '' }}>Crypto Journal</option>
                        <option value="author" {{ @$data->type == 'author' ? 'selected' : '' }}>Author</option>
                        <option value="banner" {{ @$data->type == 'banner' ? 'selected' : '' }}>Banner</option>
                        <option value="nftDrops" {{ @$data->type == 'nftDrops' ? 'selected' : '' }}>NFT Drops</option>
                        <option value="pressRelease" {{ @$data->type == 'pressRelease' ? 'selected' : '' }}>Press
                            Release</option>
                        <option value="pages" {{ @$data->type == 'pages' ? 'selected' : '' }}>Manage Pages</option>
                    </select>
                </td>
            </tr> --}}
            {{-- <tr>
                <td><label>Alternative Text</label></td>
                <td>
                    <input type="text" value="{{ @$data->image_alt }}" name="image_alt"
                        placeholder="Alternate Text">
                    <div id="image_altError"></div>
                </td>
            </tr> --}}
            {{-- <tr>
                <td><label>Description</label></td>
                <td>
                    <textarea rows="5" cols="30" name="description" id="description" placeholder="Description">{{ @$data->description }}</textarea>
                    <div id="descriptionError"></div>
                </td>
            </tr> --}}
            {{-- <tr>
                <td><label>Image Dimensions</label></td>
                <td>
                    <input type="text" value="{{ @$data->dimensions }}" name="dimensions"
                        placeholder="Image Dimensions">
                    <small>Note* : Please Enter Image Dimensions like this (Ex. 600 x 600)</small>
                </td>
            </tr> --}}
            <tr>
                <td><label>Image</label></td>
                <td>
                    <input type="file" name="image" id="image">
                    @php
                        $imgsrc = @$data->image;
                        $extension = explode(".", @$imgsrc);
                        // echo $extension[1];die;
                    @endphp
                    @if (@$extension[1] != "pdf" && @$extension[1] != "PDF" && $imgsrc != null && $imgsrc != '')
                        <img src="{{ asset('uploads') . '/' . $imgsrc }}" height="250px" width="auto">
                    @elseif(@$extension[1] == 'pdf' || @$extension[1] == 'PDF')
                        <img src="{{ asset('uploads/pdf-img.png') }}" height="250px" width="auto">
                    @endif
                    {{-- @if (@$data->image != '')
                        <div><img src="{{ asset('uploads') . '/' . @$data->image }}" width="100"
                                alt="{{ @$data->image_alt }}"></div>
                    @endif --}}
                    {{-- <div id="imageError"></div> --}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveMedia()" id="saveBtn"
                        class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('media') }}" class="btn btn-danger">Cancel</a>
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
    function saveMedia() {
        $('.errorMessage').hide();
        var flag = 1;
        var title = $("input[name='title']").val();
        var type = $("select[name='type']").val();
        var image_alt = $("input[name='image_alt']").val();
        var description = $("#description").val()
        var dimensions = $("input[name='dimensions']").val();
        var mediaId = $("input[name='mediaId']").val();

        var fd = new FormData();
        if (mediaId == '') {
            mediaId = 0;
        }
        // Append data 
        var files = $('#image')[0].files;
        if (files.length > 0) {
            fd.append('image', files[0]);
        }

        fd.append('title', title);
        fd.append('type', type);
        fd.append('image_alt', image_alt);
        fd.append('description', description);
        fd.append('dimensions', dimensions);
        fd.append('mediaId', mediaId);

        if (title == '' || title == null) {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
        }


        if (flag == 1) {
            var saveBtn = document.getElementById("saveBtn");
            saveBtn.innerHTML = "Wait..";
            $('#saveBtn').addClass('disabled');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('save_media') }}",
                type: "POST",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.success) {
                        //enable the button
                        saveBtn.innerHTML = "SAVE";
                        $('#saveBtn').removeClass('disabled');
                        swal({
                            title: "Success!",
                            text: data.message + " :)",
                            icon: "success",
                            buttons: 'OK'
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.href = "{{ URL::to('siteadmin/media') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }
</script>
