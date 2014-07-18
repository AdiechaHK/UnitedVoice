$(document).ready(function() {
  $("[title]").tooltip('hide');
  $("a.delete").click(function(){
    var self = this;
    if(confirm("Do you really want to delete this?")) {
      // alert($(self).attr("url"));
      window.location.href = $(self).attr("url");
    } 
    return false;
  })
})
