$('#wufoo-form').on('submit', function(e) {
  
  e.preventDefault();
  
  var data = {
    action : 'wufoo_post',
    fields : $(this).serialize()
  };
  
  $.ajax({
    type     : 'POST',
    url      : '/wp-admin/admin-ajax.php',
    data     : data,
    dataType : 'json',
    success  : function(response) {

      console.log(response);

    },
    error : function(jqXHR, textStatus, errorThrown) {

      console.error(errorThrown);

    }
  });

});