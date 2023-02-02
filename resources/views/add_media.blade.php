@include('layouts.header')

    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-extended.css')}}">
    <script src="{{ URL::asset('assets/js/vendors.min.js')}}"></script>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Media</h3>
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
                    <input type="hidden" name="mediaId" value="{{@$id}}">
                    <div id="titleError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Alternative Text</label></td>
                <td>
                    <input type="text" value="{{ @$data->image_alt }}" name="image_alt" placeholder="Alternate Text">
                    {{-- <div id="image_altError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td>
                    <textarea rows="5" cols="30" name="description" id="description" placeholder="Description">{{@$data->description}}</textarea>
                    {{-- <div id="descriptionError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Image</label></td>
                <td>
                    <input type="file" name="image" id="image">
                    @if(@$data->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$data->image}}" width = "100" alt="{{@$data->image_alt}}"></div>
                    @endif
                    {{-- <div id="imageError"></div> --}}
                </td>
            </tr>
            {{-- <tr><td>Image</td><td>
            <div id="bannerimage">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label class="col-xl-2 col-lg-2 col-form-label">
                                Image</label>
                            <div class="col-lg-6 col-xl-6">
                                <input value="" placeholder="Upload Image"
                                    id="bannerImage" name="bannerImage"
                                    type="text" class="form-control "
                                    readonly="">
                                <br clear="all" />
                                Best Image Size(1366 × 768 pixels)
                            </div>
                            <div class="col-lg-2 col-xl-2">
                                <button type="button"
                                    class="btn btn-warning btn-label-brand btn-md mediaModel"
                                    data-toggle="modal"
                                    data-target="#media-model"
                                    data-control="bannerImage">Browse</button>
                            </div>
                            <div class="col-lg-1 col-xl-1 ">
                                <p data-id="bannerImage"
                                    class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light float-right remove-image">
                                    Remove</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div></td>
            </tr> --}}
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveMedia()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('media') }}" class="btn btn-danger">Cancel</a>
                </td>
            </tr>
        </table>
        <div class="clearfix"></div>
    </div>
</div>


{{-- Modal for File Upload Popup --}}
 <div class="modal fade media-modal " id="media-model" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Media Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="kt-form" id="fileUploadForm"
                    action="https://resources.thenftmarkets.co.uk/admin/media/upload" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="J4SccaNzNfcXnrdImQkJqpTol3AKWagVmf7dMLrc">
                    <input type="hidden" name="media_action" id="media_action" value="" />
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <label class="col-xl-2 col-lg-2 col-form-label"> File Upload</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input " id="file" name="file" multiple=""
                                    required="">
                                <label class="custom-file-label LabeliconFile" id="fileLabel" for="file">Choose File
                                </label>
                            </div>


                            <div class="kt-form__actions" style="margin-top:20px;">
                                <input type="submit" value="Upload"
                                    class="btn btn-danger btn-md btn-wide kt-font-bold kt-font-transform-u uploade-image">
                            </div>

                        </div>
                    </div>

                </form>
                <form id="fileSearchModel" action="https://resources.thenftmarkets.co.uk/admin/media/get">
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="text" name="search" class="form-control search-product" id="iconLeft5"
                                placeholder="Search here">
                            <div id="test">
                                <input type='hidden' value='grid-view' name='activeClass'>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <select name="category" class="form-control">
                                <option value="" disabled selected>Choose option</option>
                                <option value="page">Page</option>
                                <option value="widgets">Widgets</option>
                                <option value="about">About</option>

                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="search btn btn-primary mr-1 mb-1 waves-effect waves-light"
                                value="search" />
                        </div>
                    </div>
                </form>

                <div class="progress" style="margin-bottom:15px">
                    <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: 0%">
                        0%
                    </div>
                </div>


                <div class="allMediaContent"
                    style="width:100%;max-height: 300px;overflow-y: auto;    overflow-x: hidden;" id="mediadata">
                </div>

            </div>
            <div class="modal-footer">
                <input type="text" class="form-control" id="selectFileName" value="" readonly />
                <input type="hidden" id="targetControl" value="" />
                <button type="button" class="btn btn-primary closeFileModel" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>


<script>






        $(document).ready(function () {

            var count = 0;
            


            $(document).on("click", ".selectFile", function () {
                console.log($(this).val());
                $(".selectFile").removeAttr('style');
                $(this).css("border", "5px solid");
                $('#selectFileName').val($(this).data('file'));
                $('#menu3').show();
                var base = $(document).find('.base').val();
                var name = "https://resources.thenftmarkets.co.uk/" + "uploads/media/thumbnails/" + $(this).data('file');
                var name2 = "https://resources.thenftmarkets.co.uk/" + "uploads/media/" + $(this).data('file');
                $('#imageurl').val(name);

                document.getElementById('selectedimage').src = $(this).attr('src');
                $('#title').html("<strong>Title: </strong>" + $(this).data('title'));
                $('#fileName').html("<strong>File Name: </strong> " + $(this).data('file'));
                $('#type').html("<strong>Type : </strong>" + $(this).data('type'));
                $('#dimensions').html("<strong>Dimensions : </strong>" + $(this).data('dimensions'));
                $('#thumbnailsDimensions').html("<strong>Thumbnails Dimensions: </strong>" + $(this).data('thumbnails'));
                $('#category').html("<strong>Category : </strong>" + $(this).data('category'));
                $('#url').html("<strong>URL: </strong>" + name2);
                $('#thumbnailsurl').html("<strong>Thumbnails URL: </strong>" + name);
                $('#deletebtn').html("<a class='delete-from-uploads btn btn-danger mr-2 mb-2 float-right' data-id=" + $(this).data('id') + " href='javascript:void(0);' >Delete</a>");




            });



            $(document).on("click", ".mediaModel", function () {
                $("#targetControl").val($(this).data('control'));
            });

            $(document).on("click", ".closeFileModel", function () {


                $("#" + $("#targetControl").val()).val($("#selectFileName").val());
            });

            $('#fileSearchModel').ajaxForm({
                beforeSend: function () {

                },
                uploadProgress: function (event, position, total, percentComplete) {

                },
                success: function (data) {
                    //                    alert(data);
                    console.log(data);
                    $('.allMediaContent').html(data);

                }
            });






            $(document).on("click", ".delete-from-uploads", function () {

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                }).then(function (result) {
                    if (result.value) {
                        deletefromUploads($('.delete-from-uploads').data('id'));
                        //                  window.top.location.href = 'https://resources.thenftmarkets.co.uk/admin/media/deleteUploads'+'/'+$('.delete-from-uploads').data('id')
                    }
                })
            });



        });
    </script>

<!-- Footer -->
@include('layouts.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    function saveMedia() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var title = $("input[name='title']").val();
        var image_alt = $("input[name='image_alt']").val();
        var description = $("#description").val()
        var mediaId = $("input[name='mediaId']").val();
        
        var fd = new FormData();
        if(mediaId == ''){
            mediaId = 0;
        }
        // Append data 
        var files = $('#image')[0].files;
        if(files.length > 0)
        {
            fd.append('image',files[0]);
        }
        
        fd.append('title', title);
        fd.append('image_alt', image_alt);
        fd.append('description', description);
        fd.append('mediaId', mediaId);
        
        if (title == '' || title == null) 
        {
            flag = 0;
            $("#titleError").html('<span class="errorMessage" style="color:red;">Title Required</span>');
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
                url: "{{ route('save_media') }}",
                type: "POST",
                data:fd,
                cache: false,
                processData: false,
                contentType: false,
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
                                window.location.href =  "{{ URL::to('siteadmin/media') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>