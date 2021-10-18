@include('header')
<span id="mini-header" class="my-5">
    <h1>{{$products->name}}</h1>
</span>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 text-center">
            <div class="card border-0 bg-dark mb-2">
                <img src="{{asset('css/t-shirt.png')}}" alt="t-shirt">
                <div class="card-body">
                    <span style="color: white" class="card-title">
                        <h5>{{$products->name}}</h5>
                    </span>
                    <span style="color: white" class="card-text">
                        <p>{{$products->description}}</p>
                    </span>
                    <div class="modal-review__rating-order-wrap ms-5" >
                                        <span data-rating-value="1"></span>
                                        <span data-rating-value="2"></span>
                                        <span data-rating-value="3"></span>
                                        <span data-rating-value="4"></span>
                                        <span data-rating-value="5"></span>
                                    </div>
                                    <br><br>
                                    <p class="text-white">Votes:0</p>
                                    <br><br>
                                    <p class="text-white" id="ratings"></p>
                    <span style="color: rgb(240, 43, 48);">
                        <h6>{{$products->price}} Lei</h6>
                    </span>
                    <span style="color: green;">
                        <h6>{{$products->stock}} In Stock</h6>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 text-center">
            <div class="card border-0 bg-dark mb-2">
                <div class="card-body">
                    <span class="text-white">
                        <h2 class="card-title">{{$products->name}}</h1><br>
                            <h5>Comments:</h5>
                            <p class="card-text"></p>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center my-4">
                <h4>Description</h4>
                <p>{{$products->description}}</p>
            </div>
        </div>
    </div>
</div>
@include('footer')