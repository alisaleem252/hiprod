$(window).on('resize', function(event){
       
    // Get the current width of th epage.
    var pageWidth = $(this).width(); 
    
    // Update the form class names depending on the width of the page.
    $('form').attr('class', (pageWidth <= 963) ? 'well' : 'well form-horizontal');  
});

// Trigger resize event on page load.
$(window).resize();