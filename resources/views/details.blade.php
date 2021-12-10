@include('header')
<span id="mini-header" class="my-2">
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
                                    <span data-rating-value="1" data-value="{{ $products->id }}"></span>
                                    <span data-rating-value="2" data-value="{{ $products->id }}"></span>
                                    <span data-rating-value="3" data-value="{{ $products->id }}"></span>
                                    <span data-rating-value="4" data-value="{{ $products->id }}"></span>
                                    <span data-rating-value="5" data-value="{{ $products->id }}"></span>
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
                            <h5>Choose the quantity:</h5>
                            <p class="card-text"></p>
                    </span>
                    <form action=" {{route('addCart')}} " method="POST">
                        @csrf
                        <input type="number" class="w-25" name="quantity" value="1" min="1" max="{{$products->stock}}" placeholder="Quantity" required><br><br>
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <button type="submit" name="add-to-cart" class="btn btn-success">Add to cart <i class="fas fa-shopping-cart"></i></button>
                    </form>
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