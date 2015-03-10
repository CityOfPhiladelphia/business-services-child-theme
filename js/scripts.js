jQuery(document).ready(function($) {

  //alphabetize business page layouts
  var container = $("#must-have");
  container.find("div").sort(function (a, b) {
     var classA = $(a).attr("class");
     var classB = $(b).attr("class");
     if (classA > classB) return 1;
     if (classA < classB) return -1;
     return 0;
  }).appendTo(container);

  /*CONTENT TYPE SORTER*/
  //get the content from the page
  var div = document.getElementById("dom-target");
  var text_data = div.textContent;
  var content_types = text_data.split(" ");

                                      //stop at last (empty) space
  for (i = 0; i < content_types.length - 1; i++) {
    var content = "." + content_types[i];
    //wrap similar content type classes together for styling
    $(content).wrapAll( "<div class='" + content_types[i] + "-wrapper" + "' />");
  }
});
