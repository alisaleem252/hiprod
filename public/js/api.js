// Get the site url (https compatible)
var siteURL = "https:"  == document.location.protocol
            ? "https://" + document.location.host   + '/' 
            : "http://"  + document.location.host   + '/';
           
// Set the ajax url
var ajaxURL = siteURL + 'ajax/';

// Set the ASI url
var asiURL  = siteURL + 'asi/';

// Set the ASI Central API url.
var asiApiURL = 'http://api.asicentral.com/v1/';

/*******************************************************************************
 :: Cancel unfinished ajax requests
 ******************************************************************************/

$.ajaxQ = (function(){
  var id = 0, Q = {};

  $(document).ajaxSend(function(e, jqx){
    jqx._id = ++id;
    Q[jqx._id] = jqx;
  });
  $(document).ajaxComplete(function(e, jqx){
    delete Q[jqx._id];
  });

  return {
    abortAll: function(){
      var r = [];
      $.each(Q, function(i, jqx){
        r.push(jqx._id);
        jqx.abort();
      });
      return r;
    }
  };

})();

/*******************************************************************************
 :: AutoComplete Disablement
 ******************************************************************************/
$( 'input' ).filter( ':text' ).attr( 'autocomplete', 'off' );

/*******************************************************************************
 :: Check for exact match against <body id="{criteria}" class="{criteria}">
 ******************************************************************************/
function bodyMatch( bodyId, bodyClass )
{
    var _bodyId    = $('body').attr('id');
    var _bodyClass = $('body').attr('class');
    
    return ((bodyId === bodyId) && (bodyClass === bodyClass));
}


