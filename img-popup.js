// https://codepen.io/Muhnad/pen/dMbXNb
$(function () {
    "use strict";
    
    $("img.popup").click(function () {
        //get the location of the image to be popped up
        var $src = $(this).attr("src");
        $(".show").fadeIn();

        //locate the img element to load into
        var $img = $(".img-show img");

        //remove the last 4 chars, in case this is a thumbnail (blahblah.png.jpg)
        $img.attr("src", $src.slice(0, -4));

        //set the backup url in case this is not a thumbnail (blahblah.png)
        $img.off("error"); $img.on("error", function(){this.src=$src});
    });
    
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });
    
});