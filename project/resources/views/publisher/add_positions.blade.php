@extends('app')
@section('title')
	Publishers
@endsection
@section('content')
    
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="{{ url('/publisher/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="{{ url('/publisher/publishers') }}">Publisher Overview</a></li>
           <li class="active">Edit Publisher</li>
        </ol>
    </div>
    <!-- /top tiles -->

    
    <div class="row">
        <h3>Add Publisher</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
				<div class="x_title tab_on">
					<a class="btn btn-primary" href="">Configuration</a>
					<a class="btn btn-default"  href="">Ad Positions</a>
					<a class="btn btn-primary" href="">Custom</a>
				</div>
            <div class="x_content"><br />
                @include('errors.user_error')
                <form action="{{ url('/publisher/add-positions') }}" method="post" class="form-label-left">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="publisherId" value="{{ $publisherId }}">
                    @include('publisher.add_form',['submitButtonText' => 'Submit'])
                </form>
            </div>
        </div>
      </div>
    </div>
    
@endsection  

@section('js')
<script type="text/javascript">
$(document).ready(function()
{
  $("#add_targeting").click(function(){
	
	$(".target_main").append('<div class="target_sub"><div class="form-group"><div class="col-md-3 col-sm-3 col-xs-6"><input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value=""></div><div class="col-md-3 col-sm-3 col-xs-6"><input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value=""></div></div></div>');
	});
	
	$(".mobile").click(function(){
        if($(this).val()=='default'){
            $(".mobile_sizes").val('');
            $(".mobile_sizes").attr('readonly',true);

        }else{
            $(".mobile_sizes").val('');
            $(".mobile_sizes").attr('readonly',false);
        }
	});
    $(".tablet").click(function(){
       if($(this).val()=='default'){
            $(".tablet_sizes").val('');
            $(".tablet_sizes").attr('readonly',true);
        }else{
            $(".tablet_sizes").val('');
            $(".tablet_sizes").attr('readonly',false);
        }
    });
    $(".desktop").click(function(){
       if($(this).val()=='default'){
            $(".desktop_sizes").val('');
            $(".desktop_sizes").attr('readonly',true);
        }else{
            $(".desktop_sizes").val('');
            $(".desktop_sizes").attr('readonly',false);
        }
    });
	$("#delete_targeting").click(function(){
		$('.target_main div.target_sub:last').remove();
	});
}); 
</script>

@endsection