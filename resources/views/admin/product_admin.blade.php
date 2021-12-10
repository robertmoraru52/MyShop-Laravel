@include('./admin/header_admin')
<div class='container mt-5' id="app">
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
            <h3 class="mb-2">Admin Products Table</h3>
        </div>
        <div class='col-3 offset-4'>
        <button class="btn btn-success ms-5" onclick="showForm()">Add new product <i class="fas fa-plus mx-2"></i></button>
        </div>
    </div>
    <div class="row">
        <div class='offset-2 col-12' id="hidden-form" style="display: none;">
            <form action=" {{route('add_product')}} " method="POST" id="formElement" >
                @csrf
                <input type="text" class="mx-1" name="name" placeholder="Name" required>
                <input type="text" class="mx-1" name="stock" placeholder="Stock" required>
                <input type="text" class="mx-1" name="price" placeholder="Price" required>
                <input type="text" class="mx-1" name="description" placeholder="Description" required>
                <button type="submit" class="btn btn-default" >Add product</button>
            </form>
            <label for="cat">Choose a category:</label>
            <select name="cat" id="cat" form="formElement" class="mt-2">
                <option value="volvo">Clothes</option>
                <option value="saab">Furniture</option>
                <option value="opel">Open Space</option>
            </select>
        </div>
    </div>
    <div class='row-fluid'>
        <div class='col-xs-10 col-sm-10 col-xl-10 col-md-10 offset-2'>
            <div class='table-responsive'>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action Product</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $productsList)
                        <tr>
                            <td>{{$productsList['id']}}</td>
                            <td>{{$productsList['name']}}</td>
                            <td>{{$productsList['stock']}}</td>
                            <td>{{$productsList['price']}}</td>
                            <td >
                                <category-select-component :id="{{$productsList['id']}}" :products="{{json_encode($productsList) }}" :categories="{{json_encode($cat)}}"></category-select-component>                                
                            </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action button
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <form action="admin-product-delete" method="POST">
                                        @csrf
                                    <input type="hidden" value="{{$productsList['id']}}" name="product_id">    
                                  <button class="dropdown-item"  onclick="return confirm('Are you sure you want to delete this item?');" type="submit" >Delete <i class="fa fa-times"></i></button>
                                </form>
                                  <button class="dropdown-item" data-toggle="modal" data-target="#modal{{$productsList['id']}}">Edit <i class="fas fa-edit"></i></button>
                                </div>
                              </div>
                        </td>
                        </tr>
                        <div class="modal fade" id="modal{{$productsList['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action=" {{route('edit_product')}} " method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <label for="name">Product's Name</label>
                                            <input type="text" name="name" value=" {{$productsList['name']}} " placeholder="enter the name">
                                            <label for="stock">Product's Stock</label>
                                            <input type="text" value=" {{$productsList['stock']}} "  name="stock" placeholder="enter the stock">
                                            <label for="price">Product's Price</label>
                                            <input type="text" value=" {{$productsList['price']}} "  name="price" placeholder="enter the price">
                                            <label for="description">Product's Description</label>
                                            <textarea type="text" name="description" placeholder="enter the description" rows="5">{{$productsList['description']}}</textarea>
                                            <input type="hidden" name="product_id" value=" {{$productsList['id']}} ">
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
            {{-- <span class="text-center">{{ $products->links() }}</span> --}}
        </div>
    </div>
</div>
</div>
@include('./admin/footer_admin')
