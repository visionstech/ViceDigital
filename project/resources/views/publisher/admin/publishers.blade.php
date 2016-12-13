@extends('app')
@section('title')
	Publishers
@endsection
@section('content')
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
           <li class="active">Publisher Overview</li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row publisher">
        <h3>Publishers</h3> 
        <div class="col-md-12 col-sm-12 col-xs-12 pub-table">
            <div class="x_panel">
                <a class="btn btn-primary" style="float:right;" href="{{ url('/publisher/add-configuration') }}">NEW PUBLISHER</a>
                <div class="x_content">
                    <table class="table display nowrap dataTable dtr-inline" id="example">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Impressions</th>
                                <th>Notices</th>
                                <th>Created by</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publishers as $publisher)
                                <?php if($publisher->role==1){
                                        $created_by='Admin';
                                    }else if($publisher->role==2){
                                        $created_by='User';
                                    }else{
                                         $created_by='Partnership Manager';
                                    } ?>
                                <tr>
                                    <td>{{ $publisher->website }}</td>
                                    <td>10.000.000</td>
                                    <td>6</td>
                                    <td>{{ $created_by }}</td>
                                    <td>{{ $publisher->status }}</td>
                                    <td><a class="btn btn-primary" href="{{ url('/publisher/add-configuration/'.encrypt($publisher->id)) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>  
@endsection
@section('js')
<script src="{{ asset('/js/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function(){
        $("#example").dataTable();
    });
</script>
@endsection