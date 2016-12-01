
    <h2>General Information</h2>
    <input type="hidden" name="publisher_id" value="<?php (isset($publisher)) ? $publisher->id : ''; ?>">
    <div class="form-group">
       <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Publisher Status</label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="status" class="form-control col-md-7 col-xs-12">
            <option value="Live">Live</option>
            <option value="Suspended">Suspended</option>
            <option value="Paused">Paused</option>
        </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="website">Domain <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$website = (old('website')) ? old('website') : (isset($publisher)) ? $publisher->website : ''; ?>
            <input type="text" placeholder="Domain" class="form-control col-md-7 col-xs-12" name="website" value="{{ old('website') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$name = (old('name')) ? old('name') : (isset($publisher)) ? $publisher->name : ''; ?>
            <input type="text" placeholder="Name" class="form-control col-md-7 col-xs-12" name="name" value="{{ old('name') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="email">Contact Email <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$email = (old('email')) ? old('email') : (isset($publisher)) ? $publisher->email : ''; ?>
            <input type="email" placeholder="Email" class="form-control col-md-7 col-xs-12" name="email" value="{{ old('email') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    
    
    <br>
    <h2>Standard Products</h2>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            @foreach($products as $product)
                <?php $check_product = (isset($publisher) && $publisher[$product['name']] == 1) ? 'checked="checked"' : ''; ?>
                <input type="checkbox" name="products[]" value="{{ $product['id'] }}">
                <?php 
                $product_name_array = explode('_', $product['name']);
                $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                $product_name = implode(' ', $product_name_array); ?>
                <label>{{ $product_name }}</label><br>
            @endforeach
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <h2>DFP Setup</h2>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="adunit_id">Adunit ID <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$adunit_id = (old('adunit_id')) ? old('adunit_id') : (isset($publisher)) ? $publisher->adunit_id : ''; ?>
            <input type="text" placeholder="Adunit ID" class="form-control col-md-7 col-xs-12" name="adunit_id" value="{{ old('adunit_id') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="krux_id">Krux ID <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$krux_id = (old('krux_id')) ? old('krux_id') : (isset($publisher)) ? $publisher->krux_id : ''; ?>
            <input type="text" placeholder="Krux ID" class="form-control col-md-7 col-xs-12" name="krux_id" value="{{ old('krux_id') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="comscore_id">ComScore ID <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php //$comscore_id = (old('comscore_id')) ? old('comscore_id') : (isset($publisher)) ? $publisher->comscore_id : ''; ?>
            <input type="text" placeholder="Comscore ID" class="form-control col-md-7 col-xs-12" name="comscore_id" value="{{ old('comscore_id') }}">
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="form-group" id="targeting_main">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="targeting">Targeting <span class="required">*</span></label>
        
			
				<div class="col-md-3 col-sm-3 col-xs-6">
					<input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value="">
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value="">
				</div>
			
        <div class="col-md-2 col-sm-2 col-xs-4">
            <span class="btn btn-primary" id="add_targeting"><i class="fa fa-plus"></i></span>
            <span class="btn btn-primary" id="delete_targeting"><i class="fa fa-minus"></i></span>
        </div>
        <div class="clearfix"></div>
    </div>
<div class="target_main one"></div>

    
    <div class="form-group" id="pagetype_main">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="page_type">Page Types <span class="required">*</span></label>
     	 <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" placeholder="Page Title" class="form-control col-md-7 col-xs-12" name="page_type_title[]" value="">
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
            <input type="text" placeholder="Selector" class="form-control col-md-7 col-xs-12" name="page_type_selector[]" value="">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-4">
            <span class="btn btn-primary" id="add_page_type"><i class="fa fa-plus"></i></span>
            <span class="btn btn-primary" id="delete_page_type"><i class="fa fa-minus"></i></span>
        </div>
        
        <div class="clearfix"></div>
    </div>
<div class="pagetype_main one"></div>
    <br>
    <h2>Please copy/ paste the VICE Digital Tag into the footer of the platform</h2>
    <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" placeholder='<script src="xxxx"></script>' class="form-control col-md-7 col-xs-12" name="vice_digital_tag" value='<script src="xxxx"></script>"'>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <span class="btn btn-primary" id="copy_script">COPY</span>
        </div>
        <span class="control-label text-left col-md-12 col-sm-12 col-xs-12">Current state: VICE Digital Tag has been correctly implemented.</span>
        <div class="clearfix"></div>
    </div>
    
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success">{{ $submitButtonText }}</button>
        </div>
        <div class="clearfix"></div>
    </div>
 