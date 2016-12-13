@extends('app')
@section('title')
	Users
@endsection
@section('content')
<!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
           <li class="active"><a href="{{ url('/user') }}">Users Overview</a></li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row publisher">
        <h3>Manage Users</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <a class="btn btn-primary" style="float:right;" href="{{ url('/user/add-user') }}">Add User</a>
                <div class="x_content">
                    @if(Session::has('success')) 
                        <div class="alert alert-success"> 
                            {{Session::get('success')}} 
                        </div> 
                    @endif
                    @if(Session::has('error')) 
                        <div class="alert alert-danger"> 
                            {{Session::get('error')}} 
                        </div> 
                    @endif
                    <div class="pub-table">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>User name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <?php //$adsId=encrypt($position->id); 
                                    if($user->role==1){
                                        $role='Admin';
                                    }else if($user->role==2){
                                        $role='User';
                                    }else{
                                        $role='Manager';
                                    }
                            ?>
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $role }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->status }}</td>
                                   <td>
                                    <?php if($user->status != 'Deleted'){ ?>
                                          <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="{{ encrypt($user->id) }}" data-status="Deleted">Delete</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="{{ url('/user/add-user/'.encrypt($user->id)) }}">Edit</a>
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<!-- Popup Model For Delete action -->

<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete User</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to delete this user ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="UserId" class="UserId" />
                <input type="hidden" name="status" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- End Popup Model -->
@endsection
@section('js')
<script src="{{ asset('/js/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#example").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var UserId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            $('.status').val(status);
            $('.UserId').val(UserId);
        });
        
        $('.delete_confirm').click(function(){
            var UserId=$('.UserId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });
</script>
@endsection
 

