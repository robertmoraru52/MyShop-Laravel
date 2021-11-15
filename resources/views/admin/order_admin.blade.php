@include('./admin/header_admin')
<div class='container mt-5'>
    <div class="row">
        <div class="offset-md-4 col-md-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
    </div>
    <div class='row'>
        <div class='col-3 offset-2'>
            <h3 class="mb-2">Admin Orders Table</h3>
        </div>
    </div>
    <div class='row-fluid'>
        <div class='col-xs-10 col-sm-10 col-xl-10 col-md-10 offset-2'>
            <div class='table-responsive'>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Client Name</th>
                            <th>Client Address</th>
                            <th>Client Phone</th>
                            <th>Ordered at</th>
                            <th>Products Ordered(quantity)</th>
                            <th>Action Product</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $orderList)
                        <tr>
                            <td id="id">{{$orderList->id}}</td>
                            <td id="name">{{$orderList->name}}</td>
                            <td id="address">{{$orderList->address}}</td>
                            <td id="phone">{{$orderList->phone}}</td>
                            <td id="created_at">{{$orderList->created_at}}</td>
                            <td>@foreach ($orderList->products as $product)
                                {{$product->name}}({{$product->pivot->quantity}})
                            @endforeach</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form action="admin-order-delete" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$orderList->id}}" name="order_id">    
                                            <button class="dropdown-item"  onclick="return confirm('Are you sure you want to delete this item?');" type="submit" >Delete <i class="fa fa-times"></i></button>
                                        </form>
                                    <button class="dropdown-item" data-toggle="modal" data-target="#modal{{$orderList->id}}">Edit <i class="fas fa-edit"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal{{$orderList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="edit-order" method="POST" id="funct">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <label for="name">User Name</label>
                                            <input type="text" name="name" value=" {{$orderList->name}} " placeholder="enter the email">
                                            <label for="address">User Address</label>
                                            <input type="text" name="address" value=" {{$orderList->address}} " placeholder="enter the email">
                                            <label for="phone">User Phone</label>
                                            <input type="text" name="phone" value=" {{$orderList->phone}} " placeholder="enter the phone">
                                            <input type="hidden" value=" {{$orderList->id}} " name="order_id"><br>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-5 col-md-7">
            <span class="text-center">{{ $orders->links() }}</span>
        </div>
    </div>
</div>
</div>
@include('./admin/footer_admin')
