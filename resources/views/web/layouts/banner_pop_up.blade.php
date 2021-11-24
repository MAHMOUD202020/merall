@if (!session('orderWhatsapp'))

    @php(session(['orderWhatsapp' => true]))

    <div class="modal fade" id="ModalDiscount" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true" data-pause=2000 data-localStorage=showedmodal>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="icon icon-clear"></span></button>
                </div>
                <form id="newsletterform-03" class="form-default" method="post" novalidate="novalidate" action="#">
                    <div class="modal-body pt-background">
                        <div class="pt-modal-discount row no-gutters">
                            <div class="col-6 ml-auto">
                                <div class="pt-promo-title">
                                    <div class="text-01">
                                        منتجات معقمة ومغلفة واصلية 100%
                                    </div>
                                    <div class="text-03">
                                        يمكنك اضافة الطلب  عن طريق الجوال او من خلال الواتس اب
                                    </div>
                                </div>
                                <div class="text-center font-weight-bold">
                                    <a href="tel:+966552822229">
                                        +966552822229
                                        <img src="{{asset('assets/admin/plugins/font-icons/feather/phone-call.svg')}}" alt="">
                                    </a>
                                </div>
                                <div class="text-center font-weight-bold text-info">
                                    او
                                </div>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=+966552822229&text=some%20predefined%20message&source=&data=" class="btn">تواصل عبر واتس اب</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endif
