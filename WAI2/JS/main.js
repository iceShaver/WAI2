

//function setColorCSS(color) {
//    var colorLink = document.getElementById('colorcss');
//    localStorage.color = color;
//    if (colorLink != null) {
//        colorLink.parentNode.removeChild(colorLink);
//    }
//    if (color != "default")  {
//        var colorlink = document.createElement("link");
//        colorlink.setAttribute("rel", "stylesheet");
//        colorlink.setAttribute("type", "text/css");
//        colorlink.setAttribute("href", "css/color-" + color + ".css");
//        colorlink.setAttribute("id", "colorcss");

//        document.getElementsByTagName("head").item(0).appendChild(colorlink);
//    }
//}
//function addPageToHistory() {
//    if (sessionStorage.historyCount <= 10)
//        sessionStorage.setItem("historyPage" + sessionStorage.historyCount, document.title);
//    else {
//        for (var i = 0; i < sessionStorage.historyCount - 1; i++) {
//            sessionStorage["historyPage" + i] = sessionStorage["historyPage" + (i + 1)];
//        }
//        sessionStorage.removeItem("historyPage" + (sessionStorage.historyCount - 1));
//        sessionStorage.historyCount--;
//        sessionStorage.setItem("historyPage" + sessionStorage.historyCount, document.title);

//    }
//}

//document.addEventListener("DOMContentLoaded", function () {
//    //if (sessionStorage.historyCount == null) {
//    //    sessionStorage.historyCount = 0;
//    //} else
//    //    sessionStorage.historyCount++;  
//    //addPageToHistory();
//    //getHistory();
//	if(localStorage.color != null)
//    setColorCSS(localStorage.color);

//});


//function getHistory() {
//    var pages = document.createDocumentFragment();
//    for (var i = sessionStorage.historyCount; i > 0; i--) {
//        var p = document.createElement('p');
//        p.appendChild(document.createTextNode(sessionStorage.getItem("historyPage" + i)));
//        pages.appendChild(p);
//    }

//    var col1 = document.getElementById("col1-content");
//    col1.appendChild(pages);
//}

$(document).ready(function () {
    //$(".sortable").sortable();
    //$(".sortable").disableSelection();
    //$(".picture").draggable();
    var navY = $('nav').offset().top;
    var stickyNav = function () {
        var scrollY = $(window).scrollTop();

        if (scrollY > navY) {
            $('nav').addClass('nav-docked');
            $('.container').addClass('container-nav-docked');
        }
        else {
            $('nav').removeClass('nav-docked');
            $('.container').removeClass('container-nav-docked');
        }

    };


    stickyNav();

    $(window).scroll(function () {
        stickyNav();
    });
});