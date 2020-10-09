// https://codepen.io/Muhnad/pen/dMbXNb
$(function () {
    "use strict";

    function hide() {
        $(".show").fadeOut(function() {
            var $img = $(".img-show img");
            $img.off("error");
            $img.attr("src", "");
        });
    }
    
    $("img.popup").click(function () {
        //get the location of the image to be popped up
        var $src = $(this).attr("src");
        $(".show").fadeIn();

        //locate the img element to load into
        var $img = $(".img-show img");

        //remove the last 4 chars, in case this is a thumbnail (blahblah.png.jpg)
        var $original = $src.slice(0, -4);
        //also remove "/thumbs/" from the beginning and add "/f/"
        $original = "/f/" + $original.slice(8);

        //try to get the original
        $img.attr("src", $original);

        //set the backup url in case this is not a thumbnail (blahblah.png)
        $img.off("error"); $img.on("error", function(){this.src=$src});
    });
    
    $("span, .overlay").click(function () {
        hide();
    });
    
    $(document).keyup(function(e) {
        //ESC key closes the image popup
        if (e.keyCode === 27) hide();
      });
});
