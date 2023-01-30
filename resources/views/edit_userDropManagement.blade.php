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
                <td><label>Slug</label></td>
                <td>
                    <input type="text" value="{{@$dropManagement->slug}}" name="slug" placeholder="Slug"><div id="slugError"></div>
                    <small>Note* : Please do not enter special characters and space in slug</small>
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
                <td><label>Twitter Link <i title="Enter as https://twitter.com/yourtwitterhandle, if you don’t have an official twitter for the project provide your personal twitter" class="fa fa-info-circle"></i></label></td>
                <td><input type="text" value="{{ @$dropManagement->twitterLink }}" name="twitterLink" placeholder="Twitter Link">
                    <div id="twitterLinkError"></div>
                    <div id="twitterLinkURLPatternError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Discord Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->discordLink }}" name="discordLink" placeholder="Discord Link">
                    <div id="discordLinkError"></div>
                    <div id="discordLinkURLPatternError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Short Description</label></td>
                <td><textarea rows="5" cols="30" name="shortDescription" id="shortDescription" placeholder="Short Description">{{@$dropManagement->shortDescription}}</textarea><div id="shortDescriptionError"></div></td>
            </tr>
            <tr>
                <td></td>
                <td><label class="label" for="fees">Do you agree to pay the 0.6 ETH listing fee?* Price discounted by 50% valid through to 16th Sept 2022</label>
                <p>This allows your project to be listed within the upcoming collections section (as long as the site exists)</p></td>
            </tr>
            <tr>
                <td><label>Website Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->websiteLink }}" name="websiteLink" placeholder="Website Link">
                    <div id="websiteLinkError"></div>
                    <div id="websiteLinkURLPatternError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Collection Name <i class="fa fa-info-circle" title="Enter as https://opensea.io/collection/yourcollectionname"></i></label></td>
                <td><input type="text" value="{{ @$dropManagement->collectionName }}" name="collectionName" placeholder="collectionName">
                    <div id="collectionNameError"></div>
                </td>
            </tr>
            <tr>
                <td><label>NFT Status</label></td>
                <td>
                    {{-- @dd($dropManagement->nftStatus) --}}
                    <label class="label" for="prjctrmap">What is the status of your NFT?*</label>
                    <label for="nftStatus">
                    <input type="radio" id="nftStatus" name="nftStatus" value="1" {{ ($dropManagement->nftStatus=="1")? "checked" : "" }}>All NFTs are minted and revealed and on OpenSea (or other marketplace)</label>
                    <label for="nftStatus1">
                    <input type="radio" id="nftStatus1" name="nftStatus"  value="2" {{ ($dropManagement->nftStatus=="2")? "checked" : "" }}>Sale is upcoming, date is known.</label>
                    <label for="nftStatus2" class="pr-3">
                    <input type="radio" id="nftStatus2" name="nftStatus" value="3" {{ ($dropManagement->nftStatus=="3")? "checked" : "" }}>Sale is ongoing and/or not all items have been minted or revealed.</label>
                    <label for="nftStatus3" class="pr-3">
                    <input type="radio" id="nftStatus3" name="nftStatus" value="4" {{ ($dropManagement->nftStatus=="4")? "checked" : "" }}>Sale is upcoming, date unknown</label>
                </td>
            </tr>
            <tr>
                <td><label>Collection Item <i title="(If you don‘t know, it‘s likely Ethereum)" class="fa fa-info-circle"></i></label></td>
                <td><label class="label" for="mntprice">What is the maximum number of items in your collection?*</label>
                            <small>Or at least the first batch that you would like to be listed.</small><input type="number" value="{{ @$dropManagement->collectionItem }}" name="collectionItem" placeholder="collectionItem">
                    <div id="collectionItemError"></div>
                </td>
            </tr>
            {{-- <tr>
                <td><label>Block-Chain <i title="(If you don‘t know, it‘s likely Ethereum)" class="fa fa-info-circle"></i></label></td>
                <td>
                                <label>Which blockchain is your collection on?</label>
							    <label for="blockChain" class="pr-3"><input type="radio" id="blockChain" name="blockChain" value="Binance Smart Chain" {{ ($dropManagement->blockChain == 'Binance Smart Chain') ? "checked" : "" }}> Binance Smart Chain</label>
                                <label for="blockChain1" class="pr-3">
                                <input type="radio" id="blockChain1" name="blockChain" value="Cardano" {{ ($dropManagement->blockChain == 'Cardano') ? "checked" : "" }}>
							    Cardano</label>
                                <label for="blockChain2" class="pr-3">
                                <input type="radio" id="blockChain2" name="blockChain" value="Ethereum" {{ ($dropManagement->blockChain == 'Ethereum') ? "checked" : "" }}>
							    Ethereum</label>
                                <label for="blockChain3" class="pr-3">
                                <input type="radio" id="blockChain3" name="blockChain" value="Matic" {{ ($dropManagement->blockChain == 'Matic') ? "checked" : "" }}>
							    Matic</label>
                                <label for="blockChain4" class="pr-3">
                                <input type="radio" id="blockChain4" name="blockChain" value="Polygon" {{ ($dropManagement->blockChain == 'Polygon') ? "checked" : "" }}>
							    Polygon</label>
                                <label for="blockChain5" class="pr-3">
                                <input type="radio" id="blockChain5" name="blockChain" value="Solano" {{ ($dropManagement->blockChain == 'Solano') ? "checked" : "" }}>
							    Solano</label>
                                <label for="blockChain6" class="pr-3">
                                <input type="radio" id="blockChain6" name="blockChain" value="Wax" {{ ($dropManagement->blockChain == 'Wax') ? "checked" : "" }}>
							    Wax</label>
                                <label for="blockChain7" class="pr-3">
                                <input type="radio" id="blockChain7" name="blockChain" value="Other" {{ ($dropManagement->blockChain == 'Other') ? "checked" : "" }}>
							    Other</label>
                </td>
            </tr> --}}
            <tr>
                {{-- @dd($dropManagement->blockChain ) --}}
                <td><label>Block-Chain <i title="(If you don‘t know, it‘s likely Ethereum)" class="fa fa-info-circle"></i></label></td>
                <td><input type="text" value="{{ @$dropManagement->blockChain }}" name="blockChain" placeholder="Block Chain">
                    <div id="blockChainError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Contract Address</label></td>
                <td><label class="label" for="contractAddress">What is your collection’s contract address(es)? <small>(If Availble)</small></label><input type="text" value="{{ @$dropManagement->contractAddress }}" name="contractAddress" placeholder="Contract Address">
                    {{-- <div id="nameError"></div> --}}
                </td>
            </tr>
            {{-- <tr>
                <td><label>Token</label></td>
                <td>
                    <label class="label" for="prjctrmap">What type of token standard is your contract?*</label>
                    <label for="bchain011" class="pr-3">
                        <input type="radio" id="bchain011" name="token" value="ERC721" {{ ($dropManagement->token == 'ERC721') ? "checked" : "" }}>ERC721</label>
                    <label for="bchain012" class="pr-3"><input type="radio" id="bchain012" name="token" value="ERC1155" {{ ($dropManagement->token == 'ERC1155') ? "checked" : "" }}>
                    ERC1155</label>
                    <label for="bchain013" class="pr-3"><input type="radio" id="bchain013" name="token" value="idontknow" {{ ($dropManagement->token == 'idontknow') ? "checked" : "" }}>
                    I don‘t know</label>
                    <label for="bchain014" class="pr-3"><input type="radio" id="bchain014" name="token" value="other" {{ ($dropManagement->token == 'other') ? "checked" : "" }}>
                    Other</label>
                </td>
            </tr> --}}

            <tr>
                <td><label>Token</label></td>
                <td>
                    <label class="label" for="token">What type of token standard is your contract?*</label>
                    <input type="text" value="{{ @$dropManagement->token }}" name="token" placeholder="Token">
                    <div id="tokenError"></div>
                </td>
            </tr>
           
            <tr>
                <td><label>Meta Data</label></td>
                <td><label class="label" for="metaData">Is/will your item metadata be dynamic, or can they change after the sale ends? Will there be continuous minting (e.g., breeding?). If yes, please explain</label><textarea rows="5" cols="30" name="metaData" id="metaData" placeholder="MetaData Description">{{@$dropManagement->metaData}}</textarea>
                <small>Most projects metadata are fixed eg. think CryptoPunks, the attributes for a CryptoPunk never changes. However, some projects have dynamic metadata, for example some projects may have changable accessories. Others may have breeding resulting in continuous minting. If your project has features like this, please explain a bit about them here.</small><div id="metaDataError"></div></td>
            </tr>
            <input type="hidden" name="dropManagementId" value="{{@$id}}">
            <tr>
                <td><label class="label" for="mntprice">Your Project‘s Sale Start Date (If available) (in UTC only*)</label></td>
                <td>
                    <table>
                        <tr>
                            <th>Sale Start Date</th>
                            <th>Sale End Date</th>
                            <th>Sale Time</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->saleDate }}" name="saleDate" placeholder="Start Date">
                                <div id="start_dateError"></div>
                            </td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->saleEndDate }}" name="saleEndDate" placeholder="End Date">
                                <div id="end_dateError"></div>
                            </td>
                            <td>
                                <input type="time" name="saleTime" id="saleTime" placeholder="Time" value="{{ @$dropManagement->saleTime }}">
                            </td>
                        </tr>
                        <small>Specify future date if not launched yet, past date if sale already started. Can leave blank if not determined yet or so long ago it doesn‘t matter.</small>
                    </table>
                </td>
            </tr>

            <tr>
                <td><label>Price Of Sale</label></td>
                <td><label class="label" for="mntprice">If your project is upcoming, what is your Mint price?</label><input type="number" value="{{ @$dropManagement->priceOfSale }}" name="priceOfSale" placeholder="Price Of Sale">
                    {{-- <div id="priceOfSaleError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Order Index</label></td>
                <td><input type="number" value="{{ @$dropManagement->orderIndex != null || @$dropManagement->orderIndex != 0  ? @$dropManagement->orderIndex : 0 }}" name="orderIndex" placeholder="Order Index Number"><div id="orderIndexError"></div></td>
                
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
        var slug = $("input[name=\"slug\"]").val();
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
        
        var nftStatus             = $("input[name='nftStatus']:checked").val();
        var collectionItem             = $("input[name='collectionItem']").val();

        var blockChain             = $("input[name='blockChain']").val();
        var contractAddress             = $("input[name='contractAddress']").val();
        var token             = $("input[name='token']").val();
        var metaData             = $("#metaData").val()
        var saleDate             = $("input[name='saleDate']").val();   
        var saleEndDate             = $("input[name='saleEndDate']").val();
        var saleTime             = $("input[name='saleTime']").val();
        var priceOfSale             = $("input[name='priceOfSale']").val();
        var orderIndex = $("input[name='orderIndex']").val();
        var dropManagementId = $("input[name='dropManagementId']").val();
        // var slug = $("input[name=\"name\"]").val();
        const regexExp = /^[a-z0-9]+(?:-[a-z0-9]+)*$/g;
       
        var fd = new FormData();
        if(dropManagementId == ''){
            dropManagementId = 0;
        }

        fd.append('name', name);
        fd.append('slug', slug);
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
        fd.append('nftStatus', nftStatus);
        fd.append('collectionItem', collectionItem);
        fd.append('blockChain', blockChain);
        fd.append('contractAddress', contractAddress);
        fd.append('token', token);
        fd.append('metaData', metaData);
        fd.append('saleDate', saleDate);
        fd.append('saleEndDate', saleEndDate);
        fd.append('saleTime', saleTime);
        fd.append('priceOfSale', priceOfSale);
        fd.append('orderIndex', orderIndex);
        fd.append('dropManagementId', dropManagementId);

        if(name == '')
        {
            flag = 0;
            $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
        }
        if (slug == '') 
        {
            flag = 0;
            $("#slugError").html('<span style="color:red;">Slug Required</span>');
        } 
        else if(!regexExp.test(slug))
        {
            flag = 0;
            $("#slugError").html('<span style="color:red;">Remove special character & space from slug</span>');
        }
        if(email == '')
        {
            flag = 0;
            $("#emailError").html('<span class="errorMessage" style="color:red;">Email Required</span>');
        }
         if(location == '')
        {
            flag = 0;
            $("#locationError").html('<span class="errorMessage" style="color:red;">Location Required</span>');
        }
        if(phone == '')
        {
            flag = 0;
            $("#phoneError").html('<span class="errorMessage" style="color:red;">Phone Required</span>');
        }
        if(skype == '')
        {
            flag = 0;
            $("#skypeError").html('<span class="errorMessage" style="color:red;">Skype ID Required</span>');
        }
        if(projectName == '')
        {
            flag = 0;
            $("#projectNameError").html('<span class="errorMessage" style="color:red;">Project Name Required</span>');
        }
        if(shortDescription == '')
        {
            flag = 0;
            $("#shortDescriptionError").html('<span class="errorMessage" style="color:red;">Short Description Required</span>');
        }
        if(twitterLink == '')
        {
            flag = 0;
            $("#twitterLinkError").html('<span class="errorMessage" style="color:red;">Twitter Link Required</span>');
        }
        if(twitterLink != '' && isValidHttpUrl(twitterLink) == false)
        {
            flag = 0;
            $("#twitterLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Twitter Link is Invalid</span>');
        }
        if(discordLink == '')
        {
            flag = 0;
            $("#discordLinkError").html('<span class="errorMessage" style="color:red;">Discord Link Required</span>');
        }
        if(discordLink != '' && isValidHttpUrl(discordLink) == false)
        {
            flag = 0;
            $("#discordLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Discord Link is Invalid</span>');
        }
        if(websiteLink == '')
        {
            flag = 0;
            $("#websiteLinkError").html('<span class="errorMessage" style="color:red;">Website Link Required</span>');
        }
        if(websiteLink != '' && isValidHttpUrl(websiteLink) == false)
        {
            flag = 0;
            $("#websiteLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Website Link is Invalid</span>');
        }
        if(collectionName == '')
        {
            flag = 0;
            $("#collectionNameError").html('<span class="errorMessage" style="color:red;">Collection Name Required</span>');
        }
        if(collectionItem == '')
        {
            flag = 0;
            $("#collectionItemError").html('<span class="errorMessage" style="color:red;">Collection Item Required</span>');
        }
        if (orderIndex == '') 
        {
            flag = 0;
            $("#orderIndexError").html('<span class="errorMessage" style="color:red;">Order Index Required</span>');
        }
        
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