

$('html').delegate('#asi_number', 'change', function(event){
    
    // Prevent default change event
    event.preventDefault();
    
    // Capture the submitted asi number
    var __asi_number = parseInt( $(this).val() );
    
    // Prepare the query string.
    var queryString = {
        asi_number : __asi_number
    }
    
    // Log it
    //console.log('asi_number ', __asi_number);
    
    // Quickly check if asi number is valid within asi
    $.getJSON(ajaxURL + 'asi-quickcheck/' +  __asi_number, function(response){
        console.log(response);        
    });
});