<!DOCTYPE html>
<html>
	<head>
		<title>Multiple Payment Gateway Integration With Laravel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>

    </head>
	<body>
		<div class="container">
			<div class="checkout pt-md-5">
				<div class="col-mod-12">
					<h2> Order Details</h2>
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
                                <div class="image_container" style="height: 257px;">
                                    <img src="" class="card-img-top"tyle="width: 100%; height: 100%;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->title}}</h5>
									<p class="card-text">Rs. {{$product->amount}}</p>
									<p class="card-text">{{$product->description}}</p>
                                </div>
							</div>
                        </div>

						<div class="col-lg-5">
							<h3>Pay With </h3>
							<ul class="list-group">
								<li class="list-group-item">
									<form action="https://uat.esewa.com.np/epay/main" method="POST">
										<input value="{{$product->amount}}" name="tAmt" type="hidden">
										<input value="{{$product->amount}}" name="amt" type="hidden">
										<input value="0" name="txAmt" type="hidden">
										<input value="0" name="psc" type="hidden">
										<input value="0" name="pdc" type="hidden">
										<input value="epay_payment" name="scd" type="hidden">
										<input value="{{$order->invoice_no}}" name="pid" type="hidden">
										<input value="{{route('esewa.success')}}" type="hidden" name="su">
										<input value="{{route('esewa.fail')}}" type="hidden" name="fu">
										<input height="40px" type="image" src="{{asset('img/Esewa.png')}}" alt="Submit">
									</form>
								</li>
                                <li class="list-group-item">
                                    <form method="post" >
                                        <input type="hidden"  name="PID" value="{{$fonepay['PID']}}" />
										<input type="hidden" name="MD"  value="{{$fonepay['MD']}}" />
										<input type="hidden" name="PRN" value="{{$fonepay['PRN']}}" />
										<input type="hidden"  name="AMT" value="{{$fonepay['AMT']}}" />
										<input type="hidden"  name="CRN" value="{{$fonepay['CRN']}}" />
										<input type="hidden"  name="DT" value="{{$fonepay['DT']}}" />
										<input type="hidden"  name="R1" value="{{$fonepay['R1']}}" />
										<input type="hidden"  name="R2" value="{{$fonepay['R2']}}" />
										<input type="hidden"  name="DV" value="{{$fonepay['DV']}}" />
										<input type="hidden"  name="RU" value="{{$fonepay['RU']}}" />
                                        <input height="40px" type="image" src="{{ asset('img/fonepay_logo.png') }}" alt="Submit">
                                    </form>
                                </li>
                                <li class="list-group-item">
                                    <!-- Place this where you need payment button -->
                                    <button id="payment-button" class="btn btn-link border-0 p-0"><img style="height:40px;" src="{{ asset('img/khalti.png') }}" alt="Submit"></button>
                                    <!-- Place this where you need payment button -->
                                    <!-- Paste this code anywhere in you body tag -->

                                </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "MOBILE_BANKING",
                "KHALTI",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>
