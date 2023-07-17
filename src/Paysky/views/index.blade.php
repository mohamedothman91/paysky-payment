    <button type="button" class="btn btn-info" id="paysky_payment_id" onclick="showLightBox()">Pay</button>

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
            SecureHash:  "{{ $payment['SecureHash'] }}" ,
            completeCallback: function (data) {
                console.log('completed');
                console.log(data);
            },
            errorCallback: function (data) {
                console.log('error');
                console.log(data);
            },
            cancelCallback:function () {
                console.log('cancel');
            }
        };

        Lightbox.Checkout.showLightbox();
    }
</script>