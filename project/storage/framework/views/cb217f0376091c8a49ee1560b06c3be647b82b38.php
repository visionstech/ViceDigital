    
    <h2>Configurate AdSlot</h2>
    <input type="hidden" name="publisher_id" value="<?php (isset($publisher)) ? $publisher->id : ''; ?>">
	
	<div class="form-group">
       <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Status</label>
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
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="slot">Slot name<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
           
            <input type="text" placeholder="Slot name" class="form-control col-md-7 col-xs-12" name="slotname" value="<?php echo e(old('slotname')); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="container">Container<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          
            <input type="text" placeholder="Container" class="form-control col-md-7 col-xs-12" name="container" value="<?php echo e(old('container')); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="positioning">Positioning<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name='positioning' class="form-control col-md-7 col-xs-12">
                <option value="">Select Positioning</option>
                <?php foreach($positions as $position): ?>
                    <option value="<?php echo e($position['name']); ?>"><?php echo e($position['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
	 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="mobile_sizes">Mobile Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
			<input type="radio"  class="mobile" name="mobile" value="default" checked="checked">Default
			<input type="radio"  class="mobile" name="mobile" value="custom">Custom
        </div>
		<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Mobile Sizes" class="form-control col-md-7 col-xs-12 mobile_sizes" name="mobile_sizes" value="">
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="tablet_sizes">Tablet Sizes<span class="required">*</span></label>
	 	<div class="col-md-2 col-sm-2 col-xs-12">
			<input type="radio"  class="tablet" name="tablet" value="default" checked="checked">Default
			<input type="radio"  class="tablet" name="tablet" value="custom">Custom
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            
            <input type="text" placeholder="Tablet Sizes" class="form-control col-md-7 col-xs-12 tablet_sizes" name="tablet_sizes" value="">
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="desktop_sizes">Desktop Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
			<input type="radio"  class="desktop" name="desktop"  value="default" checked="checked">Default
			<input type="radio"  class="desktop" name="desktop" value="custom">Custom
        </div>
	 	<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Desktop Sizes" class="form-control col-md-7 col-xs-12 desktop_sizes" name="desktop_sizes" value="">
        </div>
        <div class="clearfix"></div>
    </div>
    
    <br>
    
    <div class="form-group">
       <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="lazyload" value="1"/>
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Lazy Load</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
       <div class="col-md-6 col-sm-6 col-xs-12">
           <h4>Display on page type<span class="required">*</span></h4>
        </div>
        <div class="clearfix"></div>
    </div>    
    <div class="form-group">
       <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="1"/>
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Home page</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="2"/>
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Article page</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="3"/>
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Video page</label>
        <div class="clearfix"></div>
    </div>


<div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success"><?php echo e($submitButtonText); ?></button>
        </div>
        <div class="clearfix"></div>
    </div>
 