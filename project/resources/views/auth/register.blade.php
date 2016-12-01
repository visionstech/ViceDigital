@extends('app')
@section('title')
	Registeration
@endsection
@section('content')

    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="register_wrapper">
            <div id="register" class="form">
                <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
                <?php Session::pull('message', 'User Registered Successfully!'); 
                } ?>
                <section class="login_content">
                    <form action="{{ url('/auth/register') }}" method="post" class="form-signup">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h1>Registeration</h1>
                        @include('errors.user_error')
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="website">Domain <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" placeholder="Domain" class="form-control" name="website" value="{{ old('website') }}" maxlength="32">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" maxlength="32">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="email">Contact Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" maxlength="100">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" placeholder="Password" class="form-control" name="password" maxlength="30">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Repeat Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" placeholder="Repeat Password" class="form-control" name="password_confirmation" maxlength="30">
                            </div>
                        </div>
                        <div class="text-left col-md-12 col-sm-12 col-xs-12">
                            <label>Which products would you like to subscribe to? <span class="required">*</span></label><br>
                            @foreach($products as $product)
                                <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                <?php 
                                    $product_name_array = explode('_', $product->name);
                                    $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                                    $product_name = implode(' ', $product_name_array); ?>
                                <label>{{ $product_name }}</label><br>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit" >Submit</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                          <p class="change_link">Already a member ?
                            <a href="{{ url('/auth/login') }}" class="to_register"> Log in </a>
                          </p>
                          <div class="clearfix"></div> <br />
                        </div>
                  </form>
                </section>
            </div>
                
        </div>
    </div>
    
@endsection  

