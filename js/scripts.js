jQuery(document).ready(function($) {

  $('.business-flag:empty').hide();

  var seen = {};
 /*hide duplicate elements on our "parent" biz type page */
  $( '.parent #might-need .inner .document-row' ).each(function() {

    var txt = $(this).text();
    if (seen[txt])
        $(this).remove();
    else
        seen[txt] = true;
});


  /*
  if ( $( "#business-page" ).length ) {
    /*CONTENT TYPE SORTER*/
    //get the content from the page
    /*
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
  */

  // Open in new window
  $(".home #plan").click(function () {
    window.location = $(this).find("a:first").attr("href");
    return false;
  });
  $(".home #maintain").click(function () {
    window.location = $(this).find("a:first").attr("href");
    return false;
  });
  $(".home #launch").click(function () {
    window.location = $(this).find("a:first").attr("href");
    return false;
  });
  $(".home #close").click(function () {
    window.location = $(this).find("a:first").attr("href");
    return false;
  });

});
