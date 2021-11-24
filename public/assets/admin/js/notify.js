
let notificationsCountElm = $('.notify-count'),
    notificationsCountNumber = parseInt(notificationsCountElm.text()),
    notificationsWrapper   = $('.notification-scroll');

if (notificationsCountNumber <= 0) {
    notificationsWrapper.hide();
}

Pusher.logToConsole = true;

var pusher = new Pusher('8d0f6c8f269bd854fe16', {
    encrypted: true
});

var channel = pusher.subscribe('order-notify');


channel.bind('App\\Events\\OrderNotifyEvent', function(data) {

    notificationsWrapper.prepend(`                          <a href="${data.url}">
                                <div class="dropdown-item">
                                    <div class="media">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                        <div class="media-body">
                                            <div class="notification-para">
                                                <span class="user-name d-block">اوردر جديد</span>
                                                <span class="d-block mb-2"> يحتوي علي ${data['count']} منتج </span>
                                                <span class="d-block mt-2 text-danger">التاريخ: ${data.date}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>`)

    console.log(data.order)
    notificationsCountNumber++;
    notificationsCountElm.html(notificationsCountNumber);

    notificationsWrapper.show();
});


$('.btn-remove-notify').on('click' , function (e){

    e.preventDefault();

    $.ajax({
        method:'post',
        url:$(this).attr('href')
    })

    $(this).parents('.dropdown-item').remove();

    notificationsCountNumber--;
    notificationsCountElm.html(notificationsCountNumber);


});
