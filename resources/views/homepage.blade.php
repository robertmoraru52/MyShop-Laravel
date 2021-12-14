@extends('layouts.master')
@extends('layouts.message')
<!-- products start -->
@section('content')
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
                <div class="row" id="productsHomepage">
                    <products-homepage-component></products-homepage-component>
                </div>
                <div class="row">
                    <div class="offset-md-5 col-md-7">
                        <span class="text-center"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- products end -->
