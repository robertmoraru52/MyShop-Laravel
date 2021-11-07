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
    <div class="row">
        <div class="col-md-9 d-flex justify-content-center mb-4 ">
            <form action=" {{route('search_admin_category')}} " method="POST">
                @csrf
                <div class="form-inline">
                    <div class="input-group" >
                        <input class="form-control" id="search_category" type="search" name="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-sidebar border-secondary">
                            <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div id="s_paragraph_category">
                <ul></ul>
            </div>
        </div>
        <div class="col-md-3 d-flex justify-content-center mb-4">
            <a href="admin-category"><span>Go Back </span><i class="fas fa-sync-alt"></i></a>
        </div>
    </div>
    <div class='row'>
        <div class='col-3 offset-2'>
            <h3 class="mb-2">Admin Category Table</h3>
        </div>
        <div class='col-3 offset-4'>
            <button class="btn btn-success ms-5" onclick="showForm()">Add new category <i class="fas fa-plus mx-2"></i></button>
        </div>
    </div>
    <div class="row">
        <div class='offset-2 col-12' id="hidden-form" style="display: none;">
            <form action=" {{route('add_category')}} " method="POST" id="formElement" >
                @csrf
                <label for="name">Enter a name for your Category:</label><br>
                <input type="text" class="mx-1" name="name" placeholder="Category Name" required>
                <button type="submit" class="btn btn-default" >Add Category</button>
            </form>
            <label for="cat">Choose Products for your Category:</label><br>
            <select multiple name="product" size="5" id="cat" form="formElement" class="mt-2">
                @foreach ($product as $productList)
                <option value="{{$productList->id}}">{{$productList->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class='row-fluid'>
        <div class='col-xs-10 col-sm-10 col-xl-10 col-md-10 offset-2'>
            <div class='table-responsive'>
                <table class='table table-hover table-inverse table-dark'>
                    <tr>
                        <th>Category ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action Category</th>
                    </tr>
                    @foreach ($categories as $categoryList)
                        <tr>
                            <td>{{$categoryList->id}}</td>
                            <td>{{$categoryList->name}}</td>
                            <td>@foreach ($categoryList->products as $products)
                                {{$products->name." "}}
                            @endforeach</td>
                            <td>{{$categoryList->created_at}}</td>
                            <td>{{$categoryList->updated_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form action="admin-category-delete" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$categoryList->id}}" name="cat_id">    
                                            <button class="dropdown-item"  onclick="return confirm('Are you sure you want to delete this item?');" type="submit" >Delete <i class="fa fa-times"></i></button>
                                        </form>
                                    <button class="dropdown-item" data-toggle="modal" data-target="#modal{{$categoryList->id}}">Edit <i class="fas fa-edit"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal{{$categoryList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="edit-category" method="POST" id="funct">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <label for="name">Category Name</label>
                                            <input type="text" name="name" value="{{$categoryList->name}} " placeholder="Change Category Name">
                                            <input type="hidden" name="category_id" value="{{$categoryList->id}}">
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
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-5 col-md-7">
            <span class="text-center"></span>
        </div>
    </div>
</div>
</div>
@include('./admin/footer_admin')
