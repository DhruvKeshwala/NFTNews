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
                    {{-- <div id="nameError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td>
                    <input type="text" value="{{ @$data->email }}" name="email" placeholder="Email">
                    {{-- <div id="emailError"></div> --}}
                    <div id="invalidEmailError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Mobile</label></td>
                <td>
                    <input type="text" value="{{ @$data->mobile }}" name="mobile" placeholder="Mobile">
                    {{-- <div id="mobileError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Short Bio</label></td>
                <td>
                    <textarea rows="5" cols="30" name="shortBio" id="shortBio" placeholder="Short Description">{{@$data->short_bio}}</textarea>
                    {{-- <div id="shortDescriptionError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Twitter Link</label></td>
                <td><input type="text" value="{{ @$data->twitterLink }}" name="twitterLink" placeholder="Twitter Link">
                    {{-- <div id="twitterLinkError"></div> --}}
                    <div id="twitterLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>LinkedIn Link</label></td>
                <td><input type="text" value="{{ @$data->linkedInLink }}" name="linkedInLink" placeholder="LinkedIn Link">
                    {{-- <div id="linkedInLinkError"></div> --}}
                <div id="linkedInLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>Image</label></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$data->image }}" placeholder="Upload Image" id="image" 
                                name="image" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$data->image != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$data->image }}" width="100"
                                        alt="{{ @$data->image2_alt }}"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('image')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('image')" data-id="image" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="image" id="image">
                    @if(@$data->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$data->image}}" width = "100" alt="{{@$data->image_alt}}"></div>
                    @endif --}}
                    {{-- <div id="imageError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Image alt</label></td>
                <td>
                   <input type="text" value="{{ @$data->image_alt }}" name="image_alt" placeholder="Image alt tag"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveAuthor()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
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
        $('.errorMessage').hide();
        var flag = 1;
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
        var mobile = $("input[name='mobile']").val();
        var shortBio = $("#shortBio").val()
        var authorId = $("input[name='authorId']").val();
        var twitterLink      = $("input[name='twitterLink']").val();
        var linkedInLink      = $("input[name='linkedInLink']").val();
        var image_alt = $("input[name='image_alt']").val();
        var image = $("input[name='image']").val();
        var fd = new FormData();
        if(authorId == ''){
            authorId = 0;
        }
        // Append data 
        // var files = $('#image')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image',files[0]);
        // }
        
        fd.append('name', name);
        fd.append('email', email);
        fd.append('mobile', mobile);
        fd.append('shortBio', shortBio);
        fd.append('authorId', authorId);
        fd.append('twitterLink', twitterLink);
        fd.append('linkedInLink', linkedInLink);
        fd.append('image_alt', image_alt);
        fd.append('image', image);
        // if (name == '' || name == null) 
        // {
        //     flag = 0;
        //     $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        // }

        // if (email == '') 
        // {
        //     flag = 0;
        //     $("#emailError").html('<span class="errorMessage" style="color:red;">Email Required</span>');
        // }
        //Email validation
        function validateEmail(email) 
        {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
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
        if (email != '' && validateEmail(email) == false) 
        {
            flag = 0;
            $("#invalidEmailError").html('<span class="errorMessage" style="color:red;">Invalid Email</span>');
        }

        // if (shortBio == '') 
        // {
        //     flag = 0;
        //     $("#shortDescriptionError").html('<span class="errorMessage" style="color:red;">Short Bio Required</span>');
        // } 
        // if (mobile == '') 
        // {
        //     flag = 0;
        //     $("#mobileError").html('<span class="errorMessage" style="color:red;">Mobile No Required</span>');
        // } 
        // if (twitterLink == '') 
        // {
        //     flag = 0;
        //     $("#twitterLinkError").html('<span class="errorMessage" style="color:red;">Twitter Link Required</span>');
        // }
        // URL validation
        if(twitterLink != '' && isValidHttpUrl(twitterLink) == false)
        {
            flag = 0;
            $("#twitterLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Twitter Link is Invalid</span>');
        }
        // if (linkedInLink == '') 
        // {
        //     flag = 0;
        //     $("#linkedInLinkError").html('<span class="errorMessage" style="color:red;">LinkedIn Link Required</span>');
        // }
        // URL validation
        if(linkedInLink != '' && isValidHttpUrl(linkedInLink) == false)
        {
            flag = 0;
            $("#linkedInLinkURLPatternError").html('<span class="errorMessage" style="color:red;">LinkedIn Link is Invalid</span>');
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
                url: "{{ route('save_author') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/author') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>