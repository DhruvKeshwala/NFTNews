<div id="mainPage">
    <div class="row">
        <div class="col-md-8" id="page">
            <div class="row finali">
                @foreach (@$media as $value)
                    <div class="col-md-3">
                        <img class="selectFile" data-category="{{ @$value->type }}" data-url="{{ @$value->image }}"
                            data-thumbnails="206 x 172" data-description="No description" data-filename="7811674906944"
                            data-type="jpg" data-dimensions="{{ @$value->dimensions }}"
                            data-title="{{ @$value->title }}" data-id="{{ @$value->id }}"
                            data-file="{{ @$value->image }}" src="{{ asset('uploads/media') . '/' . @$value->image }}"
                            alt="{{ $value->image_alt }}" width="150px" height="150px">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4" id="menu3" style="display: none;">
            <div class="right-side">
                <div class="right-side-img">
                    <img class="selectFile" src="" id="selectedimage">
                </div>
                <div class="url-bar">
                    <label>URL :</label>
                    <input class="url-input" type="text" value="" id="imageurl">
                </div>
                <div id="imageDetail">
                    <ul>
                        <li id="title"><strong>Title: </strong>No Title</li>
                        <li id="fileName"><strong>File Name: </strong>
                        </li>
                        <li id="type"><strong>Type : </strong></li>
                        <li id="category"><strong>Category : </strong></li>
                        <li id="dimensions"><strong>Dimensions : </strong></li>
                        <li id="url"><strong>URL:
                            </strong>
                        </li>
                        <li id="thumbnailsDimensions"><strong>Thumbnails Dimensions: </strong></li>
                        <li id="thumbnailsurl"><strong>Thumbnails URL:
                            </strong>
                        </li>

                    </ul>
                    <p id="deletebtn"><a class="delete-from-uploads btn btn-danger mr-2 mb-2 float-right"
                            data-id="{{ @$value->id }}" href="javascript:void(0);">Delete</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".selectFile", function() {
        var base_url = window.location.origin;

        console.log($(this).val());
        $(".selectFile").removeAttr('style');
        $(this).css("border", "5px solid");
        $('#selectFileName').val($(this).data('file'));
        $('#menu3').show();
        var base = base_url + '/NFTNews/uploads/media/';
        var name = base_url + '/NFTNews/uploads/media/' + $(this)
            .data('file');
        var name2 = base_url + '/NFTNews/uploads/media/' + $(this).data(
            'file');
        $('#imageurl').val(name);
        document.getElementById('selectedimage').src = $(this).attr('src');
        $('#title').html("<strong>Title: </strong>" + $(this).data('title'));
        $('#fileName').html($(this).data('file'));
        $('#type').html("<strong>Type : </strong>" + $(this).data('type'));
        $('#dimensions').html("<strong>Dimensions : </strong>" + $(this).data('dimensions'));
        $('#thumbnailsDimensions').html("<strong>Thumbnails Dimensions: </strong>" + $(this).data(
            'thumbnails'));
        $('#category').html("<strong>Category : </strong>" + $(this).data('category'));
        $('#url').html("<strong>URL: </strong>" + name2);
        $('#thumbnailsurl').html("<strong>Thumbnails URL: </strong>" + name);
        $('#deletebtn').html(
            "<a class='delete-from-uploads btn btn-danger mr-2 mb-2 float-right' data-id=" + $(
                this).data('id') + " href='javascript:void(0);' >Delete</a>");
    });
</script>
