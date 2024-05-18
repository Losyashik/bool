$(`.topbar__burger, .topbar_ul__item`).click(() => {
    if (window.innerWidth < 1024) {
        $(`.topbar_ul`).toggleClass(`topbar_ul--active`);
        if ($(`.topbar_ul`).hasClass(`topbar_ul--active`))
            $(`body`).css({
                "position": "fixed"
            });
        else
            $(`body`).css({
                "position": "static"
            });
    }
})