<div class="NFTDrops">
        <table class="table border text-dark table-responsive-sm table-striped table-borderless">
          <thead>
            <tr>
            	<th>&nbsp;</th>
            	<th>Name</th>
                <th>Token</th>
                <th>Blockchain</th>
                <th>Price of Sale</th>
                <th>Sale Date</th>
                <th>&nbsp;</th>
            </tr>
           </thead>
           @if(count($allDropManagement))
           <tbody>
             @foreach($allDropManagement as $dropManagement)
              <tr>
                  <td><img src="{{URL::asset('uploads/' . @$dropManagement->logo) }}" class="rounded-pill" width="34" height="34" alt="" /></td>
                  <td>{{@$dropManagement->name}}</td>
                  <td>{{@$dropManagement->token}}</td>
                  <td><strong>{{@$dropManagement->blockChain}}</strong></td>
                  <td>{{@$dropManagement->priceOfSale}}</td>
                  <td>{{@$dropManagement->saleDate}}</td>
                  <td><a href="{{@$dropManagement->twitterLink}}" target="_blank"><i class="fa fa-twitter mr-3"></i> <a href="{{@$dropManagement->discordLink}}" target="_blank"><i class="fa fa-github-alt" aria-hidden="true"></i></a></td>
              </tr>
            @endforeach
           </tbody>
           @else
          <h2>No Data Found For This Category..</h2>  
          @endif
        </table>
        </div> {{-- end div of Drops --}}