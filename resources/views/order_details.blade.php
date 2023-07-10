<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
        crossorigin="anonymous">
    <title>Order Details</title>
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="car-header">
                Payment
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-lg-10">
                            <p><strong>Order ID</strong>: {{$orderid}}</p>
                            <p><strong>Email</strong>: {{$email}}</p>
                            <p><strong>Phone</strong>: {{$phone}}</p>
                            <p><strong>id</strong>: {{($razorpayOrder->id)}}</p>
                            <p><strong>Amount </strong>: {{number_format($razorpayOrder->amount/100)}}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" id="rzp-button1"> Pay</button>

                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        url = "{{route('success')}}"
        var phoneNumber = "{{$phone}}";
        var email = "{{$email}}";
        var options = {
            "key": "rzp_test_ampnuz3NWUHF0M", // Enter the Key ID generated from the Dashboard
            "amount": "{{$razorpayOrder->amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Learning", // Your business name
            "description": "Test Transaction",
            "order_id": "{{$razorpayOrder->id}}", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response) {
                // console.log(response);
                window.location.href = url ;
            },
            "prefill": {
                // "name": "Gaurav Kumar", // Your customer's name
                "email": email, // Your customer's email
                "contact": phoneNumber // Assuming the phone number is available in the "phone" variable
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        // rzp1.on('payment.failed', function (response){
        //     alert(response.error.code);
        //     alert(response.error.description);
        //     alert(response.error.source);
        //     alert(response.error.step);
        //     alert(response.error.reason);
        //     alert(response.error.metadata.order_id);
        //     alert(response.error.metadata.payment_id);
        // });
        document.getElementById('rzp-button1').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>

</html>