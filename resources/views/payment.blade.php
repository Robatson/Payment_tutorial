<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Payment Tutorial</title>
</head>

<body>

    <div class="container mt-12">
        <div class="card">
            <div class="car-header">
                Make Payment
                <div class="card-body">
              
                    
                    <form action="{{route('make.order')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="email">
                        @error('email')<font color="red">{{$message}}</font>@enderror  
                      </div>
</div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">phone</label>
                          <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="phone">
                        @error('phone')<font color="red">{{$message}}</font>@enderror  
                      </div>
</div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="payment" name="amount" value="{{ old('amount') }}" placeholder="Amount">
                    @error('amount')<font color="red">{{$message}}</font>@enderror  
                </div>
                 </div>
                 <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Make Payment</button>

                 </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>