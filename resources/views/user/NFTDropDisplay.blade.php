@php
$last_id = '';
@endphp

    {{-- <table class="table border text-dark table-responsive-sm table-striped table-borderless">
        <thead>
        <tr>
            <th width="2%">&nbsp;</th>
            <th width="20%">Name</th>
            <th width="18%">Token</th>
            <th width="20%">Blockchain</th>
            <th width="20%">Price of Sale</th>
            <th width="10%">Sale Date</th>
            <th width="10%">&nbsp;</th>
        </tr>
        </thead>
        <tbody> --}}
    @if(count(@$data))
        @foreach($data as $dropManagement)
            <tr>
                <td><img src="{{URL::asset('uploads/' . @$dropManagement->logo) }}" class="rounded-pill" width="34" height="34" alt="" /></td>
                <td>{{@$dropManagement->name}}</td>
                <td>{{@$dropManagement->token}}</td>
                <td><strong>{{@$dropManagement->blockChain}}</strong></td>
                <td>{{@$dropManagement->priceOfSale}}</td>
                <td>{{@$dropManagement->saleDate}}</td>
                <td><a href="{{@$dropManagement->twitterLink}}" target="_blank"><i class="fa fa-twitter mr-3"></i> <a href="{{@$dropManagement->discordLink}}" target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
            </tr>
            @php $last_id = $dropManagement->id; @endphp
            <div data-id="{{@$last_id}}"></div>
            @endforeach
    {{-- @php
        
        $output = '</tbody>
            </table><div id="load_more">
        <button name="load_more_button" class="btn d-block btn-outline-light py-2 mt-4 form-control" data-id="'.$last_id.'" id="load_more_button">View More NFT Drops</button>
        </div>';
    @endphp
    @else
    @php
        $output = '</tbody>
            </table>
        <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">You Reached At The End Of Records</button>
        </div>';
    @endphp --}}
    @endif 
    {{-- {!!$output!!}     --}}
    
