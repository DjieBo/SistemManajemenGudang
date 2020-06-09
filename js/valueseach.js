function fill(Value) {
	  $('#search').val(Value);
	  $('#display').hide();
	}
	$(document).ready(function() {
	  	$("#searching").keyup(function() {

	  var product = $('#searching').val();
	    if (product == "") {
	      $("#listProduk").html("");
	    }else {
	      $.ajax({
	        type: "POST",
	        url: "config/search.php",
	        data: {search: product},
	        success: function(html) {
	        $("#listProduk").html(html).show();
	        }
	      });
	    }

	  });
	});