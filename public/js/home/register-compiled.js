$("html").delegate("#asi_number","change",function(a){a.preventDefault();a=parseInt($(this).val());$.getJSON(ajaxURL+"asi-quickcheck/"+a,function(a){console.log(a)})});
