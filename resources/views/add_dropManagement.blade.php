@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>@if(@$id == null) Add @else Edit @endif NFT Drops</h3>
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
                        <option value="{{ $category->id }}" @if(in_array($category->id,explode(",",@$dropManagement->categoryId))) selected  @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="dropManagementId" value="{{@$id}}">
                    <div id="categoryIdError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Name</label></td>
                <td><input type="text" value="{{ @$dropManagement->name }}" name="name" placeholder="Name"><div id="nameError"></div></td>
            </tr>
            <tr>
                <td><label>Token</label></td>
                <td><input type="text" value="{{ @$dropManagement->token }}" name="token" placeholder="Token"><div id="tokenError"></div></td>
            </tr>
            <tr>
                <td><label>Block-Chain</label></td>
                <td><input type="text" value="{{ @$dropManagement->blockChain }}" name="blockChain" placeholder="Block Chain"><div id="blockChainError"></div></td>
            </tr>
            <tr>
                <td><label>Price Of Sale</label></td>
                <td><input type="number" value="{{ @$dropManagement->priceOfSale }}" name="priceOfSale" placeholder="Price Of Sale"><div id="priceOfSaleError"></div></td>
            </tr>
            <tr>
                <td><label>Sale Date</label></td>
                <td><input type="text" class="datepicker" value="{{ @$dropManagement->saleDate }}" name="saleDate" placeholder="Sale Date"><div id="saleDateError"></div></td>
            </tr>
            <tr>
                <td><label>Discord Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->discordLink }}" name="discordLink" placeholder="Discord Link"><div id="discordLinkError"></div><div id="discordLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>Twitter Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->twitterLink }}" name="twitterLink" placeholder="Twitter Link"><div id="twitterLinkError"></div><div id="twitterLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>Website Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->websiteLink }}" name="websiteLink" placeholder="Website Link"><div id="websiteLinkError"></div><div id="websiteLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:;" onclick="saveDropManagement()" id="saveBtn" class="btn btn-success light-font">SAVE</a>
                    <a href="{{ route('dropManagement') }}" class="btn btn-danger">Cancel</a>
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
        dateFormat: "yy-mm-dd",
        duration: "fast",
        minDate: 0
    });
    $("select[name=\"categoryId[]\"]").select2({
        multiple:true,
    });

    function saveDropManagement() 
    {
        $('.errorMessage').hide();
        var flag             = 1;
        var categoryId       = $("select[name='categoryId[]']").val();
        var name             = $("input[name='name']").val();
        var token            = $("input[name='token']").val();
        var blockChain       = $("input[name='blockChain']").val();
        var priceOfSale      = $("input[name='priceOfSale']").val();
        // var saleDate         = $("input[name='saleDate']").val();
        var saleDate         = $("input[name='saleDate']").map(function(){return $(this).val();}).get();
        var discordLink      = $("input[name='discordLink']").val();
        var twitterLink      = $("input[name='twitterLink']").val();
        var websiteLink      = $("input[name='websiteLink']").val();
        var dropManagementId = $("input[name='dropManagementId']").val();
        var fd = new FormData();
        if(dropManagementId == ''){
            dropManagementId = 0;
        }
        fd.append('categoryId', categoryId);
        fd.append('name', name);
        fd.append('token', token);
        fd.append('blockChain', blockChain);
        fd.append('priceOfSale', priceOfSale);
        fd.append('saleDate', saleDate);
        fd.append('discordLink', discordLink);
        fd.append('twitterLink', twitterLink);
        fd.append('websiteLink', websiteLink);
        fd.append('dropManagementId', dropManagementId);

        if (categoryId == '' || categoryId == null) 
        {
            flag = 0;
            $("#categoryIdError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
        } 
        if (name == '') 
        {
            flag = 0;
            $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        }
        if (token == '') 
        {
            flag = 0;
            $("#tokenError").html('<span class="errorMessage" style="color:red;">Token Required</span>');
        }
        if (blockChain == '') 
        {
            flag = 0;
            $("#blockChainError").html('<span class="errorMessage" style="color:red;">Block-Chain Required</span>');
        } 
        if (priceOfSale == 0) 
        {
            flag = 0;
            $("#priceOfSaleError").html('<span class="errorMessage" style="color:red;">Price Of Sale Required</span>');
        }
        if (saleDate == '') 
        {
            flag = 0;
            $("#saleDateError").html('<span class="errorMessage" style="color:red;">Sale Date Required</span>');
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

        if (discordLink == '') 
        {
            flag = 0;
            $("#discordLinkError").html('<span class="errorMessage" style="color:red;">Discord Link Required</span>');
        }
        // URL validation
        if(discordLink != '' && isValidHttpUrl(discordLink) == false)
        {
            flag = 0;
            $("#discordLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Discord Link is Invalid</span>');
        }

        if (twitterLink == '') 
        {
            flag = 0;
            $("#twitterLinkError").html('<span class="errorMessage" style="color:red;">Twitter Link Required</span>');
        }
        // URL validation
        if(twitterLink != '' && isValidHttpUrl(twitterLink) == false)
        {
            flag = 0;
            $("#twitterLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Twitter Link is Invalid</span>');
        }

        if (websiteLink == '') 
        {
            flag = 0;
            $("#websiteLinkError").html('<span class="errorMessage" style="color:red;">Website Link Required</span>');
        }
        // URL validation
        if(websiteLink != '' && isValidHttpUrl(websiteLink) == false)
        {
            flag = 0;
            $("#websiteLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Website Link is Invalid</span>');
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
                url: "{{ url('save_dropManagement') }}",
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
                                window.location.href =  "{{ URL::to('dropManagement') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>