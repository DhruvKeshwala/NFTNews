@extends('layouts.user.header')

@section('title', 'NFT Markets | Subscribe')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{ URL::asset('images/bg-inner.jpg')}};" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate">
          	<p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i class="fa fa-angle-right"></i></span><span>Subscribe</span></p>
          </div>
        </div>
      </div>
    </section>
	
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">  
      <!-- Modal content-->     
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         <div class="row">
         	<div class="col-md-5"><img src="{{ URL::asset('images/newsletter-popup-image-1.jpg') }}" width="100%" height="auto" alt=""></div>
            <div class="col-md-7">
            	<h5 class="modal-title">THE MOST POPULAR</h5>
		        <h3 class="modal-title mb-3">NFTs IN THE MARKET</h3>
                
                <p>Looking for the latest NFTs collection that will launch soon? You're in the right place. Stay upto date on the latest NFTs trends, giveaways & competitions!</p>
                
                <!-- SUBSCRIBE FORM -->
                <form action="#" class="form-consultation">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email">
                  </div>
                </form>
                <button type="submit" class="btn btn-primary mt-2 mb-5 bt-mdl">
                   Subscribe
                   <i class="fa fa-paper-plane"></i>
                </button>
                
                <h6>“*Dont forget to follow us on our socials, Stay connected!"</h6>
                <p>By entering your email, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
                
           </div>
         </div>
          
        </div>
      </div>
      
    </div>
  </div>
  
    <section class="ftco-section py-0">
    	<div class="container">
    		<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row no-gutters">
								<div class="col-lg-8 col-md-7 d-flex align-items-stretch">
									<div class="contact-wrap w-100 py-md-5 py-4">
										<h3 class="mb-4">Subscribe</h3>
                                        <p>Sign up for free newsletters and get more NFT Markets delivered to your inbox</p>
                                        
                                        <div class="form-group">
                                          <small>Get this delivered to your inbox, and more info about our products and services. </small>
                                        </div>
										<div id="form-message-warning" class="mb-4"></div> 
					      				<div id="form-message-success" class="mb-4"></div>
										<form method="POST" action="{{ route('sendMailForSubscribe') }}" id="contactForm" name="contactForm" class="contactForm">
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
														<input type="email" class="form-control border" name="email" id="email" placeholder="Email Address" value="{{old('email')}}">
														@if ($errors->has('email'))
														<span class="text-danger">{{ $errors->first('email') }}</span>
														@endif
													</div>
												</div>
                                                <div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control border" name="phn" id="phone" placeholder="Phone" value="{{old('phn')}}">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control border" name="subject" id="subject" placeholder="Subject" value="{{old('subject')}}">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
													<textarea name="message" class="form-control border" id="message" cols="30" rows="4" placeholder="Message">{{old('message')}}</textarea>
													</div>
												</div>
                                                <div class="col-md-12">
													<div class="form-group">
                                                       <div class="row">
                                                        <div class="col-md-5">
														 <input type="text" class="form-control border border-light pl-3" name="captcha" id="captcha" placeholder="security code" required></div>
                                                        <div class="col-md-2 pl-0">
								                           	<span class="form-control text-center" style="background:rgba(0,0,0,.1)!important; color: rgba(0,0,0,.5)!important; padding-top: 16px;">{{@$fourRandomDigit}}</span>
															<input type="hidden" name="fourDigitRandom" value="{{@$fourRandomDigit}}">
														</div>
                                                       </div>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="SUBMIT" class="btn-lg pt-3 pb-3 px-4 border btn-outline-light-gradient">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-lg-4 col-md-5 order-md-last d-flex align-items-stretch">
                                	
								<div class="info-wrap text-dark w-100 p-md-5 p-3">
									<h4 class="text-info">SALES</h4>
									<p class="mb-4">Reach out to our Sales team for assistance with related inquiries.</p>
					        	  
                                    <div class="dbox text-dark w-100 d-flex align-items-center">
                                      <div class="icon d-flex align-items-center justify-content-center">
                                       <span class="fa fa-phone"></span>
                                      </div>
                                      <div class="text pl-3">
                                       <p><span>Phone:</span><br><a href="tel://+44 (0) 207 558 8486">+44 (0) 207 558 8486</a></p>
                                      </div>
					          		 </div>
                                    
					        		<div class="dbox w-100 d-flex align-items-center">
					        		  <div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-paper-plane"></span>
					        		  </div>
					        		  <div class="text pl-3">
						               <p><span>Email:</span><br><a href="mailto:info@yoursite.com">clientservices@nftmarkets.com</a></p>
                                       </div>
                                     </div>
                                     
                                     
                                    <h4 class="text-info">SUPPORT</h4>
									<p><strong>Already a member?</strong></p>
                                    <p class="mb-4">Our Mentors & IT Support team are standing by to help you.</p>
					        	  
                                    <div class="dbox w-100 d-flex align-items-center">
					        		  <div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-paper-plane"></span>
					        		  </div>
					        		  <div class="text pl-3">
						               <p><span>Email:</span><br><a href="mailto:info@yoursite.com">clientservices@nftmarkets.com</a></p>
                                       </div>
                                     </div>
                                     
                                    </div>
                                </div>
						</div>
					</div>
				</div>
			</div>
    	</div>
    </section>
@endsection