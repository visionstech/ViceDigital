@extends('app')
@section('title')
	Publishers
@endsection
<style>
.error_form{color:red;font-size:15px}    
</style>
@section('content')
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="{{ url('/publisher/publishers') }}">Publisher Overview</a></li>
           <li class="active">Add Publisher</li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row">
        <h3>Add Publisher</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="error_form"></div>
            <div class="x_panel">            
				<div class="x_title tab_on">
					<a class="btn btn-default" href="">Configuration</a>
                    <?php if($publisherId !=''){ ?>
                        <a  class="btn btn-primary" href="{{ url('/publisher/positions/'.$publisherId) }}">Ad Positions</a>
                        <a class="btn btn-primary" href="{{ url('/publisher/add-custom/'.$publisherId) }}">Custom</a>
                    <?php }else { ?>
					   <a  class="btn btn-primary invalid_step" href="javascript:void(0);">Ad Positions</a>
                       <a class="btn btn-primary invalid_step" href="javascript:void(0);">Custom</a>
					<?php } ?>
                    
				</div>
            <div class="x_content"><br />
                @include('errors.user_error')
                <form action="{{ url('/publisher/add-configuration') }}" method="post" class="form-label-left">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="publisherId" value="{{ $publisherId }}" >
                    @include('publisher.configuration_form',['submitButtonText' => 'Submit'])
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
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    var x = 1; //initial text box count
    
    $('#add_targeting').click(function() //on add input button click
    {
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="field" name="variable[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    
    });
	
	$("#add_targeting").click(function(){
	    var sizeTarget=$(".target_sub").size();
        if(sizeTarget<49){
    	   $(".target_main").append('<div class="target_sub"><div class="form-group"><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value=""></div><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value=""></div></div></div>');
    	}
    });
	
	$("#delete_targeting").click(function(){
		$('.target_main div.target_sub:last').remove();
	});
	
	$("#add_page_type").click(function(){
	    var sizePage=$(".pagetype_sub").size();
        if(sizePage<49){
		  $(".pagetype_main").append('<div class="pagetype_sub"><div class="form-group"><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="Page Title" class="form-control col-md-7 col-xs-12" name="page_type_title[]" value=""></div><div class="col-md-6 col-sm-6 col-xs-6">            <input type="text" placeholder="Selector" class="form-control col-md-7 col-xs-12" name="page_type_selector[]" value=""></div></div></div>');
        }
	});
	
	$("#delete_page_type").click(function(){
		$('.pagetype_main div.pagetype_sub:last').remove();
	});
    $(".invalid_step").click(function(){
        $('.error_form').html('Please fill this step first.');
    });

}); 
</script>
@endsection