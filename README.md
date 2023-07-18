
# Paysky Payment Light Box & Pay Button

## Installation
Require via composer

```bash
$ composer require paysky/payment
```

In `config/app.php` file

```php
'providers' => [
    ...
    PaySky\Payment\Providers\PaySkyPaymentServiceProvider::class,
    ...
];


'aliases' => [
    ...
    'PaySky' => PaySky\Payment\Facades\PaySky::class,
    ...
];

```

First of all, make an account on paysky -  run this command to generate the PaySky configuration file and choose the package
```bash
$ php artisan vendor:publish  
```
add configurations to your .env file and 
```bash
PaySky_MerchantSecretKey= XXXXX
PaySky_MerchantId= XXXXX
PaySky_TerminalId= XXXXX
PaySky_Enviroment= sandbox-production   
```
Create 2 routes for callback with name
```bash
completeCallback -> paysky.payment.completeCallback
errorCallback -> paysky.payment.errorCallback
```
In Controller init new payment class add amount - oderId - merchRef
```bash
$payment = PaySky::makePayment(100000 , rand() );

```
add payment button in your checkout page
```bash
@include('paysky::index')
```
tanslation key for btn
```bash
paysky.paybtn
```
pass payment variable to view have button link

```bash
return view('welcome' ,  ['payment' => $payment ]  );

```

# all amount by small curruncy ()
