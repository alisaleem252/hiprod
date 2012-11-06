/**
 * Contains global values or elements throughout the page.
 * 
 * @var object
 */
var globals = {
    productsToImport : {},
    responseRecords  : {},
    
    // Containers
    containers : {
        results : $('#resultsContainer')
    },
    
    // Forms
    forms : {
        search : $('#search')
    },
    
    // Tables
    tables : {
        ajaxResultsTable : $('#ajaxResultsTable')
    }
}

/**
 * Capture the current unix timestamp
 */
function timestamp(){
    return Math.round((new Date()).getTime() / 1000);
}


/*******************************************************************************
 * Austomatically focus on the search form when the page loads.
 ******************************************************************************/
$('.searchInput').focus();

/*******************************************************************************
 * Ine the event that the user attempt to leave the page before actually
 * importing the records they selected, alert them with a confirmation box.
 ******************************************************************************/
$(window).bind('beforeunload', function() {
    
    if( Object.keys(window.globals.productsToImport).length >= 1 )
    {
        if(/Firefox[\/\s](\d+)/.test(navigator.userAgent) && new Number(RegExp.$1) >= 4) {
            if(confirm("Are you sure do you want to leave? You have not imported the items you've selected.")) {
                history.go();
            } else {
                window.setTimeout(function() {
                    window.stop();
                }, 1);
            }
        } else {
            return "Are you sure do you want to leave? You have not imported the items you've selected.";
        }
    }
});


$(window).delegate(globals.productsToImport, 'change', function(event){
    
    // Updated the selected count
    $('.selectedCount').html(Object.keys(window.globals.productsToImport).length);
    
    // console.log('---------------------------------');
    // console.log(window.globals.vendorsToImport);
    // console.log('---------------------------------');
    
    // Remove any existing rows from the preview table
    $('#previewTable').find('tbody tr').remove();
    
    if( Object.keys(window.globals.productsToImport).length >= 1 )
    {
        var _html = '';
        
        for ( key in window.globals.productsToImport )
        {
            _html +='<tr>' +
                        '<td>' + 
                            '<div style="background-image:url(' + window.globals.responseRecords[key].image + ')" class="productThumbnail"></div>' + 
                            '<p><strong>' + window.globals.responseRecords[key].name + '</strong></p>' + 
                            '<p>' + window.globals.responseRecords[key].description + '</p>' + 
                        '</td>' + 
                        '<td>' +
                            '<button product_number="'+ window.globals.responseRecords[key].id + '" class="removeRecord btn btn-danger">Remove Record</button>' +
                        '</td>'+
                    '</tr>';
                
            //console.log( window.globals.responseRecords[key] );
        }
        
        // Append the html to the table.
        $('#previewTable').find('tbody').append(_html);
    }
    
    //console.log('---------------------------------');
});

/*******************************************************************************
 * User submits search
 ******************************************************************************/
$('html').delegate(globals.forms.search, 'submit', function(event){

    // Prevent default form submission.
    event.preventDefault();
    
    // The container where the results data will be outputted to
    var _container = globals.containers.results;
    
    // Capture the search input
    var __searchInput   = $.trim( $(this).find('.searchInput').val() );
    
    // Capture the search page
    var __searchPage   = $.trim( $(this).find('.page').val() );
    
    // Capture the selected asi number
    var __asiNumber     = $(this).find('.selectAsiNumber').val();
    
    // If the user has entered a search criteria, then add a trailing space.
    // Without the trailing space, search results may be greatly reduced.
    if( __searchInput.length >= 1 ) __searchInput+= ' ';
    
    //console.log('length ', __searchInput.length);    
    //console.log('__searchInput = %s', __searchInput);
    //console.log('__asiNumber = %d'  , __asiNumber);
    
    // Prepare our query string
    var queryString = {
        'q'   : __searchInput + 'asi:' + __asiNumber,
        'page': __searchPage,
        'rpp' : 40
    }
    
    // Loading indicator
    var loadingIndicator = $('#loadingIndicator');
    
    // Show the loading indicator
    loadingIndicator.show();
    
    // ?ts=' + timestamp()
    
    // Load the html from ajax
    $('#resultsContainer').load(adminAjaxUrl + 'asi-product-search', queryString, function(response){
                
        //console.log('productsToImport');
        //console.log(globals.productsToImport);
        
        // Scroll back to the top
        $('html').animate({scrollTop:360});
        
        for(key in globals.productsToImport){
            $('.productImports[product_number=' + key + ']').attr('checked', 'checked');
        }
        
        // Hide the loading indicator
        loadingIndicator.hide();
        
        //console.log('Rcord data..');
        //console.log(globals.responseRecords);
    });
});


$('html').delegate('.productImports', 'change', function(event){
    
    // Make button blink to draw the users attention.
    $('.selectedCount').closest('li').fadeTo(100,.5).delay(100).fadeTo(100,1);
    
    // See if the element is checked.
    var _checked    = $(this).is(':checked');
    
    // Get the product number from the html element
    var _product_number = parseInt( $(this).attr('product_number') );
    
    // Element is checked
    if( _checked )
    {
        if( globals.productsToImport[_product_number] === undefined )
        {            
            // Append to the array
            globals.productsToImport[_product_number] = _product_number;
            
            $('#ajaxResultsTable')
            
            globals.tables.ajaxResultsTable = $('#ajaxResultsTable');
            
            // Capture the associate record data (used in modal table)
            globals.responseRecords[_product_number] = {
                id          : _product_number,
                image       : globals.tables.ajaxResultsTable.find('tr[product_number=' + _product_number + ']').find('.recordImage').text(),
                name        : globals.tables.ajaxResultsTable.find('tr[product_number=' + _product_number + ']').find('.recordName').text(),
                description : globals.tables.ajaxResultsTable.find('tr[product_number=' + _product_number + ']').find('.recordDescription').text(),
                supplier_id : globals.tables.ajaxResultsTable.find('tr[product_number=' + _product_number + ']').find('.recordSupplierId').text()
            }
            
            //console.log(globals.responseRecords);
        }  
    }
    
    // Non or un-checked element.
    else
    {
        if( globals.productsToImport[_product_number] !== undefined )
        {            
            // Remove from the array
            delete globals.productsToImport[_product_number];
            
            // Revmove the response record array
            delete globals.responseRecords[_product_number];
        }
    }
    
});


$('html').delegate('.prevPage', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
    
    // Capture the form html element
    var _form = globals.forms.search;

    // Capture the current page number
    var _pageNumber = parseInt( _form.find('.page').val() );
    
    // Increment to the next page
    var _decremented = _pageNumber -1;
    
    // Now increment the page value
    _form.find('.page').val( _decremented );
    
    // Submit search again
    _form.submit();
});


$('html').delegate('.nextPage', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
    
    // Capture the form html element
    var _form = globals.forms.search;

    // Capture the current page number
    var _pageNumber = parseInt( _form.find('.page').val() );
    
    // Increment to the next page
    var _incremented = _pageNumber + 1;
    
    // Now increment the page value
    _form.find('.page').val( _incremented );
    
    // Submit search again
    _form.submit();
});



$('html').delegate('.removeRecord', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
    
    var __product_number = parseInt( $(this).attr('product_number') );
    
    // Uncheck the box if applicable.
    $('.productImports[product_number="'+__product_number+'"]').click();
    
    delete window.globals.productsToImport[__product_number];
    
    $.grep(window.globals.productsToImport);
    
    $(window).change();
});


$('html').delegate('.importSelected', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
        
    var postData = {};

    // Generate data to be sent during postback.
    for ( key in window.globals.productsToImport )
    {
        postData[key] = globals.responseRecords[key];
    }
    
    //console.log(postData);
    
    // Loading indicator
    var importingIndicator = $('#importingIndicator');
    
    // Alert indicator
    var importAlert = $('#importAlert');
    
    // Scroll back to the top
    $('html').animate({scrollTop:0});
    
    // Show the importing indicator
    importingIndicator.show();
    
    // Hide the import alert message
    importAlert.hide();
    
    // Postback
    $.post(adminAjaxUrl + 'import-products', {'data'  : postData}, function(response){

        // Capture the number of records returned.
        var insertCount = parseInt(response);

        //console.log('insertCount %d', insertCount);

        // Generate data to be sent during postback.
        for ( key in window.globals.productsToImport )
        {
            // Reset vendors to import array
            delete window.globals.productsToImport[key];

            // Trigger windows change.
            $(window).change();

            // Clear out the search input
            globals.forms.search.find('.searchInput').val('');

            // Clear out the results table.
            //globals.containers.results.find('table').find('tbody').find('tr').remove();
            $('.productImports[product_number='+key+']').click();
        }

        // Show the importing indicator
        importingIndicator.hide();
        
        // Show the import complete alert
        importAlert.show();

    }, 'json');
   
});