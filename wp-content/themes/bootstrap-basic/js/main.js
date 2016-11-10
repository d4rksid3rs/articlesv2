/**
 * Main Javascript.
 * This file is for who want to make this theme as a new parent theme and you are ready to code your js here.
 */
(function ($, window, delay) {
    // http://jsfiddle.net/AndreasPizsa/NzvKC/
    var theTimer = 0;
    var theElement = null;
    var theLastPosition = {x: 0, y: 0};
    $('[data-toggle]')
            .closest('li')
            .on('mouseenter', function (inEvent) {
                if (theElement)
                    theElement.removeClass('open');
                window.clearTimeout(theTimer);
                theElement = $(this);

                theTimer = window.setTimeout(function () {
                    theElement.addClass('open');
                }, delay);
            })
            .on('mousemove', function (inEvent) {
                if (Math.abs(theLastPosition.x - inEvent.ScreenX) > 4 ||
                        Math.abs(theLastPosition.y - inEvent.ScreenY) > 4)
                {
                    theLastPosition.x = inEvent.ScreenX;
                    theLastPosition.y = inEvent.ScreenY;
                    return;
                }

                if (theElement.hasClass('open'))
                    return;
                window.clearTimeout(theTimer);
                theTimer = window.setTimeout(function () {
                    theElement.addClass('open');
                }, delay);
            })
            .on('mouseleave', function (inEvent) {
                window.clearTimeout(theTimer);
                theElement = $(this);
                theTimer = window.setTimeout(function () {
                    theElement.removeClass('open');
                }, delay);
            });
})(jQuery, window, 200); // 200 is the delay in milliseconds
//$('ul.nav li.dropdown').hover(function() {
//  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
//}, function() {
//  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
//});
$('.dropdown-toggle').click(function () {
    var location = $(this).attr('href');
    window.location.href = location;
    return false;
});

function time() {
    var today = new Date();
    var weekday = new Array(7);
    weekday[0] = "Chủ Nhật";
    weekday[1] = "Thứ Hai";
    weekday[2] = "Thứ Ba";
    weekday[3] = "Thứ Tư";
    weekday[4] = "Thứ Năm";
    weekday[5] = "Thứ Sáu";
    weekday[6] = "Thứ Bảy";
    var day = weekday[today.getDay()];
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    nowTime = h + ":" + m + ":" + s;
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = day + ', ' + 'Ngày ' + dd + ' Tháng ' + mm + ' Năm ' + yyyy;

    tmp = '<span class="date">' + today + ' | ' + nowTime + '</span>';
    var time = document.getElementById("clock");
    time.innerHTML = tmp;

    clocktime = setTimeout("time()", "1000", "JavaScript");    
}

function checkTime(i)
    {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }