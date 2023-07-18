<button type="button" class="btn btn-info" id="paysky_payment_id" onclick="showLightBox()">{{__('paysky.paybtn')}}</button>
@isset($payment)

    @if (env('PaySky_Enviroment') == 'production')
        <script src="https://npg.moamalat.net:6006/js/lightbox.js"></script>
    @else
        <script src="https://tnpg.moamalat.net:6006/js/lightbox.js"></script>
    @endif


    <script type="text/javascript">
        function showLightBox() {
            Lightbox.Checkout.configure = {
                paymentMethodFromLightBox: "{{ $payment['paymentMethodFromLightBox'] }}",
                MID: "{{ $payment['MID'] }}",
                TID: "{{ $payment['TID'] }}",
                AmountTrxn: "{{ $payment['AmountTrxn'] }}",
                MerchantReference: "{{ $payment['MerchantReference'] }}",
                TrxDateTime: "{{ $payment['TrxDateTime'] }}",
                SecureHash: "{{ $payment['SecureHash'] }}",
                completeCallback: function(data) {
                    @if(Route::has('paysky.payment.completeCallbac'))
                        var url = "{{ route('paysky.payment.completeCallback') }}";
                            url += "?refNumber={{ $payment['MerchantReference'] }}";
                            url += "&TxnNumber=" + data.SystemReference;
                            window.location.href = url;
                    @endif
                  

                },
                errorCallback: function(data) {
                    @if(Route::has('paysky.payment.completeCallback'))
                        var url = "{{ route('paysky.payment.errorCallback') }}";
                            url += "?refNumber={{ $payment['MerchantReference'] }}";
                        window.location.href = url;
                    @endif
                },
                cancelCallback: function() {
                    console.log('cancel');
                }
            };

            Lightbox.Checkout.showLightbox();
        }
    </script>
@endisset
