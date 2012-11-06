/**
 * Contains the asi numbers that will be imported int HiProd
 * 
 * @var object
 */
var vendorsToImport = {}

/**
 * Contains indiviual response data that is used for GUI purposes.
 * 
 * @var object
 */
var responseRecords = {}


$.fn.modalInsert = function(){
        
    console.log("modalInsert");
        
    // Html to be applied to the modal popup
    var _html = '';
                   
    // Append html to the table
    $(this).find('tbody').find('tr').remove();
           
   // Only create rows if needed
    if( Object.keys(vendorsToImport).length >= 1 )
    {
        // Start looping
        for( key in responseRecords )
        {       
            // Generate html code to append to the table
            _html +=
                '<tr>' +
                    '<td>' + 
                        '<p>' + 
                            '<strong>' + responseRecords[key].name + '</strong><br/>' + 
                            'AsiNumber: ' + responseRecords[key].number + '</strong><br/>' + 
                        '</p>' +
                    '</td>' + 
                    '<td>' + 
                        '<button class="btn btn-danger removeRecord" asi_number="' + responseRecords[key].number + '">Remove</button>' + 
                    '</td>' +
                '</tr>';
        }

        // Append html to the table
        $(this).find('tbody').append(_html);
    }
}

/**
 * Moniter if/when the vendorsToImport object changes.
 */
$(window).delegate(vendorsToImport, 'change', function(event){
    
    // Log FireBug Message
    console.log('vendorsToImport changed');
    
    // Update the displayed select record count
    $('.selectedCount').html( Object.keys(vendorsToImport).length );
    
    // Update Modal Window
    $('#previewTable').modalInsert();
});

/**
 * User attempt to search for asi supplier/vendor record.
 */
$('form#search').on('submit', function(event){
    
    // Prevent default form submissions
    event.preventDefault();
    
    // The container where the results data will be outputted to
    var _container = $('#resultsContainer');
    
    // The html that will be applied to the container
    var _html = '';
    
    // The search input
    var _input = $.trim( $(this).closest('form').find('.searchInput').val() );
    
    // Prepare our query string
    var queryString = {
        'q'   : 'asi:' + _input,
        'rpp' : 40
    }
    
    // Request data form the api
    $.getJSON(asiURL + 'supplier/search', queryString, function(response){
        
        // Remove existing rows from the table.
        _container.find('table').find('tbody').find('tr').remove();
        
        // Capture the results data
        var data = response.Results;
        
        // Start looping
        for( var i = 0; i <= data.length - 1; i++ )
        {
            responseRecords[data[i].AsiNumber] = {
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
        
    });
    
});


/**
 * Add/remove vendor 
 */
$('html').delegate('.vendorImports', 'change', function(event){
    
    // Capture the asi number attribute from the html element
    var _asi_number = parseInt( $(this).attr('asi_number') );

    // Is the checkbox checked?
    switch( $(this).is(':checked') )
    {
        // Checked
        case true:
            
            // Add to the vendor import array
            vendorsToImport[_asi_number] = responseRecords[_asi_number].id;
            
        break;
        // Not Checked
        case false:
            
            // Remove from the vendor import array
            delete vendorsToImport[_asi_number];
            
            // Cleanup the remaining array data
            $.grep(vendorsToImport);
            
        break;
    }    
});

$('html').delegate('.importSelected', 'click', function(event){
    
    // Prevent Default Click Event
    event.preventDefault();
    
    //console.log('.importSelected as clicked');
    
});


$('html').delegate('.viewSelected', 'click', function(event){
    
    // Prevent Default Click Event
    event.preventDefault();
    
    //console.log('.viewSelected as clicked');
    
});

$('#previewTable').click('.removeRecord', function(event){
    
    // Prevent Default Click EVent
    event.preventDefault();
    
    console.log('.removeRecord clicked');
    
    // Capture the asi number attribute from the html element
    var _asi_number = parseInt( $(this).attr('asi_number') );

    console.log('Before');
    console.log(vendorsToImport);
    console.log('Being Delete');
    // Remove from the vendor import array
    console.log( delete vendorsToImport[_asi_number] );
    console.log('End Delete');
    // Cleanup the remaining array data
    $.grep(vendorsToImport);

    console.log(vendorsToImport);

    // Update Modal Window
    $('#previewTable').modalInsert();
});