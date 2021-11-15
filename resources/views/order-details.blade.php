@include('header')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
            <span class="text-black-50">{{Auth::user()->email}}</span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Shipping Details</h4>
                </div>
                <form action=" {{ route('view.checkout') }} " method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Phone Number</label>
                            <input type="text" class="form-control w-100" placeholder="" id="phone" name="phone">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Address</label>
                            <input type="text" class="form-control" placeholder="" name="address">
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit" id="submit" name="submit">Go to payment details</button>
                    </div>
                </form>
            </div>
        </div>
            @if(session()->has('errors'))
                <div class="alert alert-danger mt-3">
                    {{ session()->get('errors') }}
                </div>
            @endif
    </div>
</div>
@include('footer')