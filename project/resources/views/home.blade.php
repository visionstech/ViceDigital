@extends('app')
@section('title')
	Dashboard
@endsection
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="row tile_count"></div>
            <!-- /top tiles -->
            
            <div class="row">
                <h3>Dashboard</h3>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Statistics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Impressions last 30 days</td>
                                        <td>100.000.00</td>
                                    </tr>
                                    <tr>
                                        <td>Impressions last month</td>
                                        <td>120.000.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Notices</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>- Overlays are enabled but not generating impressions</td>
                                        <td><button type="button" class="btn btn-primary">Report</button></td>
                                    </tr>
                                    <tr>
                                        <td>- Decrease of impressions last 30 days compared to last month</td>
                                        <td><button type="button" class="btn btn-primary">Report</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Live</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><?php echo ($product->status == 1) ? 'Yes' : 'No'; ?></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    
@endsection

