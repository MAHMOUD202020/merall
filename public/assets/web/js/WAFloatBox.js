jQuery.fn.extend({WAFloatBox:function(){var a=$(this)
        a.prepend(`
        <div class="myk-btn">
            <img src="../assets/web/images/WAFloatBox/communicate.svg" class="myk-wa-icon" width="40">
        </div>
        <div class="myk-panel"></div>
        `)
        var b=$(".myk-panel")
        b.append(`
        <div class="myk-panelhead">
            <span class="myk-close">x</span>
                <img src="../assets/web/images/WAFloatBox/wa-icon.png" class="myk-wa-icon" width="30px">
            <h2 class="myk-paneltitle">تواصلي معنا</h2>
        </div>
        <div class="myk-panelbody"></div>
        `)
        $('.myk-item').each(function(){if($(this).data('type')=="whatsapp"){$('.myk-panelbody').append(`
                <a target='_blank' href="https://wa.me/${$(this).data('wanumber')}?text=${$(this).data('message')}" class="myk-list ${$(this).data('class')}">
                    <img src="${$(this).data('waava')}" class="myk-ava">
                    <div class="myk-number">
                        <p class="myk-who"><b>${$(this).data('wadivision')}</b></p>
                        <p class="myk-name">${$(this).data('waname')}</p>
                    </div>
                </a>
                `)}else if($(this).data('type')=="phone"){$('.myk-panelbody').append(`
                <a target='' href="tel:${$(this).data('wanumber')}" class="myk-list ${$(this).data('class')}">
                    <img src="${$(this).data('waava')}" class="myk-ava">
                    <div class="myk-number">
                        <p class="myk-who"><b>${$(this).data('wadivision')}</b></p>
                        <p class="myk-name">${$(this).data('waname')}</p>
                    </div>
                </a>
                `)}else{$('.myk-panelbody').append(`
                <a target='' href="${$(this).data('link')}" class="myk-list ${$(this).data('class')}">
                    <img src="${$(this).data('waava')}" class="myk-ava">
                    <div class="myk-number">
                        <p class="myk-who"><b>${$(this).data('wadivision')}</b></p>
                        <p class="myk-name">${$(this).data('waname')}</p>
                    </div>
                </a>
                `)}});$(".myk-btn").click(function(){$(".myk-panel").toggleClass("myk-show")});$(".myk-close").click(function(){$(".myk-panel").toggleClass("myk-show")})}})

$(".myk-wa").WAFloatBox();

setTimeout(function (){

    $('.preloader').hide(350)

} , 500)
