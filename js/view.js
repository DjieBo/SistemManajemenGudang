function fill(Value) {
  $('#search').val(Value);
  $('#display').hide();
}
$(document).ready(function() {
  $("#view").keyup(function() {
  var product = $('#view').val();
    if (product == "") {
      $("#cekorder").html("");
    }else {
      $.ajax({
        type: "POST",
        url: "../config/view.php",
        data: {search: product},
        success: function(html) {
        $("#cekorder").html(html).show();
        }
      });
    }
  });
});