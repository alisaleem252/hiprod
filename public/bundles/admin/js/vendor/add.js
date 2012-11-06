/**
 * Contains global values or elements throughout the page.
 * 
 * @var object
 */
var globals = {
    vendorsToImport : {
        
    },
    responseRecords : {
        
    },
    
    // Containers
    containers : {
        results : $('#resultsContainer')
    },
    
    // Forms
    forms : {
        search : $('#search')
    }
}

// Austomatically focus on the search form when the page loads.
$('.searchInput').focus();

$(window).bind('beforeunload', function() {
    
    if( Object.keys(window.globals.vendorsToImport).length >= 1 )
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


$('html').delegate('.vendorImports', 'change', function(event){
    
    // Make button blink to draw the users attention.
    $('.selectedCount').closest('button').fadeTo(100,.5).delay(100).fadeTo(100,1);
    
    // See if the element is checked.
    var _checked    = $(this).is(':checked');
    
    // Get the asi number from the html element
    var _asi_number = parseInt( $(this).attr('asi_number') );
    
    // Element is checked
    if( _checked )
    {
        if( globals.vendorsToImport[_asi_number] === undefined )
        {            
            // Append to the array
            globals.vendorsToImport[_asi_number] = _asi_number;
        }  
    }
    
    // Non or un-checked element.
    else
    {
        if( globals.vendorsToImport[_asi_number] !== undefined )
        {            
            // Remove from the array
            delete globals.vendorsToImport[_asi_number];
        }
    }    
});


$(window).delegate(globals.vendorsToImport, 'change', function(event){
    
    // Updated the selected count
    $('.selectedCount').html(Object.keys(window.globals.vendorsToImport).length);
    
    // console.log('---------------------------------');
    // console.log(window.globals.vendorsToImport);
    // console.log('---------------------------------');
    
    // Remove any existing rows from the preview table
    $('#previewTable').find('tbody tr').remove();
    
    if( Object.keys(window.globals.vendorsToImport).length >= 1 )
    {
        var _html = '';
        
        for ( key in window.globals.vendorsToImport )
        {
            _html +='<tr>' +
                        '<td>' + 
                            '<p>' + 
                                '<strong>' + window.globals.responseRecords[key].name + '</strong><br/>' + 
                                'AsiNumber: ' + window.globals.responseRecords[key].number + '</strong><br/>' + 
                            '</p>' +
                        '</td>' + 
                        '<td>' +
                            '<button asi_number="'+ window.globals.responseRecords[key].number + '" class="removeRecord btn btn-danger">Remove Record</button>' +
                        '</td>'+
                    '</tr>';
                
            //console.log( window.globals.responseRecords[key] );
        }
        
        // Append the html to the table.
        $('#previewTable').find('tbody').append(_html);
    }
    
    //console.log('---------------------------------');
});


$('html').delegate('.removeRecord', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
    
    var __asi_number = parseInt( $(this).attr('asi_number') );
    
    // Uncheck the box if applicable.
    $('.vendorImports[asi_number="'+__asi_number+'"]').click();
    
    delete window.globals.vendorsToImport[__asi_number];
    
    $.grep(window.globals.vendorsToImport);
    
    $(window).change();
});

/**
 * User submitted vendor search.
 */
$('html').delegate(globals.forms.search, 'submit', function(event){
    
    // Prevent Default Form Submission
    event.preventDefault();

    // The container where the results data will be outputted to
    var _container = globals.containers.results;
    
    // The html that will be applied to the container
    var _html = '';
    
    // The search input
    var _input = $.trim( $(this).find('.searchInput').val() );
    
    // Prepare our query string
    var queryString = {
        'q'   : 'asi:' + _input,
        'rpp' : 40
    }
    
    // Loading indicator
    var loadingIndicator = $('#loadingIndicator');
    
    // Show the loading indicator
    loadingIndicator.show();
    
    // Request data form the api
    $.getJSON(asiURL + 'supplier/search', queryString, function(response){
        
        // Remove existing rows from the table.
        _container.find('table').find('tbody').find('tr').remove();
        
        // Capture the results data
        var data = response.Results;
        
        // Start looping
        for( var i = 0; i <= data.length - 1; i++ )
        {
            globals.responseRecords[data[i].AsiNumber] = {
                id     : data[i].Id,
                name   : data[i].Name,
                number : data[i].AsiNumber
            }
            
            // Generate html code to append to the table
            _html +=
                '<tr>' +
                    '<td>' + 
                        '<input asi_number="' + data[i].AsiNumber + '" class="vendorImports" name="vendorImports[]" type="checkbox"/>' + 
                    '</td>' + 
                    '<td>' + 
                        '<p>' + 
                            '<strong>' + data[i].Name + '</strong><br/>' + 
                            'AsiNumber: ' + data[i].AsiNumber + '</strong><br/>' + 
                        '</p>' +
                    '</td>' + 
                '</tr>';
        }
        
        // Append to the table.
        _container.find('table').find('tbody').append(_html);
        
        // Show the loading indicator
        loadingIndicator.hide();
    });
    
    // console.log('search submit')    
});


$('html').delegate('.importSelected', 'click', function(event){
    
    // Prevent default click event
    event.preventDefault();
    
    var postData = {};

    // Generate data to be sent during postback.
    for ( key in window.globals.vendorsToImport )
    {
        postData[key] = globals.responseRecords[key];
    }
    
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
    
    //console.log(postData);
    
    // Postback
    $.post(adminAjaxUrl + 'import-vendors', {'data'  : postData}, function(response){

        var insertCount = parseInt(response);

        //console.log('insertCount %d', insertCount);

        // Generate data to be sent during postback.
        for ( key in window.globals.vendorsToImport )
        {
            // Reset vendors to import array
            delete window.globals.vendorsToImport[key];

            // Trigger windows change.
            $(window).change();

            // Clear out the search input
            globals.forms.search.find('.searchInput').val()

            // Clear out the results table.
            //globals.containers.results.find('table').find('tbody').find('tr').remove();
            $('.vendorImports[asi_number='+key+']').click();
        }

        // Show the importing indicator
        importingIndicator.hide();

        // Show the import complete alert
        importAlert.show();

    }, 'json');
   
});