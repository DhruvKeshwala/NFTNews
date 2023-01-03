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
   	
    
    <section class="ftco-section py-5 drops-section bg-info-gradient-3">
      <div class="container">
      	<h2 class="text-center">GET YOUR PROJECT LISTED</h2>
        <p class="text-center">Submit your project by completing this form to be included on the "Upcoming NFT page"</p>
        
        
        <div class="contact-wrap p-md-5 mt-5 p-4">
            <div id="form-message-warning" class="mb-md-0"></div> 
            <div id="form-message-success" class="mb-md-0"></div>
            <form method="POST" id="contactForm" name="contactForm" class="contactForm" action="{{ route('user.save_ubmitnft') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="name" id="name" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <input type="email" class="form-control border" name="email" id="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="location" id="location" placeholder="Location">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="phn" id="phone" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="sktlgrmid" id="sktlgrmid" placeholder="Skype/Telegram ID">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="sktlgrmid" id="sktlgrmid" placeholder="Your Project’s Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="prjttwt" id="prjttwt" placeholder="Your Project's Official Twitter"><a name="tooltop" data-tooltip title="Enter as https://twitter.com/yourtwitterhandle, if you don’t have an official twitter for the project provide your personal twitter"><i class="fa fa-info-circle"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="prjtdscord" id="prjtdscord" placeholder="Your Project‘s Official Discord">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="prjtshrtdec" class="form-control border py-3" id="prjtshrtdec" cols="30" rows="4" placeholder="Short Discription"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                         <div class="col-10">
                            <label class="label" for="fees">Do you agree to pay the 0.6 ETH listing fee?* Price discounted by 50% valid through to 16th Sept 2022</label>
                            
                            <p>This allows your project to be listed within the upcoming collections section (as long as the site exists)</p></div>
                            <div class="col-2 pt-0 mt-0 d-flex">
                            	<label for="fees"><input type="checkbox" name="fees" class="form-control border" id="fees">Yes</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="wurl" id="wurl" placeholder="Website URL: Enter as https://">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control border" name="itmnums" id="itmnums" placeholder="What is the number of items in your collection?"><a name="tooltip" class="float-left" data-tooltip title="Enter as https://opensea.io/collection/yourcollectionname"><i class="fa fa-info-circle"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">What is the status of your NFT?*<a data-tooltip title="(If you don‘t know, it‘s likely Ethereum)"><i class="fa fa-info-circle"></i></a></label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="bchain" name="bchain" checked>
							    <label for="bchain" class="pr-3">All NFTs are minted and revealed and on OpenSea (or other marketplace)</label>
                            </div>
                            <div class="col-12 pt-3 px-0">                            
                                <input type="radio" id="bchain1" name="bchain">
							    <label for="bchain1" class="pr-3">Sale is upcoming, date is known.</label>
                            </div>
                            <div class="col-12 pt-3 px-0">
                                <input type="radio" id="bchain2" name="bchain">
							    <label for="bchain2" class="pr-3">Sale is ongoing and/or not all items have been minted or revealed.</label>
                            </div>
                            <div class="col-12 pt-3 px-0">
                                <input type="radio" id="bchain3" name="bchain">
							    <label for="bchain3" class="pr-3">Sale is upcoming, date unknown</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="mntprice">What is the maximum number of items in your collection?*</label>
                            <small>Or at least the first batch that you would like to be listed.</small>
                            <input type="text" class="form-control border" name="mntprice" id="mntprice" placeholder="">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">Which blockchain is your collection on? <a data-tooltip title="(If you don‘t know, it‘s likely Ethereum)"><i class="fa fa-info-circle"></i></a></label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="bchain" name="bchain" checked>
							    <label for="bchain" class="pr-3">Binance Smart Chain</label>
                                <input type="radio" id="bchain1" name="bchain">
							    <label for="bchain1" class="pr-3">Cardano</label>
                                <input type="radio" id="bchain2" name="bchain">
							    <label for="bchain2" class="pr-3">Ethereum</label>
                                <input type="radio" id="bchain3" name="bchain">
							    <label for="bchain3" class="pr-3">Matic</label>
                                <input type="radio" id="bchain4" name="bchain">
							    <label for="bchain4" class="pr-3">Polygon</label>
                                <input type="radio" id="bchain5" name="bchain">
							    <label for="bchain5" class="pr-3">Solano</label>
                                <input type="radio" id="bchain6" name="bchain">
							    <label for="bchain6" class="pr-3">Wax</label>
                                <input type="radio" id="bchain7" name="bchain">
							    <label for="bchain7" class="pr-3">Other</label>
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="mntprice">What is your collection’s contract address(es)? <small>(If Availble)</small></label>
                            <input type="text" class="form-control border" name="mntprice" id="mntprice" placeholder="">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="prjctrmap">What type of token standard is your contract?*</label>
                            <div class="col-12 pt-3 px-0">
                            	<input type="radio" id="bchain011" name="bchain1" checked>
							    <label for="bchain011" class="pr-3">ERC721</label>
                                <input type="radio" id="bchain012" name="bchain1">
							    <label for="bchain012" class="pr-3">ERC1155</label>
                                <input type="radio" id="bchain013" name="bchain1">
							    <label for="bchain013" class="pr-3">I don‘t know</label>
                                <input type="radio" id="bchain014" name="bchain1">
							    <label for="bchain014" class="pr-3">Other</label>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <label class="label" for="pgeshrtdesc">Is/will your item metadata be dynamic, or can they change after the sale ends? Will there be continuous minting (e.g., breeding?). If yes, please explain</label>
                            <textarea name="pgeshrtdesc" class="form-control border py-3" id="pgeshrtdesc" cols="30" rows="4" placeholder=""></textarea>
                            <small>Most projects metadata are fixed eg. think CryptoPunks, the attributes for a CryptoPunk never changes. However, some projects have dynamic metadata, for example some projects may have changable accessories. Others may have breeding resulting in continuous minting. If your project has features like this, please explain a bit about them here.</small>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">Your Project‘s Sale Start Date (If available) (in UTC only*)</label>
                        <div class="form-group row">
                         <div class="col-md-6">
                            <input type="date" class="form-control border" name="prjctdte" id="prjctdte" placeholder="Date">
                          </div>
                          <div class="col-md-6">
                            <input type="time" class="form-control border" name="prjcttim" id="prjcttim" placeholder="Time">
                          </div>
                        </div>
                        <small>Specify future date if not launched yet, past date if sale already started. Can leave blank if not determined yet or so long ago it doesn‘t matter.</small>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">Your Project‘s Sale End Date (If available)</label>
                        <div class="form-group">
                            <input type="date" class="form-control border" name="prjctdte" id="prjctdte" placeholder="">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="label" for="mntprice">If your project is upcoming, what is your Mint price?</label>
                        <div class="form-group">
                            <input type="number" class="form-control border" name="prjctdte" id="prjctdte" placeholder="Price (ETH)">
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="form-group">
                           <div class="row">
                            <div class="col-md-5">
                             <input type="text" class="form-control border pl-3" name="captcha" id="captcha" placeholder="Security Code" required></div>
                            <div class="col-md-2 pl-0">
                                <span class="form-control text-center" style="background: #000!important; color: #fff!important; padding-top: 15px;">4073</span>
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
                            <input type="submit" value="SUBMIT" class="btn btn-lg px-5 py-3 btn-outline-light-gradient border">
                            <div class="submitting"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

      </div>
    </section>

@endsection