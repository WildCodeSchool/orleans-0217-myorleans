var header = document.querySelector("#siteWrapper header");

function scrolled(){
    var windowHeight = document.body.clientHeight,
        currentScroll = document.body.scrollTop || document.documentElement.scrollTop;

    header.className = (currentScroll >= windowHeight - header.offsetHeight) ? "fixed" : "";
}

addEventListener("scroll", scrolled, false);