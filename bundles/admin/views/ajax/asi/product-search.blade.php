<?php $lastPage = ceil( ($response->ResultsTotal / $response->ResultsPerPage) );?>

<h5>Search Results</h5>

<ul class="pager" style="background:#eee;margin:0;padding:5px">
    @if($response->Page !== 1)
        <li class="previous">
            <a class="prevPage" href="#">&larr; Previous</a>
        </li>
    @endif
    @if($lastPage !== $response->Page )
        <li class="next">
            <a class="nextPage" href="#">Next &rarr;</a>
        </li>
    @endif
</ul>

<table id="ajaxResultsTable" class="table table-bordered table-striped" style="margin-bottom:0">
    <thead>
        <tr>
            <th style="text-align:center;width:60px">Import</th>
            <th style="text-align:center;width:110px">Image</th>
            <th>Product Details</th>
        </tr>
    </thead>
    <tbody>
    @if( count($response->Results) )
        @foreach($response->Results as $result)
        <tr product_number="{{ $result->Id }}">
            <td style="text-align:center">
                <input product_number="{{ $result->Id }}" class="productImports" name="productImports[]" type="checkbox"/>
            </td>
            <td>
                <div class="productThumbnail" style="background-image:url({{ IoC::resolve('asiProductImage', array($result->ImageUrl)) }})"></div>
                <span class="recordImage" style="display:none">{{ IoC::resolve('asiProductImage', array($result->ImageUrl)) }}</span>
                <span class="recordSupplierId" style="display:none">{{ $result->Supplier->Id }}</span>
            </td>
            <td>
                <h5><span class="recordName">{{ $result->Name }}</span></h5>
                <p><span class="recordDescription">{{ $result->Description }}</span></p>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>

<ul class="pager" style="background:#eee;margin:0 0 40px 0;padding:5px">
    @if($response->Page !== 1)
        <li class="previous">
            <a class="prevPage" href="#">&larr; Previous</a>
        </li>
    @endif
    @if($lastPage !== $response->Page )
        <li class="next">
            <a class="nextPage" href="#">Next &rarr;</a>
        </li>
    @endif
</ul>

<?php // print('<pre>'); print_r($response); print('<pre>');?>
