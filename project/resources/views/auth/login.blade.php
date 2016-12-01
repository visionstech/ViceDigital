
@extends('app')
@section('title')
	Login
@endsection
@section('content')
           
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="form login_form">
                    <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                    <label class=""> <?php echo $message; ?> </label>
                    <?php Session::pull('message', 'User Registered Successfully!'); 
                    } ?>
                    <section class="login_content">
                        <form action="{{ url('/auth/login') }}" method="post" class="form-signup">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h1>Login Form</h1>
                            @include('errors.user_error')
                            <div>
                                <input type="email" placeholder="Email" class="form-control" id="login_email" name="email" required>
                            </div>
                            <div>
                                <input type="password" placeholder="Password" class="form-control" id="login_password" name="password" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit" >Log in</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="{{ url('/auth/register') }}" class="to_register" id="register_form"> Create Account </a>
                                </p>
                                <div class="clearfix"></div> <br />
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    
@endsection  
