{{-- Modal for File Upload Popup --}}
<div class="modal fade media-modal " id="media-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Media Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form class="kt-form" id="fileUploadForm" enctype="multipart/form-data"> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">File Upload</label>
                                <input type="file" id="upload_image" name="file[]" multiple="" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="submit" onclick="saveImage()" value="Upload" class="btn btn-danger btn-md btn-wide kt-font-bold kt-font-transform-u uploade-image">
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
                <hr>
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
                <hr>
                <div class="allMediaContent mediadata"
                    style="width:100%;max-height: 300px;overflow-y: auto;overflow-x: hidden;" id="mediadata">
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
<div class="clearfix">&nbsp;</div>
<footer>
    © 2022, The NFT Markets
</footer>
</div>
<div class="clearfix"></div>

<!-- <script src="js/main.js"></script> //-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/ckeditor/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/ckeditor/ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/select2.min.js') }}"></script>
<script>
    $(".closeFileModel").click(function() {
        var imgName = $('#fileName').html();
        $(".getImage").val(imgName);
    });
    function saveImage() {
        var image   = document.getElementById("upload_image");
        var fd = new FormData();
        var TotalFiles = $('#upload_image')[0].files.length;
        let files = $('#upload_image')[0];
        for (let i = 0; i < TotalFiles; i++) {
            fd.append('files' + i, files.files[i]);
        }
        fd.append('TotalFiles', TotalFiles);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('saveFile') }}",
            type: "POST",
            data:fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.success) {
                    swal({
                        title: "Success!",
                        text: data.message + " :)",
                        icon: "success",
                        buttons: 'OK'
                    }).then(function(isConfirm) {
                        loadImages();
                        // if (isConfirm) {
                        //     window.location.href =  "{{ URL::to('siteadmin/banner') }}"
                        // }
                    })
                }
            },
            error: function(xhr, status, error) {}
        });
    }
        function loadImages() {
            $.ajax({
                url: "{{ url('siteadmin/getMediaFiles') }}",
                cache: false,
                success: function(response) {
                    alert('sdadsd');
                    $(document).find('.mediadata').html('');
                    $(document).find('.mediadata').append(response);
                }
            });
        }

    $("#removeImage").click(function() {
        $("#image").val(" ");

    });
</script>
</body>

</html>
<?php /**PATH /opt/lampp/htdocs/admin/resources/views/layouts/footer.blade.php ENDPATH**/ ?>
