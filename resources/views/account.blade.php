@include('header')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if (Auth::user()->image == null) 
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="" title="">
                @else
                    <img class="rounded-circle mt-5" width="150px" src="{{asset('storage/images/'.Auth::user()->image)}}" alt="" title="">
                @endif
            <span class="text-black-50">{{Auth::user()->email}}</span>
            <form action="imageUpload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="col-md-4 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="../back_end/account_back.php" method="POST">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Mobile Number</label>
                            <input type="text" class="form-control" placeholder="" id="mobile" name="mobile">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Address</label>
                            <input type="text" class="form-control" placeholder="" name="address">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Postcode</label>
                            <input type="text" class="form-control" placeholder="" id="post_code" name="post_code">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="labels">Country</label>
                            <input type="text" class="form-control" placeholder="" id="country" name="country">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">State/Region</label>
                            <input type="text" class="form-control" name="region" id="region" placeholder="">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit" id="submit" name="submit">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span><h4>Change Password</h4></span></div><br>
                <form id="form-change-password" role="form" method="POST" action="change-password" novalidate class="form-horizontal">
                    <div class="col-md-12">             
                      <label for="current-password" class="col-sm-4 control-label">Old Password</label>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                          <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
                        </div>
                      </div>
                      <label for="password" class="col-sm-4 control-label">New Password</label>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                      </div>
                      <label for="password_confirmation" class="col-sm-4 control-label">Confirm</label>
                      <div class="col-sm-8">
                        <div class="form-group">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-5 col-sm-6 mt-2 d-inline-flex">
                        <button type="submit" class="btn btn-success">Save Password</button>
                      </div>
                    </div>
                  </form>
                @if(session()->has('errors'))
                    <div class="alert alert-danger mt-3">
                        {{ session()->get('errors') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('footer')