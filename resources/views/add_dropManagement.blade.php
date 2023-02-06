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
                    {{-- <div id="categoryIdError"></div> --}}
                </td>
            </tr>
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
                <td><label>Token</label></td>
                <td><input type="text" value="{{ @$dropManagement->token }}" name="token" placeholder="Token">
                    {{-- <div id="tokenError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Block-Chain</label></td>
                <td><input type="text" value="{{ @$dropManagement->blockChain }}" name="blockChain" placeholder="Block Chain">
                    {{-- <div id="blockChainError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Price Of Sale</label></td>
                <td><input type="number" value="{{ @$dropManagement->priceOfSale }}" name="priceOfSale" placeholder="Price Of Sale">
                    {{-- <div id="priceOfSaleError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Sale Date</label></td>
                <td><input type="text" class="datepicker" value="{{ @$dropManagement->saleDate }}" name="saleDate" placeholder="Sale Date">
                    {{-- <div id="saleDateError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Discord Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->discordLink }}" name="discordLink" placeholder="Discord Link">
                    {{-- <div id="discordLinkError"></div> --}}
                    <div id="discordLinkURLPatternError"></div></td>
            </tr>
            <tr>
                <td><label>Twitter Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->twitterLink }}" name="twitterLink" placeholder="Twitter Link">
                    {{-- <div id="twitterLinkError"></div> --}}
                    <div id="twitterLinkURLPatternError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Website Link</label></td>
                <td><input type="text" value="{{ @$dropManagement->websiteLink }}" name="websiteLink" placeholder="Website Link">
                    {{-- <div id="websiteLinkError"></div> --}}
                    <div id="websiteLinkURLPatternError"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 1</label><small class="text-muted">Choose Image 1 size of 370x300 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$dropManagement->image }}" placeholder="Upload Image" id="image" 
                                name="image" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$dropManagement->image != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$dropManagement->image }}" width="100"></div>
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
                    @if(@$dropManagement->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$dropManagement->image}}" width = "100" alt="{{ @$dropManagement->image1_alt }}"></div>
                    @endif --}}
                </td>
            </tr>
            <tr>
                <td><label>Image 1 alt</label></td>
                <td>
                   <input type="text" value="{{ @$dropManagement->image1_alt }}" name="image1_alt" placeholder="Image 1 alt tag"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 2</label><small class="text-muted">Choose Image 2 size of 1170x610 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$dropManagement->image2 }}" placeholder="Upload Image" id="image2" 
                                name="image2" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$dropManagement->image2 != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$dropManagement->image2 }}" width="100"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('image2')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('image2')" data-id="image2" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="image" id="image2">
                    @if(@$dropManagement->image != '')
                    <div><img src="{{asset('uploads/').'/'.@$dropManagement->image2}}" width = "100" alt="{{ @$dropManagement->image2_alt }}"></div>
                    @endif --}}
                </td>
            </tr>
            <tr>
                <td><label>Image 2 alt</label></td>
                <td>
                   <input type="text" value="{{ @$dropManagement->image2_alt }}" name="image2_alt" placeholder="Image 2 alt tag"></div>
                </td>
            </tr>
            <tr>
                <td><label>Image 3 (Logo)</label><small class="text-muted">Choose Image 3 size of 200x200 pixels</small></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$dropManagement->logo }}" placeholder="Upload Image" id="logo" 
                                name="logo" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$dropManagement->logo != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$dropManagement->logo }}" width="100"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('logo')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('logo')" data-id="logo" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="logo" id="logo">
                    @if(@$dropManagement->logo != '')
                    <div><img src="{{asset('uploads/').'/'.@$dropManagement->logo}}" width = "100" alt="{{ @$dropManagement->image3_alt }}"></div>
                    @endif --}}
                </td>
            </tr>
            <tr>
                <td><label>Image 3 alt</label></td>
                <td>
                   <input type="text" value="{{ @$dropManagement->image3_alt }}" name="image3_alt" placeholder="Image 3 alt tag"></div>
                </td>
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
                            <td>Featured</td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->start_date }}" name="start_date" placeholder="Start Date">
                                <div id="start_dateError"></div>
                            </td>
                            <td>
                                <input type="text" class="datepicker" value="{{ @$dropManagement->end_date }}" name="end_date" placeholder="End Date">
                                <div id="end_dateError"></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><label>Order Index</label></td>
                <td><input type="number" value="{{ @$dropManagement->orderIndex != null || @$dropManagement->orderIndex != 0  ? @$dropManagement->orderIndex : 0 }}" name="orderIndex" placeholder="Order Index Number"><div id="orderIndexError"></div></td>
                
            </tr>
            <tr>
                <td><label>Meta Title</label></td>
                <td><input type="text" value="{{ @$dropManagement->metaTitle }}" name="metaTitle" placeholder="Meta Title"></td>
            </tr>
            <tr>
                <td><label>Meta Description</label></td>
                <td><textarea rows="5" cols="30" name="description" id="description" placeholder="Meta Description">{{@$dropManagement->description}}</textarea></td>
            </tr>
            <tr>
                <td><label>Meta Keywords</label></td>
                <td><textarea rows="5" cols="30" name="keywords" id="keywords" placeholder="Meta Keywords">{{ @$dropManagement->keywords }}</textarea></td>
            </tr>
            <tr>
                <td><label>Upload Social Banner</label></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <input value="{{ @$dropManagement->uploadSocialBanner }}" placeholder="Upload Image" id="uploadSocialBanner" 
                                name="uploadSocialBanner" type="text" class="form-control " readonly="">
                            <br clear="all" />
                            @if (@$dropManagement->uploadSocialBanner != '')
                                <div><img src="{{ asset('uploads/') . '/' . @$dropManagement->uploadSocialBanner }}" width="100"></div>
                            @endif
                        </div>
                        <div class="col-lg-1 col-xl-1 mr-2">
                            <button type="button" class="btn btn-warning" onclick="loadImages('uploadSocialBanner')" data-toggle="modal" data-target="#media-model" data-control="image">Browse</button>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <a href="javascript:;" onclick="removeImage('uploadSocialBanner')" data-id="uploadSocialBanner" class="btn btn-danger remove-image">Remove</a>
                        </div>
                    </div>
                    {{-- <input type="file" name="uploadSocialBanner" id="uploadSocialBanner">
                    @if(@$dropManagement->uploadSocialBanner != '')
                    <div><img src="{{asset('uploads/').'/'.@$dropManagement->uploadSocialBanner}}" width = "100"></div>
                    @endif
                    <div id="uploadSocialBannerError"></div> --}}
                </td>
            </tr>
            <tr>
                <td><label>Social Banner alt</label></td>
                <td>
                   <input type="text" value="{{ @$dropManagement->social_banner_alt }}" name="social_banner_alt" placeholder="Social Banner alt"></div>
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
        var metaTitle        = $("input[name=\"metaTitle\"]").val();
        var description      = $("#description").val();
        var keywords         = $("#keywords").val();
        var orderIndex = $("input[name='orderIndex']").val();
        var categoryId       = $("select[name='categoryId[]']").val();
        var name             = $("input[name='name']").val();
        var slug = $("input[name=\"slug\"]").val();
        var token            = $("input[name='token']").val();
        var blockChain       = $("input[name='blockChain']").val();
        var priceOfSale      = $("input[name='priceOfSale']").val();
        // var saleDate         = $("input[name='saleDate']").val();
        var saleDate         = $("input[name='saleDate']").map(function(){return $(this).val();}).get();
        var discordLink      = $("input[name='discordLink']").val();
        var twitterLink      = $("input[name='twitterLink']").val();
        var websiteLink      = $("input[name='websiteLink']").val();
        var start_date      = $("input[name='start_date']").val();
        var end_date      = $("input[name='end_date']").val();
        var dropManagementId = $("input[name='dropManagementId']").val();
        var image1_alt = $("input[name=\"image1_alt\"]").val();
        var image2_alt = $("input[name=\"image2_alt\"]").val();
        var image3_alt = $("input[name=\"image3_alt\"]").val();
        var social_banner_alt = $("input[name=\"social_banner_alt\"]").val();
        var image = $("input[name=\"image\"]").val();
        var image2 = $("input[name=\"image2\"]").val();
        var logo = $("input[name=\"logo\"]").val();
        var uploadSocialBanner = $("input[name=\"uploadSocialBanner\"]").val();
        const regexExp = /^[a-z0-9]+(?:-[a-z0-9]+)*$/g;
        var fd = new FormData();
        if(dropManagementId == ''){
            dropManagementId = 0;
        }
        // Append image 
        /*var files = $('#image')[0].files;
        if(files.length > 0)
        {
            fd.append('image',files[0]);
        }
        // Append image2 
        var files = $('#image2')[0].files;
        if(files.length > 0)
        {
            fd.append('image2',files[0]);
        }
        // Append logo 
        var files = $('#logo')[0].files;
        if(files.length > 0)
        {
            fd.append('logo',files[0]);
        }*/

        fd.append('categoryId', categoryId);
        fd.append('metaTitle', metaTitle);
        fd.append('description', description);
        fd.append('keywords', keywords);
        fd.append('orderIndex', orderIndex);
        fd.append('name', name);
        fd.append('slug', slug);
        fd.append('token', token);
        fd.append('blockChain', blockChain);
        fd.append('priceOfSale', priceOfSale);
        fd.append('saleDate', saleDate);
        fd.append('discordLink', discordLink);
        fd.append('twitterLink', twitterLink);
        fd.append('websiteLink', websiteLink);
        fd.append('start_date', start_date);
        fd.append('end_date', end_date);
        fd.append('dropManagementId', dropManagementId);
        fd.append('image1_alt', image1_alt);
        fd.append('image2_alt', image2_alt);
        fd.append('image3_alt', image3_alt);
        fd.append('social_banner_alt', social_banner_alt);
        fd.append('image', image);
        fd.append('image2', image2);
        fd.append('logo', logo);
        fd.append('uploadSocialBanner', uploadSocialBanner);

         // Append article 1 
        // var files = $('#uploadSocialBanner')[0].files;
        // if(files.length > 0)
        // {
        //     fd.append('uploadSocialBanner',files[0]);
        // }
        // if (categoryId == '' || categoryId == null) 
        // {
        //     flag = 0;
        //     $("#categoryIdError").html('<span class="errorMessage" style="color:red;">Category Required</span>');
        // } 
        // if (metaTitle == '') 
        // {
        //     flag = 0;
        //     $("#metaTitleError").html('<span class="errorMessage" style="color:red;">Meta Title Required</span>');
        // }
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
        if (orderIndex == '') 
        {
            flag = 0;
            $("#orderIndexError").html('<span class="errorMessage" style="color:red;">Order Index Required</span>');
        }
        if (name == '') 
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
        // if (priceOfSale == 0) 
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
        // URL validation
        if(discordLink != '' && isValidHttpUrl(discordLink) == false)
        {
            flag = 0;
            $("#discordLinkURLPatternError").html('<span class="errorMessage" style="color:red;">Discord Link is Invalid</span>');
        }

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
                url: "{{ url('siteadmin/save_dropManagement') }}",
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