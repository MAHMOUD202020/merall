$(function (){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    let body = $('body');
        modalAddToCart = $('#modalAddToCart'),
        imgModal = modalAddToCart.find('.pt-img img'),
        titleModal = modalAddToCart.find('.pt-title'),
        coverTotalModal = modalAddToCart.find('.pt-cart-total'),
        totalModal = modalAddToCart.find('.pt-total'),
        coverCart = $('.render-cart');
        cartProductsCount = $('.cart_products_count');

    body.on('click' , '.pt-btn-addtocart' , function (e){

        e.preventDefault();
        $('.product-add-to-cart-active-now').removeClass('product-add-to-cart-active-now')
        $(this).parents('.pt-product').addClass('product-add-to-cart-active-now')
        let product = $('.product-add-to-cart-active-now');

        $.ajax({
            url:$(this).attr('href'),
            method:'post',
            type:'html',
            data:{'color_id' : undefined},
            success(response){

                coverCart.html(response.data)

                cartProductsCount.text(response.count)
            },
        })

        imgModal.attr('src' ,product.find('picture source').attr('srcset'))
        titleModal.text(product.find('.pt-title a').text())
        coverTotalModal.attr('href' , product.find('.pt-title a').attr('href'))
        let endPrice = product.find('.pt-price').children('.new-price')[0] !== undefined ? product.find('.pt-price').children('.new-price').text() :  product.find('.pt-price').text()
        totalModal.text(endPrice)

        modalAddToCart.modal('toggle');
    })

    body.on('click'  , '.removeProductInCart', function (e){

        e.preventDefault();

        $.ajax({

            method: 'delete',
            url:$(this).attr('href')
        })

        $(this).parents('.pt-item').hide().remove();

        let countProductNow = parseInt(cartProductsCount.text()) - 1;
        let cartProductsTotal = $('.pt-cart-total-price');

        cartProductsCount.text(countProductNow)

        if (countProductNow == 0){

            coverCart.html("    <a class=\"pt-cart-empty render\">\n" +
                "        <p>لا توجد اي منتجات في عربة التسوق</p>\n" +
                "    </a>")
        }

        console.log($(this).parent().prev().find('pt-price').text() , $(this).parent().prev().find('.pt-price')[0])
        cartProductsTotal.text(parseFloat(cartProductsTotal.text()) - parseFloat($(this).parent().prev().find('.pt-price').text()))


    })

    body.on('click' , '.pt-btn-wishlist' ,  function (){


        $.ajax({

            'url':$(this).attr('href'),

            method:'post',

            success(response){

                $('#likes-count').text(response.count)
            },
        })

    })

    body.on('click' , '.pt-btn-compare' ,  function (){

        $.ajax({

            'url':$(this).attr('href'),

            method:'post',

            success(response){

                $('#compares-count').text(response.count)
            },
        })

    })
})
