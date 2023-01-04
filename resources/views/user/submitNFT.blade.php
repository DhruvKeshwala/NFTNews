@extends('layouts.user.header')

@section('title', 'NFT Markets | Submit NFT')

@section('content')

<section class="hero-wrap hero-wrap-2">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Submit NFT</span></p>
          </div>
        </div>
      </div>
    </section>
   	
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    {{-- @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif --}}

    <section class="ftco-section py-5 drops-section bg-info-gradient-3">
      <div class="container">
      	<h2 class="text-center">GET YOUR PROJECT LISTED</h2>
        <p class="text-center">Submit your project by completing this form to be included on the "Upcoming NFT page"</p>
        
        
        <div class="contact-wrap p-md-5 mt-5 p-4">
            <div id="form-message-warning" class="mb-md-0"></div> 
            <div id="form-message-success" class="mb-md-0"></div>
            <form method="POST" id="contactForm" name="contactForm" action="{{route('user.submitnftpost')}}" class="contactForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="name" id="name" placeholder="Full Name" value="{{old('name')}}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="text" class="form-control border" name="email" id="email" placeholder="Email Address" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="location" id="location" placeholder="Location" value="{{old('location')}}">
                            @if ($errors->has('location'))
                                <span class="text-danger">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="phone" id="phone" placeholder="Phone Number" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="skype" id="skype" placeholder="Skype/Telegram ID" value="{{old('skype')}}">
                            @if ($errors->has('skype'))
                                <span class="text-danger">{{ $errors->first('skype') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="projectName" id="projectName" placeholder="Your Project’s Name" value="{{old('projectName')}}">
                            @if ($errors->has('projectName'))
                                <span class="text-danger">{{ $errors->first('projectName') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="twitterLink" value="{{old('twitterLink')}}" id="twitterLink" placeholder="Your Project's Official Twitter"><a name="tooltop" data-tooltip title="Enter as https://twitter.com/yourtwitterhandle, if you don’t have an official twitter for the project provide your personal twitter"><i class="fa fa-info-circle"></i></a>
                            @if ($errors->has('twitterLink'))
                                <span class="text-danger">{{ $errors->first('twitterLink') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="discordLink" value="{{old('discordLink')}}" id="discordLink" placeholder="Your Project‘s Official Discord">
                            @if ($errors->has('discordLink'))
                                <span class="text-danger">{{ $errors->first('discordLink') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="shortDescription" class="form-control border py-3" id="shortDescription" cols="30" rows="4" placeholder="Short Discription">{{old('shortDescription')}}</textarea>
                            @if ($errors->has('shortDescription'))
                                <span class="text-danger">{{ $errors->first('shortDescription') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                         <div class="col-10">
                            <label class="label" for="fees">Do you agree to pay the 0.6 ETH listing fee?* Price discounted by 50% valid through to 16th Sept 2022</label>
                            
                            <p>This allows your project to be listed within the upcoming collections section (as long as the site exists)</p></div>
                            <div class="col-2 pt-0 mt-0 d-flex">
                            	{{-- <label for="fees"><input type="checkbox" name="fees" class="form-control border" id="fees">Yes</label> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="websiteLink" value="{{old('websiteLink')}}" id="websiteLink" placeholder="Website URL: Enter as https://">
                            @if ($errors->has('websiteLink'))
                                <span class="text-danger">{{ $errors->first('websiteLink') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="collectionName" value="{{old('collectionName')}}" id="collectionName" placeholder="What is the number of items in your collection?"><a name="tooltip" class="float-left" data-tooltip title="Enter as https://opensea.io/collection/yourcollectionname"><i class="fa fa-info-circle"></i></a>
                            @if ($errors->has('collectionName'))
                                <span class="text-danger">{{ $errors->first('collectionName') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">What is the status of your NFT?*<a data-tooltip title="(If you don‘t know, it‘s likely Ethereum)"><i class="fa fa-info-circle"></i></a></label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="nftStatus" name="nftStatus" value="1" checked>
							    <label for="nftStatus" class="pr-3">All NFTs are minted and revealed and on OpenSea (or other marketplace)</label>
                            </div>
                            <div class="col-12 pt-3 px-0">                            
                                <input type="radio" id="nftStatus1" name="nftStatus" value="2">
							    <label for="nftStatus1" class="pr-3">Sale is upcoming, date is known.</label>
                            </div>
                            <div class="col-12 pt-3 px-0">
                                <input type="radio" id="nftStatus2" name="nftStatus" value="3">
							    <label for="nftStatus2" class="pr-3">Sale is ongoing and/or not all items have been minted or revealed.</label>
                            </div>
                            <div class="col-12 pt-3 px-0">
                                <input type="radio" id="nftStatus3" name="nftStatus" value="4">
							    <label for="nftStatus3" class="pr-3">Sale is upcoming, date unknown</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="mntprice">What is the maximum number of items in your collection?*</label>
                            <small>Or at least the first batch that you would like to be listed.</small>
                            <input type="number" class="form-control border" name="collectionItem" value="{{old('collectionItem')}}" id="collectionItem" placeholder="">
                            @if ($errors->has('collectionItem'))
                                <span class="text-danger">{{ $errors->first('collectionItem') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">Which blockchain is your collection on? <a data-tooltip title="(If you don‘t know, it‘s likely Ethereum)"><i class="fa fa-info-circle"></i></a></label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="blockChain" name="blockChain" value="Binance Smart Chain" checked>
							    <label for="blockChain" class="pr-3">Binance Smart Chain</label>
                                <input type="radio" id="blockChain1" name="blockChain" value="Cardano">
							    <label for="blockChain1" class="pr-3">Cardano</label>
                                <input type="radio" id="blockChain2" name="blockChain" value="Ethereum">
							    <label for="blockChain2" class="pr-3">Ethereum</label>
                                <input type="radio" id="blockChain3" name="blockChain" value="Matic">
							    <label for="blockChain3" class="pr-3">Matic</label>
                                <input type="radio" id="blockChain4" name="blockChain" value="Polygon">
							    <label for="blockChain4" class="pr-3">Polygon</label>
                                <input type="radio" id="blockChain5" name="blockChain" value="Solano">
							    <label for="blockChain5" class="pr-3">Solano</label>
                                <input type="radio" id="blockChain6" name="blockChain" value="Wax">
							    <label for="blockChain6" class="pr-3">Wax</label>
                                <input type="radio" id="blockChain7" name="blockChain" value="Other">
							    <label for="blockChain7" class="pr-3">Other</label>
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="contractAddress">What is your collection’s contract address(es)? <small>(If Availble)</small></label>
                            <input type="text" class="form-control border" name="contractAddress" id="contractAddress" value="{{old('contractAddress')}}" placeholder="">
                            @if ($errors->has('contractAddress'))
                                <span class="text-danger">{{ $errors->first('contractAddress') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">What type of token standard is your contract?*</label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="bchain011" name="token" value="ERC721" checked>
							    <label for="bchain011" class="pr-3">ERC721</label>
                                <input type="radio" id="bchain012" name="token" value="ERC1155">
							    <label for="bchain012" class="pr-3">ERC1155</label>
                                <input type="radio" id="bchain013" name="token" value="idontknow">
							    <label for="bchain013" class="pr-3">I don‘t know</label>
                                <input type="radio" id="bchain014" name="token" value="other">
							    <label for="bchain014" class="pr-3">Other</label>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="metaData">Is/will your item metadata be dynamic, or can they change after the sale ends? Will there be continuous minting (e.g., breeding?). If yes, please explain</label>
                            <textarea name="metaData" class="form-control border py-3" id="metaData" cols="30" rows="4" placeholder="">{{old('metaData')}}</textarea>
                            <small>Most projects metadata are fixed eg. think CryptoPunks, the attributes for a CryptoPunk never changes. However, some projects have dynamic metadata, for example some projects may have changable accessories. Others may have breeding resulting in continuous minting. If your project has features like this, please explain a bit about them here.</small>
                            @if ($errors->has('metaData'))
                                <span class="text-danger">{{ $errors->first('metaData') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">Your Project‘s Sale Start Date (If available) (in UTC only*)</label>
                        <div class="form-group row">
                         <div class="col-md-6">
                            <input type="date" class="form-control border" name="saleDate" id="saleDate" placeholder="Date" value="{{old('saleDate')}}">
                            @if ($errors->has('saleDate'))
                                <span class="text-danger">{{ $errors->first('saleDate') }}</span>
                            @endif
                         </div>
                          <div class="col-md-6">
                            <input type="time" class="form-control border" name="saleTime" id="saleTime" placeholder="Time" value="{{old('saleTime')}}">
                            @if ($errors->has('saleTime'))
                                <span class="text-danger">{{ $errors->first('saleTime') }}</span>
                            @endif  
                          </div>
                        </div>
                        <small>Specify future date if not launched yet, past date if sale already started. Can leave blank if not determined yet or so long ago it doesn‘t matter.</small>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">Your Project‘s Sale End Date (If available)</label>
                        <div class="form-group">
                            <input type="date" class="form-control border" name="saleEndDate" id="saleEndDate" placeholder="" value="{{old('saleEndDate')}}">
                            @if ($errors->has('saleEndDate'))
                                <span class="text-danger">{{ $errors->first('saleEndDate') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">If your project is upcoming, what is your Mint price?</label>
                        <div class="form-group">
                            <input type="number" class="form-control border" name="priceOfSale" id="priceOfSale" placeholder="Price (ETH)" value="{{old('priceOfSale')}}">
                            @if ($errors->has('priceOfSale'))
                                <span class="text-danger">{{ $errors->first('priceOfSale') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="form-group">
                           <div class="row">
                            <div class="col-md-5">
                             <input type="text" class="form-control border pl-3" name="captcha" id="captcha" placeholder="Security Code" value="{{old('captcha')}}">
                            @if ($errors->has('captcha'))
                                <span class="text-danger">{{ $errors->first('captcha') }}</span>
                            @endif
                            @if ($message = Session::get('error'))
                                <span class="text-danger">{{ $message }}</span>
                            @endif
                            </div>
                             <div class="col-md-2 pl-0">
                                <span class="form-control text-center" style="background: #000!important; color: #fff!important; padding-top: 15px;">{{@$fourRandomDigit}}</span>
                                <input type="hidden" name="fourDigitRandom" value="{{@$fourRandomDigit}}">
                                
                            </div>
                           </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                    	<div class="form-group">
                        	<label class="label">Can change to our terms &amp; conditions</label>
                            <div class="bg-dark text-white p-4 rounded">
                            	<p class="mb-0">By clicking the “Submit“ button, I agree to the Terms of Use, on behalf of myself and the entity that I am submitting this form on behalf of, and I acknowledge and represent that I have read and fully understand the Terms of Use</p>
                            </div>
                            <h5 class="text-center mt-3 mb-5">A copy of your responses will be emailed to the address you provided.</h5>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-4 text-center">
                        <div class="form-group">
                            <input type="submit" name="submit" value="SUBMIT" class="btn btn-lg px-5 py-3 btn-outline-light-gradient border">
                            <div class="submitting"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

      </div>
    </section>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    function saveNFT() 
    {
        $('.errorMessage').hide();
        var flag             = 1;
        // var categoryId       = $("select[name='categoryId[]']").val();
        var name             = $("input[name='name']").val();
        var email             = $("input[name='email']").val();
        var location             = $("input[name='location']").val();
        var phone             = $("input[name='phone']").val();
        var skype             = $("input[name='skype']").val();
        var projectName             = $("input[name='projectName']").val();
        var shortDescription             = $("textarea[name='shortDescription']").val();
        var collectionName             = $("input[name='collectionName']").val();
        // var nftStatus             = $("input[name='nftStatus']").val();
        var collectionItem       = $("input[name='collectionItem']").val();
        var contractAddress       = $("input[name='contractAddress']").val();
        var metaData      =  $("textarea[name='metaData']").val();
        var saleTime             = $("input[name='saleTime']").val();
        var saleEndDate             = $("input[name='saleEndDate']").val();
        // var token            = $("input[name='token']").val();
        // var blockChain       = $("input[name='blockChain']").val();
        var priceOfSale      = $("input[name='priceOfSale']").val();
        // var saleDate         = $("input[name='saleDate']").val();
        var saleDate         = $("input[name='saleDate']").map(function(){return $(this).val();}).get();
        var discordLink      = $("input[name='discordLink']").val();
        var twitterLink      = $("input[name='twitterLink']").val();
        var websiteLink      = $("input[name='websiteLink']").val();
        // var start_date      = $("input[name='start_date']").val();
        // var end_date      = $("input[name='end_date']").val();
        // var dropManagementId = $("input[name='dropManagementId']").val();
        var fd = new FormData();
        // if(dropManagementId == ''){
        //     dropManagementId = 0;
        // }
        // // Append image 
        // var files = $('#image')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image',files[0]);
        // }
        // // Append image2 
        // var files = $('#image2')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('image2',files[0]);
        // }
        // // Append logo 
        // var files = $('#logo')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('logo',files[0]);
        // }

        // fd.append('categoryId', categoryId);
        fd.append('name', name);
        fd.append('email', email);
        fd.append('location', location);
        fd.append('phone', phone);
        fd.append('skype', skype);
        fd.append('projectName', projectName);
        fd.append('shortDescription', shortDescription);
        fd.append('collectionName', collectionName);
        fd.append('collectionItem', collectionItem);
        fd.append('contractAddress', contractAddress);
        fd.append('metaData', metaData);
        fd.append('saleTime', saleTime);
        fd.append('saleEndDate', saleEndDate);
        

        // fd.append('token', token);
        // fd.append('blockChain', blockChain);
        fd.append('priceOfSale', priceOfSale);
        fd.append('saleDate', saleDate);
        fd.append('discordLink', discordLink);
        fd.append('twitterLink', twitterLink);
        fd.append('websiteLink', websiteLink);
        // fd.append('start_date', start_date);
        // fd.append('end_date', end_date);
        // fd.append('dropManagementId', dropManagementId);

        // if (categoryId == '' || categoryId == null) 
        // {
        //     flag = 0;
        //     $("#categoryIdError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
        // } 
                // if (name == '') 
                // {
                //     flag = 0;
                //     $("#nameError").html('<span class="errorMessage" style="color:red;">Name Required</span>');
                // }
        // if (token == '') 
        // {
        //     flag = 0;
        //     $("#tokenError").html('<span class="errorMessage" style="color:red;">Token Required</span>');
        // }
        // if (blockChain == '') 
        // {
        //     flag = 0;
        //     $("#blockChainError").html('<span class="errorMessage" style="color:red;">Block-Chain Required</span>');
        // } 
                // if (priceOfSale == 0 || priceOfSale == '') 
                // {
                //     flag = 0;
                //     $("#priceOfSaleError").html('<span class="errorMessage" style="color:red;">Price Of Sale Required</span>');
                // }
                // if (saleDate == '') 
                // {
                //     flag = 0;
                //     $("#saleDateError").html('<span class="errorMessage" style="color:red;">Sale Date Required</span>');
                // }

        //function for URL validation
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

        /*if (start_date == '') 
        {
            flag = 0;
            $("#start_dateError").html('<span class="errorMessage" style="color:red;">Start Date Required</span>');
        }

        if (end_date == '') 
        {
            flag = 0;
            $("#end_dateError").html('<span class="errorMessage" style="color:red;">End Date Required</span>');
        }*/

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
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            $.ajax({
                url: "{{ url('submit-nft') }}",
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
                                window.location.href =  "{{ URL::to('submit-nft') }}"
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {}
            });
        }
    }

</script>
@endsection