@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Banner</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Banner Size</label></td>
                <td>
                    <select name="size" data-placeholder="Select Banner Size">
                        <option value="">Select Banner Size</option>
                        <option value="280  width x 400 height pixels" {{ @$data->size == '280  width x 400 height pixels' ? 'selected' : '' }}>280  width x 400 height pixels</option>
                        <option value="900  width x 200 height pixels" {{ @$data->size == '900  width x 200 height pixels' ? 'selected' : '' }}>900  width x 200 height pixels</option>
                        <option value="375  width x 400 height pixels" {{ @$data->size == '375  width x 400 height pixels' ? 'selected' : '' }}>375  width x 400 height pixels</option>
                        <option value="1210 width x 210 height pixels" {{ @$data->size == '1210 width x 210 height pixels' ? 'selected' : '' }}>1210 width x 210 height pixels</option>
                    </select>
                    <input type="hidden" name="bannerId" value="{{@$id}}">
                    <div id="sizeError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Banner URL</label></td>
                <td><input type="text" value="{{ @$data->url }}" name="url" placeholder="Banner URL"><div id="urlError"></div><div id="urlURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>Banner Image</label></td>
                <td>
                    <input type="file" name="image" id="image">
                    @if(@$data->image != '')
                    <div><img src="{{asset('uploads/banner/').'/'.@$data->image}}" width = "100"></div>
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveBanner()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('banner') }}" class="btn btn-danger">Cancel</a>
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
    function saveBanner() 
    {
        $('.errorMessage').hide();
        var flag     = 1;
        var size     = $("select[name='size']").val();
        var url      = $("input[name='url']").val();
        var bannerId = $("input[name='bannerId']").val();

        var fd = new FormData();
        if(bannerId == ''){
            bannerId = 0;
        }
        // Append data 
        var files = $('#image')[0].files;
        if(files.length > 0)
        {
            fd.append('image',files[0]);
        }
        
        fd.append('size', size);
        fd.append('url', url);
        fd.append('bannerId', bannerId);

        if (size == '' || size == null) 
        {
            flag = 0;
            $("#sizeError").html('<span class="errorMessage" style="color:red;">Banner Size Required</span>');
        } 
        if (url == '') 
        {
            flag = 0;
            $("#urlError").html('<span class="errorMessage" style="color:red;">Banner URL Required</span>');
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
        if(url != '' && isValidHttpUrl(url) == false)
        {
            flag = 0;
            $("#urlURLPatternError").html('<span class="errorMessage" style="color:red;">Given Invalid URL..</span>');
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
                url: "{{ route('save_banner') }}",
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
                                window.location.href =  "{{ URL::to('banner') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>