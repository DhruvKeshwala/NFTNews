@include('layouts.header')
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Edit User NFT Drops</h3>
        </div>
        <div class="col-md-5 text-right">
            &nbsp;
        </div>
    </div>
    <div class="container_fluid mt-2 px-3">
        <table class="webforms sttbl mt-0">
            <tr>
                <td><label>Name</label></td>
                <td><input type="text" value="{{ @$dropManagement->name }}" name="name" placeholder="Name">
                    <div id="nameError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td><input type="text" value="{{ @$dropManagement->email }}" name="email" placeholder="email">
                    <div id="emailError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Location</label></td>
                <td><input type="text" value="{{ @$dropManagement->location }}" name="location" placeholder="location">
                    <div id="locationError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Phone</label></td>
                <td><input type="text" value="{{ @$dropManagement->phone }}" name="phone" placeholder="Phone">
                    <div id="phoneError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Skype</label></td>
                <td><input type="text" value="{{ @$dropManagement->skype }}" name="skype" placeholder="skype">
                    <div id="skypeError"></div>
                </td>
            </tr>
            <tr>
                <td><label>ProjectName</label></td>
                <td><input type="text" value="{{ @$dropManagement->projectName }}" name="projectName" placeholder="projectName">
                    <div id="projectNameError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Twitter Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->twitterLink }}" name="twitterLink" placeholder="Twitter Link">
                    <div id="twitterLinkError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Discord Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->discordLink }}" name="discordLink" placeholder="Discord Link">
                    <div id="discordLinkError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Short Description</label></td>
                <td><textarea rows="5" cols="30" name="shortDescription" id="shortDescription" placeholder="Short Description">{{@$dropManagement->shortDescription}}</textarea><div id="shortDescriptionError"></div></td>
            </tr>
            <tr>
                <td><label>Website Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->websiteLink }}" name="websiteLink" placeholder="Website Link">
                    <div id="websiteLinkError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Collection Name</label></td>
                <td><input type="text" value="{{ @$dropManagement->collectionName }}" name="collectionName" placeholder="collectionName">
                    <div id="collectionNameError"></div>
                </td>
            </tr>
            {{-- <tr>
                <td><label>NFT Status</label></td>
                <td><input type="text" value="{{ @$dropManagement->nftStatus }}" name="nftStatus" placeholder="NFT Status">
                    <div id="nftStatusError"></div>
                </td>
            </tr> --}}
            <tr>
                <td><label>Collection Item</label></td>
                <td><input type="number" value="{{ @$dropManagement->collectionItem }}" name="collectionItem" placeholder="collectionItem">
                    <div id="collectionItemError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Block-Chain</label></td>
                <td><input type="text" value="{{ @$dropManagement->blockChain }}" name="blockChain" placeholder="Block Chain">
                    {{-- <div id="blockChainError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Contract Address</label></td>
                <td><input type="text" value="{{ @$dropManagement->contractAddress }}" name="contractAddress" placeholder="Contract Address">
                    {{-- <div id="nameError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Token</label></td>
                <td><input type="text" value="{{ @$dropManagement->token }}" name="token" placeholder="Token">
                    {{-- <div id="tokenError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Meta Data</label></td>
                <td><textarea rows="5" cols="30" name="metaData" id="metaData" placeholder="MetaData Description">{{@$dropManagement->metaData}}</textarea><div id="metaDataError"></div></td>
            </tr>

            <tr>
                <td><label>Select Section to Publish In</label></td>
                <td>
                    <table>
                        <tr>
                            <th>Section Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                        <tr>
                            <td>Project Sale Date</td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->saleDate }}" name="saleDate" placeholder="Start Date">
                                <div id="start_dateError"></div>
                            </td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->saleEndDate }}" name="saleEndDate" placeholder="End Date">
                                <div id="end_dateError"></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td><label>Price Of Sale</label></td>
                <td><input type="number" value="{{ @$dropManagement->priceOfSale }}" name="priceOfSale" placeholder="Price Of Sale">
                    {{-- <div id="priceOfSaleError"></div> --}}
                </td>
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
        var name             = $("input[name='name']").val();
        var email             = $("input[name='email']").val();
        var location             = $("input[name='location']").val();
        var phone             = $("input[name='phone']").val();
        var skype             = $("input[name='skype']").val();
        var projectName             = $("input[name='projectName']").val();
        var twitterLink             = $("input[name='twitterLink']").val();
        var discordLink             = $("input[name='discordLink']").val();
        var shortDescription             = $("#shortDescription").val()
        var websiteLink             = $("input[name='websiteLink']").val();
        var collectionName             = $("input[name='collectionName']").val();
        //var nftStatus             = $("input[name='nftStatus']").val();
        var collectionItem             = $("input[name='collectionItem']").val();

        var blockChain             = $("input[name='blockChain']").val();
        var contractAddress             = $("input[name='contractAddress']").val();
        var token             = $("input[name='token']").val();
        var metaData             = $("#metaData").val()
        var saleDate             = $("input[name='saleDate']").val();
        var saleEndDate             = $("input[name='saleEndDate']").val();
        var priceOfSale             = $("input[name='priceOfSale']").val();
    

        // var slug = $("input[name=\"name\"]").val();
       
        var fd = new FormData();

        fd.append('name', name);
        fd.append('email', email);
        fd.append('location', location);
        fd.append('phone', phone);
        fd.append('skype', skype);
        fd.append('projectName', projectName);
        fd.append('twitterLink', twitterLink);
        fd.append('discordLink', discordLink);
        fd.append('shortDescription', shortDescription);
        fd.append('websiteLink', websiteLink);
        fd.append('collectionName', collectionName);
        //fd.append('nftStatus', nftStatus);
        fd.append('collectionItem', collectionItem);
        fd.append('blockChain', blockChain);
        fd.append('contractAddress', contractAddress);
        fd.append('token', token);
        fd.append('metaData', metaData);
        fd.append('saleDate', saleDate);
        fd.append('saleEndDate', saleEndDate);
        fd.append('priceOfSale', priceOfSale);
        
        if(name == '')
        {
            flag = 0;
            $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        }
        if(email == '')
        {
            flag = 0;
            $("#emailError").html('<span class="errorMessage" style="color:red;">Email Required</span>');
        }
        if(phone == '')
        {
            flag = 0;
            $("#phoneError").html('<span class="errorMessage" style="color:red;">Phone Required</span>');
        }
        if(location == '')
        {
            flag = 0;
            $("#locationError").html('<span class="errorMessage" style="color:red;">Location Required</span>');
        }
        if(projectName == '')
        {
            flag = 0;
            $("#projectNameError").html('<span class="errorMessage" style="color:red;">projectName Required</span>');
        }
        if(shortDescription == '')
        {
            flag = 0;
            $("#shortDescriptionError").html('<span class="errorMessage" style="color:red;">shortDescription Required</span>');
        }
        
        // if (description == '') 
        // {
        //     flag = 0;
        //     $("#descriptionError").html('<span class="errorMessage" style="color:red;">Description Required</span>');
        // }
        // if (keywords == '') 
        // {
        //     flag = 0;
        //     $("#keywordsError").html('<span class="errorMessage" style="color:red;">Keywords Required</span>');
        // } 
        // if (orderIndex == '') 
        // {
        //     flag = 0;
        //     $("#orderIndexError").html('<span class="errorMessage" style="color:red;">Order Index Required</span>');
        // }
        // if (name == '') 
        // {
        //     flag = 0;
        //     $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        // }
        // if (slug == '') 
        // {
        //     flag = 0;
        //     $("#slugError").html('<span style="color:red;">Slug Required</span>');
        // } 
        // else if(!regexExp.test(slug))
        // {
        //     flag = 0;
        //     $("#slugError").html('<span style="color:red;">Remove special character & space from slug</span>');
        // }
        // // if (token == '') 
        // // {
        // //     flag = 0;
        // //     $("#tokenError").html('<span class="errorMessage" style="color:red;">Token Required</span>');
        // // }
        // // if (blockChain == '') 
        // // {
        // //     flag = 0;
        // //     $("#blockChainError").html('<span class="errorMessage" style="color:red;">Block-Chain Required</span>');
        // // } 
        // // if (priceOfSale == 0) 
        // // {
        // //     flag = 0;
        // //     $("#priceOfSaleError").html('<span class="errorMessage" style="color:red;">Price Of Sale Required</span>');
        // // }
        // if (saleDate == '') 
        // {
        //     flag = 0;
        //     $("#saleDateError").html('<span class="errorMessage" style="color:red;">Sale Date Required</span>');
        // }

        // //function for URL validation
        // function isValidHttpUrl(string) {
        //     let url;
        //     try {
        //         url = new URL(string);
        //     } catch (_) {
        //         return false;
        //     }
        //     return url.protocol === "http:" || url.protocol === "https:";
        // }

        // if (discordLink == '') 
        // {
        //     flag = 0;
        //     $("#discordLinkError").html('<span class="errorMessage" style="color:red;">Discord Link Required</span>');
        // }
        // // URL validation
        // if(discordLink != '' && isValidHttpUrl(discordLink) == false)
        // {
        //     flag = 0;
        //     $("#discordLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Discord Link is Invalid</span>');
        // }

        // if (twitterLink == '') 
        // {
        //     flag = 0;
        //     $("#twitterLinkError").html('<span class="errorMessage" style="color:red;">Twitter Link Required</span>');
        // }
        // // URL validation
        // if(twitterLink != '' && isValidHttpUrl(twitterLink) == false)
        // {
        //     flag = 0;
        //     $("#twitterLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Twitter Link is Invalid</span>');
        // }

        // /*if (start_date == '') 
        // {
        //     flag = 0;
        //     $("#start_dateError").html('<span class="errorMessage" style="color:red;">Start Date Required</span>');
        // }

        // if (end_date == '') 
        // {
        //     flag = 0;
        //     $("#end_dateError").html('<span class="errorMessage" style="color:red;">End Date Required</span>');
        // }*/

        // if (websiteLink == '') 
        // {
        //     flag = 0;
        //     $("#websiteLinkError").html('<span class="errorMessage" style="color:red;">Website Link Required</span>');
        // }
        // // URL validation
        // if(websiteLink != '' && isValidHttpUrl(websiteLink) == false)
        // {
        //     flag = 0;
        //     $("#websiteLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Website Link is Invalid</span>');
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
                url: "{{ url('siteadmin/save_userDropManagement') }}",
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
                                window.location.href =  "{{ URL::to('siteadmin/dropManagement') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script><?php /**PATH /opt/lampp/htdocs/admin/resources/views/add_category.blade.php ENDPATH**/ ?>