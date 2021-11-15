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
            <h3 class="mb-2">Admin Users Table</h3>
        </div>
        <div class='col-3 offset-4'>
        <button class="btn btn-success ms-5" onclick="showForm()">Add new user <i class="fas fa-plus mx-2"></i></button>
        </div>
    </div>
    <div class="row">
        <div class='offset-2 col-12' id="hidden-form" style="display: none;">
            <form action=" {{route('add_user')}} " method="POST" id="formElement" >
                @csrf
                <input type="text" class="mx-1" name="email" placeholder="email" required>
                <input type="password" class="mx-1" name="password" placeholder="password" required>
                <input type="password" class="mx-1" name="password_confirmation" placeholder="confirm password" required>
                <button type="submit" class="btn btn-default" >Add User</button>
            </form>
            <label for="cat">Choose a function:</label>
            <select name="is_admin" id="cat" form="formElement" class="mt-2">
                <option selected value="">Non-Admin</option>
                <option value="1">Admin</option>
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
                        <th>Email</th>
                        <th>Admin function</th>
                        <th>created at</th>
                        <th>updated at</th>
                        <th>Action Product</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $userList)
                        <tr>
                            <td>{{$userList->id}}</td>
                            <td>{{$userList->email}}</td>
                            <td>
                                @if ($userList->is_admin == 1)
                                    {{'Admin'}}
                                @else
                                    {{'User'}}
                                @endif
                               </td>
                            <td>{{$userList->created_at}}</td>
                            <td>{{$userList->updated_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form action="admin-user-delete" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$userList->id}}" name="user_id">    
                                            <button class="dropdown-item"  onclick="return confirm('Are you sure you want to delete this item?');" type="submit" >Delete <i class="fa fa-times"></i></button>
                                        </form>
                                    <button class="dropdown-item" data-toggle="modal" data-target="#modal{{$userList->id}}">Edit <i class="fas fa-edit"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal{{$userList->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action=" {{route('edit_user', [$userList->id])}} " method="POST" id="funct">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <label for="email">User Email</label>
                                            <input type="text" name="email" value=" {{$userList->email}} " placeholder="enter the email">
                                            <label for="password">Enter new password</label>
                                            <input type="password" class="mx-1" name="password" placeholder="password" required>
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="mx-1" name="password_confirmation" required>
                                            <label for="admin">Admin Function</label>
                                            <input type="checkbox" name="is_admin" value="1">
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
            <span class="text-center">{{ $user->links() }}</span>
        </div>
    </div>
</div>
</div>
@include('./admin/footer_admin')
