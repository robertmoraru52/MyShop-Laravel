@include('header')
<div class="container pb-5 mb-2 mt-5">
    
        <div class="cart-item d-md-flex justify-content-between">
            <span class="remove-item"><a class="text-reset" ><i class="fa fa-times"></i></a></span>
            <div class="px-3 my-3">
                <a class="cart-item-product" href="">
                    <div class="cart-item-product-thumb"><img src="{{asset('css/t-shirt.png')}}" alt="Product"></div>
                    <div class="cart-item-product-info">
                        <h4 class="cart-item-product-title"> </h4><span><strong>Type:</strong> Short Sleeve</span><span><strong>Color:</strong> Black</span>
                    </div>
                </a>
            </div>
            <div class="px-3 my-3 text-center">
                <div class="cart-item-label">Quantity</div>
                <div class="count-input">
                    <select class="form-control" data-id="" id="quantity-cart" onChange="">
                        <option selected></option>
                    </select>
                </div>
            </div>
            <div class="px-3 my-3 text-center">
                <div class="cart-item-label">Price</div><span class="text-xl font-weight-medium">
                    
                </span>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-10 col-md-2">
                <div class="py-2"><span class="d-inline-block align-middle text-sm text-muted font-weight-medium text-uppercase mr-2">Subtotal:</span><span class="d-inline-block align-middle text-xl font-weight-medium">
             
                        Lei</span>
                </div>
            </div>    
        </div>
    <hr class="my-2">
    <div class="row pt-3 pb-5 mb-2">
        <div class="col-sm-6 mb-3 text-center">
            <a class="btn btn-style-1 btn-secondary btn-block" href="/"><i class="fe-icon-refresh-ccw"></i>Continue Shopping</a>
        </div>
        <div class="col-sm-6 mb-3 text-center"><a class="btn btn-style-1 btn-primary btn-block" href="checkout.php"><i class="fe-icon-credit-card"></i>Checkout</a></div>
    </div>
</div>
@include('footer')
