jQuery(document).ready(function($) {

  if ( $( "#business-page" ).length ) {
    /*CONTENT TYPE SORTER*/
    //get the content from the page
    var div = document.getElementById("dom-target");
    var text_data = div.textContent;
    var content_types = text_data.split(" ");

                                        //stop at last (empty) space
    for (i = 0; i < content_types.length - 1; i++) {
      var content = "." + content_types[i];
      //wrap similar content type classes together for styling
        $("#must-have " +  content).wrapAll( "<div class='" + content_types[i] + "-wrapper" + "' />");
        $("#might-need " + content).wrapAll( "<div class='" + content_types[i] + "-wrapper" + "' />");

    }
  }

  $(".home .gdlr-box-with-icon-item").click(function() {
    window.location = $('this').find("a").attr("href");
    //return false;
  });
});
