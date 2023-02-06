@extends('layouts.user.header')

@section('title', 'NFT Markets | Contact')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg-inner.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate">
          <p class="breadcrumbs mb-0"><span><a href="{{route('user.home')}}">Home</a><i
                class="fa fa-angle-right"></i></span><span>Contact</span></p>
        </div>
      </div>
    </div>
  </section>

  <div class="container news-banner mb-3">
    @if(@$contactTopBanner->location != null)
        <a href="{{@$contactTopBanner->url}}" class="text-dark" target="_blank"><img
        src="{{ URL::asset('uploads/' . @$contactTopBanner->image) }}" width="100%"
        height="auto" @if($contactTopBanner->banner_image_alt != null || $contactTopBanner->banner_image_alt != "") alt="{{@$contactTopBanner->banner_image_alt}}" @else alt="Top Banner Image" @endif></a>
    @endif
  </div>

  <section class="ftco-section pt-0 pb-0 bg-info-gradient-3">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="wrapper">
            <div class="row no-gutters">
              <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
                <div class="contact-wrap w-100 py-5 bg-transparent">
                  <h3 class="mb-4">Contact Us</h3>
                  <p>Send us a message using the form below so that we may better serve you.</p>
                  <div id="form-message-warning" class="mb-4"></div>
                  <div id="form-message-success" class="mb-4"></div>
                  <form method="POST" id="contactForm" name="contactForm" class="contactForm" action="{{route('sendMailForContact')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control border border-light" name="name" id="name"
                            placeholder="Name" value="{{old('name')}}">
                            @if ($errors->has('name'))
														<span class="text-danger">{{ $errors->first('name') }}</span>
														@endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="email" class="form-control border border-light" name="email" id="email"
                            placeholder="Email Address" value="{{old('email')}}">
                            @if ($errors->has('email'))
														<span class="text-danger">{{ $errors->first('email') }}</span>
														@endif
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control border border-light" name="phone" id="phone"
                            placeholder="Phone" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
														<span class="text-danger">{{ $errors->first('phone') }}</span>
														@endif
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control border border-light" name="org" id="phone"
                            placeholder="Organisation" value="{{old('org')}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control border border-light" name="loc" id="phone"
                            placeholder="Location" value="{{old('loc')}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="text" class="form-control border border-light" name="nmeproj" id="subject"
                            placeholder="Name of Project" value="{{old('nmeproj')}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <select name="enquire_nature" class="border border-light text-light form-control">
                            <option value="">Select Enquiry Nature</option>
                            <option value="Existing listing">Existing listing</option>
                            <option value="New listing">New listing</option>
                            <option value="Advertising">Advertising</option>
                            <option value="Consultancy">Consultancy</option>
                            <option value="Media/PR">Media/PR</option>
                          </select>
                          @if ($errors->has('enquire_nature'))
														<span class="text-danger">{{ $errors->first('enquire_nature') }}</span>
														@endif
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea name="message" class="form-control border border-light" id="message" cols="30"
                            rows="4" placeholder="Insert Message Here">{{old('message')}}</textarea>
                            @if ($errors->has('message'))
														<span class="text-danger">{{ $errors->first('message') }}</span>
														@endif
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-5">
                              <input type="text" class="form-control border border-light pl-3" name="captcha"
                                id="captcha" placeholder="security code">
                                @if ($errors->has('captcha'))
                                  <span class="text-danger">{{ $errors->first('captcha') }}</span>
                                @endif
                            </div>
                            <div class="col-md-2 pl-0">
                              <span class="form-control text-center"
                                style="background:rgba(0,0,0,.1)!important; color: rgba(0,0,0,.5)!important; padding-top: 16px;">{{@$fourRandomDigit}}</span>
                                <input type="hidden" name="fourDigitRandom" value="{{@$fourRandomDigit}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="submit" value="SUBMIT"
                            class="btn-lg pt-3 pb-3 px-4 border btn-outline-light-gradient">
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