@include('header')
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Product</th>
        <th style="width:10%">Price</th>
        <th style="width:8%">Quantity</th>
        <th style="width:22%" class="text-center">Subtotal</th>
        <th style="width:10%"></th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0 ?>
    @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <?php $total += $details['price'] * $details['quantity'] ?>
            <tr>
                <td data-th="Product">
                    <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="{{asset('css/t-shirt.png')}}" width="100" height="100" class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{ $details['price'] }} Lei</td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                </td>
                <td data-th="Subtotal" class="text-center">{{ $details['price'] * $details['quantity'] }} Lei</td>
                <td class="actions" data-th="">
                    <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
   
    <tr>
        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total {{ $total }} Lei</strong></td>
        <td> 
            @if(session('cart') != null)
                <div class="col-sm-6 text-center">
                    <a href="{{route('oder.details.form')}}" class="btn btn-success btn-block d-inline-flex">Checkout</a>
                </div>
            @endif
        </td>
    </tr>
    </tfoot>
</table>
@include('footer')
