$(document).ready(function(){
    "use strict";
    var pathname, arrayPathname, pathCount, pathToAjax, i;
    pathname = $(location).attr('pathname');
    pathname = pathname.replace(/^\//, '');
    arrayPathname = pathname.split('/');
    pathCount = arrayPathname.length;
    pathToAjax = "";
    if (pathCount === 0) {
        pathToAjax = "index.php?url=switchLanguage";
    } else {
        for (i = 0; i < pathCount; i = i + 1) {
            pathToAjax = pathToAjax + "../";
        }
        pathToAjax = pathToAjax + "index.php?url=switchLanguage";
    }
    $(document).on('click', '.language', function() {
        "use strict";
        var language = $(this).html().toLowerCase();
        $.post(pathToAjax, {language: language}, function (data) {
            if (data === "true") {
                window.location.replace($(location).attr('href'));
            }
        });
    });
});