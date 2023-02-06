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
                <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <input type="text" name="search_key" class="form-control search-product search_key" id="iconLeft5"
                                placeholder="Search here">
                        </div>
                        {{-- <div class="col-sm-5">
                            <select name="category" class="form-control">
                                <option value="" disabled selected>Choose option</option>
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
                        </div> --}}
                        <div class="col-sm-2">
                            <input type="submit" onclick="searchImages()" class="search btn btn-primary mr-1 mb-1 waves-effect waves-light"
                                value="Search" />
                            <input type="submit" onclick="loadImages()" class="search btn btn-danger mr-1 mb-1 waves-effect waves-light"
                                value="Reset" />
                        </div>
                    </div>
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
    let input_elem_id = '';
    $(".closeFileModel").click(function() {
        // alert(input_elem_id);
        var imgName = $('#selectFileName').val();
        $("#"+input_elem_id).val(imgName);
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
                    })
                }
            },
            error: function(xhr, status, error) {}
        });
    }
    function searchImages() {
        $(document).find('.mediadata').html('');
        var fd = new FormData();
        var search_key      = $("input[name='search_key']").val();
        var category      = $("select[name='category']").val();
        fd.append('search_key', search_key);
        fd.append('category', category);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('siteadmin/filterMedia') }}",
            type: "POST",
            data:fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.success) {
                    // swal({
                    //     title: "Success!",
                    //     text: data.message + " :)",
                    //     icon: "success",
                    //     buttons: 'OK'
                    // }).then(function(isConfirm) {   
                        $(document).find('.mediadata').append(data.html_view);
                    // })
                }
            },
            error: function(xhr, status, error) {}
        });
    }
    function loadImages(input_id) {
        input_elem_id = input_id;
        $('.search_key').val('');
        $.ajax({
            url: "{{ url('siteadmin/getMediaFiles') }}",
            cache: false,
            success: function(response) {
                $(document).find('.mediadata').html('');
                $(document).find('.mediadata').append(response);
            }
        });
    }
    function removeImage(input_id) {
        $("#"+input_id).val('');
    }
</script>
</body>

</html>
<?php /**PATH /opt/lampp/htdocs/admin/resources/views/layouts/footer.blade.php ENDPATH**/ ?>
