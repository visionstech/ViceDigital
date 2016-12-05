@extends('app')
@section('title')
	Publishers
@endsection
@section('content')
<style type="text/css" media="screen">
    #editor { 
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
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
					 <a class="btn btn-default" href="{{ url('/publisher/add-configuration/'.$publisherId) }}">Configuration</a>
                    <a class="btn btn-default"  href="{{ url('/publisher/positions/'.$publisherId) }}">Ad Positions</a>
					<a class="btn btn-primary" href="javascript:void(0);">Custom</a>
				</div>
            <div class="x_content"><br />
                @include('errors.user_error')
                <form action="{{ url('/publisher/add-custom') }}" method="post" class="form-label-left">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="custom_scripting" id="custom_scripting">
                    <input type="hidden" name="publisherId" value="{{ $publisherId }}">               
                    @include('publisher.custom_form',['submitButtonText' => 'Submit'])
                </form>
            
            </div>
        </div>
      </div>
    </div>
    
@endsection  
@section('js')
 <script src="{{ asset('/js/ace.js') }}"></script>
 <script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
    function getCustomScript(){

        var Str='';
        $.each($('.ace_line'), function(index, value) {
                Str += $(this).html();
                Str += '\n';
        });
        $("#custom_scripting").val(Str);
    }

    setTimeout(getCustomScript, 1000);
    $("#editor").on('keyup',function(){        
        var Str='';
        $.each($('.ace_line'), function(index, value) {
            Str += $(this).html();
            Str += '\n';
        });
        $("#custom_scripting").val(Str);
    });

</script>

@endsection
