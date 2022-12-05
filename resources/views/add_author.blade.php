@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif Author</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Name</label></td>
                <td>
                    <input type="text" value="{{ @$data->name }}" name="name" placeholder="Name">
                    <input type="hidden" name="authorId" value="{{@$id}}">
                    <div id="nameError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td>
                    <input type="text" value="{{ @$data->email }}" name="email" placeholder="Email">
                    <div id="emailError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Mobile</label></td>
                <td>
                    <input type="text" value="{{ @$data->mobile }}" name="mobile" placeholder="Mobile">
                    <div id="mobileError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Short Bio</label></td>
                <td>
                    <textarea rows="5" cols="30" name="shortBio" id="shortBio" placeholder="Short Description">{{@$data->short_bio}}</textarea>
                    <div id="shortDescriptionError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image</label></td>
                <td>
                    <input type="file" name="image" id="image">
                    @if(@$data->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$data->image}}" width = "100"></div>
                    @endif
                    <div id="imageError"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveAuthor()" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('author') }}" class="btn btn-danger">Cancel</a>
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
    function saveAuthor() 
    {
        var flag = 1;
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var mobile = $("input[name='mobile']").val();
        var shortBio = $("#shortBio").val()
        var authorId = $("input[name='authorId']").val();

        var fd = new FormData();
        if(authorId == ''){
            authorId = 0;
        }
        // Append data 
        var files = $('#image')[0].files;
        if(files.length > 0)
        {
            fd.append('image',files[0]);
        }
        
        fd.append('name', name);
        fd.append('email', email);
        fd.append('mobile', mobile);
        fd.append('shortBio', shortBio);
        fd.append('authorId', authorId);
        alert(shortBio);

        if (name == '' || name == null) 
        {
            flag = 0;
            $("#nameError").html('<span style="color:red;">Name Required</span>');
        } 
        if (email == '') 
        {
            flag = 0;
            $("#emailError").html('<span style="color:red;">Email Required</span>');
        } 
        if (shortBio == '') 
        {
            flag = 0;
            $("#shortDescriptionError").html('<span style="color:red;">Short Bio Required</span>');
        } 
        if (mobile == '') 
        {
            flag = 0;
            $("#mobileError").html('<span style="color:red;">Mobile No Required</span>');
        } 
        if(flag == 1) 
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('save_author') }}",
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
                            if (isConfirm) {
                                window.location.href =  "{{ URL::to('author') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>