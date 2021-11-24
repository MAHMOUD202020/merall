<div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body noindent">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
                </div>
                <div class="pt-modal-addtocart">
                    <h6 class="pt-title-modal">
                        تم اضافة المنتج الي السلة بنجاح
                    </h6>
                    <div class="pt-modal-product">
                        <div class="pt-img">
                            <img class="imgModalProduct"  alt="Push Up Low Rise Jeans">
                        </div>
                        <h2 class="pt-title"><a href="">Midi button-up denim skirt</a></h2>
                        <a href="#" class="pt-cart-total">
                            تم اضافة 1 قطعة جديدة الي السلة بسعر
                            <div class="pt-total">
                                الاجمالي: <span class="pt-price">$78.96</span>
                            </div>
                        </a>
                        <a href="#" class="btn btn-block btn-dark" data-dismiss="modal">
                            <div class="pt-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <use xlink:href="#icon-arrow_large_left"></use>
                                </svg>
                            </div>
                            <span class="pt-text">
								استكمال التسوق
							</span>
                        </a>
                        <a href="{{route('web.cart.index')}}" class="btn btn-border btn-block">عرض عربة التسوق</a>
                        <!--                        <a href="#" class="btn btn-block disable">PROCEED TO CHECKOUT</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
