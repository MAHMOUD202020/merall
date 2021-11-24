$(function () {

    let selectArea = $('#area'),
        areas = [],
        country = $('#country'),
        shippingSACountryMessage = $('.shipping-SA-country'),
        shippingOtherCountryMessage = $('.shipping-other-country'),
        bank = $('#bank');

    country.on('change', function (e) {

        selectArea_method($(this));

        checkIsCacheAvailable($('#area'))

        if ($(this).val() == 2){

            shippingOtherCountryMessage.removeClass('d-none');
            shippingOtherCountryMessage.slideDown(500);
            shippingSACountryMessage.slideUp(500);

        }else {

            shippingOtherCountryMessage.slideUp(500);
            shippingSACountryMessage.slideDown(500);


        }

    });

    selectArea_method(country)


    function selectArea_method($this) {

        let data = $.parseJSON($this.find(':selected').attr('data-areas'));

        $.each(data, function ($key, $val) {


            let $id = $val['id'];
            let  isSelected = $id == area_selected ? 'selected' : '';

            areas.push("<option "+isSelected+" value='" + $id +"' data-shipping='"+$val['shipping_price']+"' data-cache='"+$val['cache']+"' >" + $val['name'] + "</option>")

        })

        selectArea.html(areas);
        areas = [];
    }



    $('#cache').on('change' , function (){

        $('#bank-box').slideUp(500);
        $('#cache-box').slideDown(500);
    })

    bank.on('change' , function (){

        $('#bank-box').removeClass('d-none').slideDown(500);
        $('#cache-box').slideUp(500);
    })

    if (bank.prop('checked')){

        $('#bank-box').removeClass('d-none').slideDown(500);
    }

    $('#btn-update-cart').on('click' , function (e){

        e.preventDefault();

        $('#form-update-cart').submit()
    })

    $('.js-remove-item').on('click' , function (e){

        e.preventDefault();

        $('#form_delete_product').attr('action' , $(this).attr('data-href')).submit()
    })


    // ####### on click btn plus or minus count product write new price #######
    $('.plus-btn , .minus-btn').on('click' , function (){


        setTimeout( ()=>{

            let minPrice =  $(this).parents('.pt-col').siblings('.min-price').attr('data-price');
            let countProducts =  $(this).siblings('.count-products').val();
            let totalPrice =  $(this).parents('.pt-col').siblings('.total-price').children('.pt-price');

            totalPrice.text(minPrice*countProducts + ' ريال')

        }  ,250)
    })



    let orderShipping = $('#order-shipping span');
    let orderPrice = parseFloat($('#order-price').attr('data-price'));
    let orderTotal = $('#order-total span');
    let area_shipping_price = $('#area-shipping-price')

    // ####### replace total price on select area shipping #######

    function checkIsCacheAvailable($this){

        if ($this.find(':selected').attr('data-cache') != 1){

            $('.cache-payment').addClass('d-none')
            bank.click()

        }else {

            $('.cache-payment').removeClass('d-none')
        }
    }

    $('body').on('change' , '#area' , function (){

        shippingPrice = parseInt($(this).find(':selected').attr('data-shipping'));

        // replace area name and area price n string
        area_shipping_price.text(shippingPrice)

        // replace total price
        orderTotal.text(parseFloat(shippingPrice + orderPrice).toFixed(2))

        // replace shipping price
        orderShipping.text(shippingPrice)

        checkIsCacheAvailable($(this))
    })



    // ####### after load page  #######

    setTimeout(function (){

        let shipping_price = parseInt(selectArea.find(':selected').attr('data-shipping'));

        area_shipping_price.text(shipping_price)

        orderShipping.text(shipping_price)

        orderTotal.text(parseFloat(shipping_price + orderPrice).toFixed(2))

        checkIsCacheAvailable($('#area'))

    } , 250)

});
