@include('header')
<!-- products start -->
<p id="livesearch"></p>
<div class="container">
    <div class="mt-5 mb-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-5">
                <div class="card text-white text-center" id="hero">
                    <div class="card-header">
                        Featured Products
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">Our Hottest Products at the moment</h5>
                        <img src="{{asset('css/t-shirt.png')}}" class="img-fluid" alt="t-shirt"><br><br>
                        <a href="#" class="btn btn-success">See the featured products</a>
                    </div>
                    <div class="card-footer text-white">
                        See More Products That May Interest You 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-5 mt-5 text-center">
                <h1>Products</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($products as $productList)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4 text-center my-2">
                            <div class="card border-0 bg-dark h-100">
                                <img src="{{asset('css/t-shirt.png')}}" class="img-fluid" alt="t-shirt">
                                <div class="card-body">
                                    <span style="color: white">
                                    <h5 class="card-title">{{$productList->name}}</h5>
                                    </span>
                                    <span style="color: white">
                                        <p class="card-text">{{$productList->name}}</p>
                                    </span>
                                    <div class="modal-review__rating-order-wrap ms-5" >
                                        <span data-rating-value="1" data-value="{{ $productList->id }}"></span>
                                        <span data-rating-value="2" data-value="{{ $productList->id }}"></span>
                                        <span data-rating-value="3" data-value="{{ $productList->id }}"></span>
                                        <span data-rating-value="4" data-value="{{ $productList->id }}"></span>
                                        <span data-rating-value="5" data-value="{{ $productList->id }}"></span>
                                    </div>
                                    <br><br>
                                <p class="text-white">Rating: {{ $productList->stars }}/5</p>
                                    <br><br>
                                    <p class="text-white" id="ratings"></p>
                                    <span style="color: rgb(240, 43, 48);">
                                        <h6>{{$productList->price}} Lei</h6>
                                    </span>
                                </div>
                            <form action="{{route('details.product')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$productList->id}}">
                                <button type="submit" class='btn btn-success mb-3'>See More Details</button>
                            </form>
                            </div>
                        </div>      
                    @endforeach
                </div>
                <div class="row">
                    <div class="offset-md-5 col-md-7">
                        <span class="text-center">{{ $products->links() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- products end -->
@include('footer')
