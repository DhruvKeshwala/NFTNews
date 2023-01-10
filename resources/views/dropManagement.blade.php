@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>NFT Drops</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_dropManagement')}}" class="btn btn-info">Add NFT Drops</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $dropManagement->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_dropManagement') }}" method="get">
                @csrf
                <td class="pr-0"><input type="text" name="filterDropName" size="40" placeholder="Name"></td>

                <td class="pr-0"><input type="text" name="filterBlockChain" size="40" placeholder="Block Chain"></td>
                
                <td class="pr-0"><input type="number" name="filterPriceOfSale" size="20" placeholder="Price Of Sale"></td>

                <td><input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white"></td>
            </form>
          </tr>
         </tbody></table>
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="18%">Name</th>
                    <th width="12%">Category</th>
                    <th width="20%">Token</th>
                    <th width="20%">Block-Chain</th>
                    <th width="8%">Price Of Sale</th>
                    <th width="10%">Sale Date</th>
                    <!-- <th>Discord Link</th>
                    <th>Twitter Link</th>
                    <th>Website Link</th> -->
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($dropManagement)<=0)
                <tr>
                    <td colspan="11" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($dropManagement as $dropManagementDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$dropManagementDetails->name}}</td>
                    <td class="text-center">@if($dropManagementDetails->category != null) {{$dropManagementDetails->category}} @else <span>—</span> @endif</td>
                    <td>{{$dropManagementDetails->token}}</td>
                    <td>{{$dropManagementDetails->blockChain}}</td>
                    <td>{{$dropManagementDetails->priceOfSale}}</td>
                    <td>{{date('d-m-Y', strtotime($dropManagementDetails->saleDate))}}</td>
                    <!-- <td>{{$dropManagementDetails->discordLink}}</td>
                    <td>{{$dropManagementDetails->twitterLink}}</td>
                    <td>{{$dropManagementDetails->websiteLink}}</td> -->
                    <td>
                        <a title="Edit" href="{{ route('add_dropManagement',$dropManagementDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deleteNews('{{$dropManagementDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <a href="{{ route('dropManagement_detail',$dropManagementDetails->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $dropManagement->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteNews(id) {
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
                    url: "{{ url('siteadmin/delete_dropManagement') }}",
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