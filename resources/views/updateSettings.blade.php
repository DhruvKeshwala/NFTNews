@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Update Settings</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td width="10%"><label>Facebook</label></td>
                <td width="90%">
                    <input type="text" value="{{ @$settings->facebook }}" name="facebook" placeholder="Facebook Link">
                    <div id="facebookError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Twitter</label></td>
                <td width="90%">
                    <input type="text" value="{{ @$settings->twitter }}" name="twitter" placeholder="Twitter Link">
                    <div id="twitterError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Instagram</label></td>
                <td width="90%">
                    <input type="text" value="{{ @$settings->instagram }}" name="instagram"
                        placeholder="Instagram Link">
                    <div id="instagramError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Linkedin</label></td>
                <td width="90%">
                    <input type="text" value="{{ @$settings->linkedin }}" name="linkedin"
                        placeholder="Linkedin Link">
                    <div id="linkedinError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Youtube</label></td>
                <td width="90%">
                    <input type="text" value="{{ @$settings->youtube }}" name="youtube" placeholder="Youtube Link">
                    <div id="youtubeError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Email</label></td>
                <td width="90%">
                    <input type="email" value="{{ @$settings->email }}" name="email"
                        placeholder="Admin email address">
                    <div id="emailError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Google Analytics</label></td>
                <td width="90%">
                    <textarea type="text" name="googleAnalytics" id="googleAnalytics" placeholder="Google Analytics">{{ @$settings->googleAnalytics }}</textarea>
                    <div id="googleAnalyticsError"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="updateSettings()" id="saveBtn"
                        class="btn btn-success light-font">Update Settings</a>
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
    CKEDITOR.replace('googleAnalytics', {
        fullPage: true,						
        allowedContent: true,
        width: '98%',
        height: '200px',
        filebrowserBrowseUrl: 'ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });

    function updateSettings() {
        $('.errorMessage').hide();
        var flag = 1;
        var facebook = $("input[name='facebook']").val();
        var twitter = $("input[name='twitter']").val();
        var instagram = $("input[name='instagram']").val();
        var linkedin = $("input[name='linkedin']").val();
        var youtube = $("input[name='youtube']").val();
        var email = $("input[name='email']").val();
        var googleAnalyticsValidate = CKEDITOR.instances['googleAnalytics'].getData().replace(/<[^>]*>/gi, '').length;
        var googleAnalytics = CKEDITOR.instances['googleAnalytics'].getData();

        var fd = new FormData();

        fd.append('facebook', facebook);
        fd.append('twitter', twitter);
        fd.append('instagram', instagram);
        fd.append('linkedin', linkedin);
        fd.append('youtube', youtube);
        fd.append('email', email);
        fd.append('googleAnalytics', googleAnalytics);

        if (facebook == '' || facebook == null) {
            flag = 0;
            $("#facebookError").html('<span class="errorMessage" style="color:red;">Please Enter Facebook link</span>');
        }

        if (twitter == '' || twitter == null) {
            flag = 0;
            $("#twitterError").html('<span class="errorMessage" style="color:red;">Please Enter Twitter Link</span>');
        }

        if (instagram == '' || instagram == null) {
            flag = 0;
            $("#instagramError").html(
                '<span class="errorMessage" style="color:red;">Please Enter Instagram Link</span>');
        }
        if (linkedin == '' || linkedin == null) {
            flag = 0;
            $("#linkedinError").html('<span class="errorMessage" style="color:red;">Please Enter Linkedin Link</span>');
        }
        if (youtube == '' || youtube == null) {
            flag = 0;
            $("#youtubeError").html('<span class="errorMessage" style="color:red;">Please Enter Youtube Link</span>');
        }
        if (email == '' || email == null) {
            flag = 0;
            $("#emailError").html(
                '<span class="errorMessage" style="color:red;">Please Enter Admin email address</span>');
        }
        if (googleAnalytics == '' || googleAnalytics == null) {
            flag = 0;
            $("#googleAnalyticsError").html(
                '<span class="errorMessage" style="color:red;">Please Enter Google Analytics code</span>');
        }
        // Email validation
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
        if (email != '' && validateEmail(email) == false) {
            flag = 0;
            $("#emailError").html('<span class="errorMessage" style="color:red;">Invalid Email</span>');
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
                url: "{{ route('update_settings') }}",
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
                                window.location.href = "{{ URL::to('siteadmin/settings') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }
</script>