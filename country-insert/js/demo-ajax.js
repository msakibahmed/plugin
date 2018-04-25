
//For Responsive table//
var headertext = [],
headers = document.querySelectorAll("#miyazaki th"),
tablerows = document.querySelectorAll("#miyazaki th"),
tablebody = document.querySelector("#miyazaki tbody");

for(var i = 0; i < headers.length; i++) {
  var current = headers[i];
  headertext.push(current.textContent.replace(/\r?\n|\r/,""));
} 
for (var i = 0, row; row = tablebody.rows[i]; i++) {
  for (var j = 0, col; col = row.cells[j]; j++) {
    col.setAttribute("data-th", headertext[j]);
  } 
}	
//Responsive table end//


			

		
		
		
		
jQuery('#ajax_form').submit(ajaxUpload);   

function ajaxUpload()
{    
 var submitform = jQuery(this).serialize();    

 jQuery.ajax({  
  type:"POST",  
  url: "/mywp/wp-admin/admin-ajax.php?action=cruddata",  
  data: submitform,  
  
  success:function(data){  
   alert ('Data Successfully Inserted');
   //location.reload();
   
  },

  error: function(errorThrown){
   alert(errorThrown);
  }  
 });

 jQuery("#ImageBrowse").on("change", function() {
        jQuery("#ajax_form").submit();
    });

 return false;  
}

/*jQuery(document).ready(function($) {
    $("#ajax_form").submit(function () {
        var filename = $("#file").val();

        $.ajax({
            type: "POST",
            url: "/mywp/wp-admin/admin-ajax.php?action=cruddata",	
            enctype: 'multipart/form-data',
            data: {
                file: filename
            },
            success: function () {
                alert("Data Uploaded: ");
            }
        });
    });
});*/