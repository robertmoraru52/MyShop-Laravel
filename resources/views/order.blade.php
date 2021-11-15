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
        <th style="width:25%">Product</th>
        <th style="width:25%">Order Id</th>
        <th style="width:10%">Price</th>
        <th style="width:40%">Quantity</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0 ?>
    @if($orders)
        @foreach($orders as $orderList)
            <tr>
                @foreach ($orderList->products as $product)
                <td data-th="Product">
                    <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="{{asset('css/t-shirt.png')}}" width="50" height="50" class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{$product->name}}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Order Id"> {{ $orderList->id }}</td>
                <td data-th="Price"> 
                    {{$product->price}}Lei
               </td>
                <td data-th="Quantity">
                    {{ $product->pivot->quantity }}
                </td>
                <?php $total =  $product->price *  $product->pivot->quantity?>
                @endforeach 
            </tr>
        @endforeach
    @endif
    </tbody>
   
    <tr>
        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total {{$total}} Lei</strong></td>
        <td> 
        </td>
    </tr>
    </tfoot>
</table>
@include('footer')
