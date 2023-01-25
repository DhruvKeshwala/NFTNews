@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Contacts</h3>
        </div>
        {{-- <div class="col-md-6 text-right">
            <a href="{{ route('add_author') }}" class="btn btn-info">Add Author</a>
        </div> --}}
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $data->appends(Request::except('page'))->links('vendor.pagination.custom') }}
        <br>
        {{-- <table class="webforms sttbl bg-light my-0 table-responsive-sm">
          <tbody><tr>
            <form action="{{ route('filter_author') }}" method="get">
                <td class="pr-0"><input type="text" name="filterAuthorName" size="45" value="<?php 
                if (!empty($_GET['filterAuthorName'])) {
                    $q = $_GET['filterAuthorName'];
                    echo $q;
                } ?>" placeholder="Name"></td>
                <td class="pr-0"><input type="text" name="filterEmail" size="45" placeholder="Email" value="<?php 
                if (!empty($_GET['filterEmail'])) {
                    $q = $_GET['filterEmail'];
                    echo $q;
                } ?>"></td>
                <td class="pr-0"><input type="text" name="filterMobile" size="10" placeholder="Mobile" value="<?php 
                if (!empty($_GET['filterMobile'])) {
                    $q = $_GET['filterMobile'];
                    echo $q;
                } ?>"></td>
                <td>
                    <input type="submit" name="submit" value="Go" class="btn btn-dark py-1 px-2 text-white">
                    <a href="{{ route('author')}}"  class="btn btn-danger py-1 px-2 text-white">Reset</a>
                </td>
            </form>
                {{-- <td class="pr-0"><input type="number" size="" placeholder="Meta Description"></td>
           <td class="pr-0"><select>
           	<option>Select</option>
            <option>Option 1</option>
            <option>Option 2</option>
            <option>Option 3</option>
           </select></td> --}}
           {{-- <td>
           	<a onclick="filterCategory()" class="btn btn-dark py-1 px-2 text-white"><span class="fa fa-search fa-lg"></span></a>
           </td> --}}
          {{-- </tr>
         </tbody></table> --}}
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="11%">Name</th>
                    <th width="15%">Email</th>
                    <th width="8%">Phone</th>
                    <th width="10%">Organisation</th>
                    <th width="15%">Location</th>
                    <th width="13%">Project</th>
                    <th width="8%">Enquiry Nature</th>
                    <th width="18%">Message</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data)<=0)
                <tr>
                    <td colspan="8" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($data as $row)
                <tr>
                    <td>{{@$loop->index + 1}}</td>
                    <td>@if($row->name != null || $row->name != '') {{@$row->name}} @else <span>—</span> @endif</td>
                    <td>{{@$row->email}}</td>
                    <td>@if(@$row->phone != null || @$row->phone != '') {{@$row->phone}} @else <span>—</span> @endif</td>
                    <td>@if(@$row->org != null || @$row->org != '') {{@$row->org}} @else <span>—</span> @endif</td>
                    <td>@if(@$row->loc != null || @$row->loc != '') {{@$row->loc}} @else <span>—</span> @endif</td>
                    <td>@if(@$row->nmeproj != null || @$row->nmeproj != '') {{@$row->nmeproj}} @else <span>—</span> @endif</td>
                    <td>@if(@$row->enquire_nature != null || @$row->enquire_nature != '') {{@$row->enquire_nature}} @else <span>—</span> @endif</td>
                    <td>@if(@$row->message != null || @$row->message != '') {{@$row->message}} @else <span>—</span> @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $data->appends(Request::except('page'))->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')