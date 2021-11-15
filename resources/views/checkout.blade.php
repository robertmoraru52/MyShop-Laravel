<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />  
  </head>
  <body>
  <div class="container-fluid my-container ">
    <div class="card bg-white px-5">
        <div class="card-header">
            <div class="jumbotron mb-1 bg-white ">
                <h1 class="display-5"><b>You'r almost there</b></h1>
            </div>
        </div>
        <div class="card-body">
            <div class="row ">
                <!-- Left Half -->
                <div class="col-md-5 col-sm-5 col-lg-5 col-xs-5 ">
                    <div class="card mt-2 border-0 second-card">
                        <!-- Form -->
                        <div class="card-body">
                            <h5 class="card-title"> Enter Payment details</h5>
                            <div class="row">
                                <div class="col-md-auto col-sm-auto ">
                                    <div class="custom-control custom-radio custom-control-inline "> <input id="customRadioInline11" type="radio" name="customRadioInline11" class="custom-control-input" checked="true"> <label for="customRadioInline11" class="custom-control-label label-radio"><img src="https://img.icons8.com/color/48/000000/visa.png" class="card-image"> </label> </div>
                                </div>
                                <div class="col-md-auto col-sm">
                                    <div class="custom-control custom-radio custom-control-inline "> <input id="customRadioInline22" type="radio" name="customRadioInline11" class="custom-control-input"> <label for="customRadioInline22" class="custom-control-label label-radio"><img src="https://img.icons8.com/officel/48/000000/discover.png" class="card-image"></label> </div>
                                </div>
                            </div> <!-- Payment Form -->
                            <form method="get" action="">
                                <div class="form-group "> <label for="cc-number" class="control-label mt-3">Card number</label> <input id="cc-number" name="cc-number" type="tel" placeholder="xxxx-xxxx-xxxx-xxxx" class="form-control form-control-lg cc-number identified visa " value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number"> </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-6"> <label for="cc-exp" class="control-label ">Expiration date</label> <input id="cc-exp" type="tel" class=" form-control form-control-lg cc-exp" autocomplete="cc-exp" placeholder="MM / YY" required> </div>
                                    <div class="form-group col-md-6 col-sm-6"> <label for="cc-cvc" class="control-label ">CVV<span><i class="fa fa-info-circle px-2" aria-hidden="true"></i> </span> </label> <input id="cc-cvc" type="tel" class="form-control-lg form-control cc-cvc " autocomplete="off" placeholder="•••" required> </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8 col-sm-6"> <label for="inputState">State</label> <select id="inputState" class="form-control form-control-lg">
                                            <option selected>United State</option>
                                            <option>India</option>
                                            <option>UK</option>
                                            <option>China</option>
                                        </select> </div>
                                    <div class="form-group col-md-4 col-sm-6"> <label for="inputZip">Zip</label> <input type="text" class="form-control form-control-lg" id="inputZip" placeholder="111111"> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-none d-sm-block"></div> <!-- Right Half -->
                <div class="col-md-6">
                    <div class="card right-card ">
                        <div class="card-header ">
                            <h3 class="font-weight"><b>My Shop</b></h3>
                            <h6><b>Billed Now : {{$total}} Lei</b></h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Perfect Software Solution is a <span class="text-primary">professional software, website development</span> timely delivered and cost effective software,<span class="text-primary"> website development services</span>. We are highly experienced in offering offshore software development.</p>
                            <div class="custom-control custom-checkbox checkbox-lg"><input type="checkbox" class="custom-control-input" id="checkbox-2"><label class="custom-control-label" for="checkbox-2">I agree <span class="text-primary cursor-pointer"><u> MyShop Terms</u> </span> </label> </div>
                        </div>
                        <div class="card-footer"> 
                            <form action=" {{ route('checkout_buy_now') }} " method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Buy now</button> 
                            </form>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="card-body">
                            <h4 class="card-title">What is included in MyShop Shipping Services</h4>
                            <div class="row ">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item borderless"><i class="fa fa-check"></i> Free Shipping</li>
                                        <li class="list-group-item borderless"><i class="fa fa-check"></i> Safe And On Time </li>
                                        <li class="list-group-item borderless"><i class="fa fa-check"></i> Best Shipping</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 ">
                                    <ul class="list-group list-group-flush p-0">
                                        <li class="list-group-item borderless"><i class="fa fa-check"></i> Order Tracking </li>
                                        <li class="list-group-item borderless"><i class="fa fa-check"></i> Just In Time</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>