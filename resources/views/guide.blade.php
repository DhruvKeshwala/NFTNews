@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Guide</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_guide')}}" class="btn btn-info">Add Guide</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $guide->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_guide') }}" method="get">
                @csrf
                <td class="pr-0">
                    <select name="filterCategoryId" data-placeholder="Select Category">
                        <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                        <option value="{{ @$category->id }}" <?php 
                            if (!empty($_GET['filterCategoryId']) && $_GET['filterCategoryId'] == @$category->id) 
                            {
                            ?>   selected
                            <?php } ?>>{{ @$category->name }}</option>
                        @endforeach


                        {{-- <option value="GETTING STARTED" <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'GETTING STARTED') 
                            {
                            ?>   selected
                            <?php } ?>>GETTING STARTED</option>
                        <option value="BUYING"          <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'BUYING') 
                            {
                            ?>   selected
                            <?php } ?>>BUYING</option>
                        <option value="SELLING"         <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'SELLING') 
                            {
                            ?>   selected
                            <?php } ?>>SELLING</option>
                        <option value="CREATING"        <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'CREATING') 
                            {
                            ?>   selected
                            <?php } ?>>CREATING</option>
                        <option value="POLICIES"        <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'POLICIES') 
                            {
                            ?>   selected
                            <?php } ?>>POLICIES</option>
                        <option value="FAQS"            <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'FAQS') 
                            {
                            ?>   selected
                            <?php } ?>>FAQS</option>
                        <option value="USER SAFETY"     <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'USER SAFETY') 
                            {
                            ?>   selected
                            <?php } ?>>USER SAFETY</option>
                        <option value="DEVELOPERS"       <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'DEVELOPERS') 
                            {
                            ?>   selected
                            <?php } ?>>DEVELOPERS</option>
                        <option value="SOLANA"          <?php 
                            if (!empty($_GET['category']) && $_GET['category'] == 'SOLANA') 
                            {
                            ?>   selected
                            <?php } ?>>SOLANA</option>
                    </select> --}}
                </td>
                <td></td>
                <td></td>
                <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white">
                    <a href="{{ route('guide')}}"  class="btn btn-danger py-1 px-2 text-white">Reset</a>
                </td>
            </form>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="17%">Category</th>
                    <th width="35%">Question</th>
                    <th width="35%">Answer</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count(@$guide)<=0)
                <tr>
                    <td colspan="5" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($guide as $newsDetails)
                <tr>
                    <td>{{@$loop->index + 1}}</td>
                    <td>{{@$newsDetails->guideCategory->name}}</td>
                    <td>{!!substr(@$newsDetails->question, 0, 50)!!}.. </td>
                    <td>{!!substr(@$newsDetails->answer, 0, 50)!!}.. </td>
                    <td>
                        <a title="Edit" href="{{ route('add_guide',@$newsDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deleteGuide('{{@$newsDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <a href="{{ route('guide_detail',@$newsDetails->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $guide->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    $("select[name=\"category\"]").select2({
    });
   
    function deleteGuide(id) {
        swal({
            title: "Warning!",
            text: "Are you sure? You want to delete it",
            icon: "warning",
            buttons: ['No,cancel it','Yes,delete it'],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('siteadmin/delete_guide') }}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.success) {
                            swal({
                                title: "Success!",
                                text: data.message + " :)",
                                icon: "success",
                                buttons: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            }
        });
    }
</script>