@extends('app')
@section('title')
	Publishers
@endsection
@section('content')

{{-- */use App\Repositories\CommonRepositoryInterface;/* --}}
{{-- */use App\Repositories\CommonRepository;/* --}}
    
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
        <h3>Ad Positions</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <a class="btn btn-primary" style="float:right;" href="{{ url('/publisher/add-positions/'.$publisherId) }}">NEW ADSLOT</a>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Slotname</th>
                                <th>Notices</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($positions as $position)
                                <tr>
                                    <td>{{ $position->slotname }}</td>
                                    <td>6</td>
                                    <?php   /*if($position->status == 1) { $position_status = 'Live'; }
                                            else if($position->status == 2) { $position_status = 'Paused'; }
                                            else if($position->status == 3) { $position_status = 'Suspended'; }
                                    
                                    */?>
                                    <td>{{ $position->status }}</td>
                                    <td><a class="btn btn-primary" href="{{ CommonRepository::encryptId($position->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

    
@endsection  

