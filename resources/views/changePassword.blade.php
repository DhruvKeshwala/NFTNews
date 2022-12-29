@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Change Password</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td width="10%"><label>New Password</label></td>
                <td width="90%">
                    <input type="password" value="" name="newPassword" placeholder="New Password">
                    <div id="newPasswordError"></div>
                </td>
            </tr>
            <tr>
                <td width="10%"><label>Confirm Password</label></td>
                <td width="90%">
                    <input type="password" value="" name="confirmPassword" placeholder="Confirm Password">
                    <div id="confirmPasswordError"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="savePassword()" id="saveBtn" class="btn btn-success light-font">Update Password</a>
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
    function savePassword() 
    {
        $('.errorMessage').hide();
        var flag = 1;
        var newPassword     = $("input[name='newPassword']").val();
        var confirmPassword = $("input[name='confirmPassword']").val();

        var fd = new FormData();
        
        
        
        fd.append('newPassword', newPassword);
        fd.append('confirmPassword', confirmPassword);

        if (newPassword == '' || newPassword == null) 
        {
            flag = 0;
            $("#newPasswordError").html('<span class="errorMessage" style="color:red;">Please Enter New Password</span>');
        }

        if (confirmPassword == '' || confirmPassword == null) 
        {
            flag = 0;
            $("#confirmPasswordError").html('<span class="errorMessage" style="color:red;">Please Enter Confirm Password</span>');
        }
        if(confirmPassword != '' && confirmPassword != newPassword)
        {
            flag = 0;
            $("#confirmPasswordError").html('<span class="errorMessage" style="color:red;">Password Mismatched Please Enter Valid Confirm Password</span>');
        }

       
        //Email validation
        // function validateEmail(email) 
        // {
        //     var re = /\S+@\S+\.\S+/;
        //     return re.test(email);
        // }
        // if (email != '' && validateEmail(email) == false) 
        // {
        //     flag = 0;
        //     $("#invalidEmailError").html('<span class="errorMessage" style="color:red;">Invalid Email</span>');
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
                url: "{{ route('save_changePassword') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/changePassword') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>