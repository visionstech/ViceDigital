   <h2>Configurate AdSlot</h2>
   <div class="form-group">
       <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Status</label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <?php $Status = (old('status')) ? old('status') : ((!empty($AdsData)) ? $AdsData[0]['status'] : 'Live');  
        ?>
        <select name="status" class="form-control col-md-7 col-xs-12">
            <option value="Live" <?php echo ($Status =='Live')? "selected":''; ?> >Live</option>
            <option value="Suspended" <?php echo ($Status =='Suspended')? "selected":''; ?>>Suspended</option>
            <option value="Paused" <?php echo ($Status =='Paused')? "selected":''; ?>>Paused</option>
        </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="slot">Slot name<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $slotName = (old('slotname')) ? old('slotname') : ((!empty($AdsData)) ? $AdsData[0]['slotname'] : '');  ?>
           <input type="text" placeholder="Slot name" class="form-control col-md-7 col-xs-12" name="slotname" value="{{ $slotName }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="container">Container<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $container = (old('container')) ? old('container') : ((!empty($AdsData)) ? $AdsData[0]['container'] : '');  ?>
            <input type="text" placeholder="Container" class="form-control col-md-7 col-xs-12" name="container" value="{{ $container }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="positioning">Positioning<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $positioning = (old('positioning')) ? old('positioning') : ((!empty($AdsData)) ? $AdsData[0]['positioning'] : '');  
        ?>
            <select name='positioning' class="form-control col-md-7 col-xs-12">
                <option value="">Select Positioning</option>
                @foreach($positions as $position)
                    <option value="{{ $position['name'] }}" <?php echo ($positioning ==$position['name'])? "selected":''; ?> >{{ $position['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
	 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="mobile_sizes">Mobile Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <?php $mobile = (old('mobile')) ? old('mobile') : ((!empty($AdsData)) ? $AdsData[0]['mobile_sizes'] : 'default'); 
          ?>
			<input type="radio"  class="mobile" name="mobile" value="default" <?php echo ($mobile == 'default')?'checked="checked"':'' ?> >Default
			<input type="radio"  class="mobile" name="mobile" value="custom" <?php echo ($mobile != 'default')?'checked="checked"':'' ?> >Custom
        </div>
		<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Mobile Sizes" class="form-control col-md-7 col-xs-12 mobile_sizes" name="mobile_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['mobile_sizes'] != 'default'))?$AdsData[0]['mobile_sizes']:'' }}" <?php echo ($mobile=='default')?'readonly="true"':'' ?>>
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="tablet_sizes">Tablet Sizes<span class="required">*</span></label>
	 	<div class="col-md-2 col-sm-2 col-xs-12">
        <?php $tablet = (old('tablet')) ? old('tablet') : ((!empty($AdsData)) ? $AdsData[0]['tablet_sizes'] : 'default'); 
          ?>
			<input type="radio"  class="tablet" name="tablet" value="default" <?php echo ($tablet == 'default')?'checked="checked"':'' ?> >Default
			<input type="radio"  class="tablet" name="tablet" value="custom" <?php echo ($tablet != 'default')?'checked="checked"':'' ?> >Custom
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Tablet Sizes" class="form-control col-md-7 col-xs-12 tablet_sizes" name="tablet_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['tablet_sizes'] != 'default'))?$AdsData[0]['tablet_sizes']:'' }}" <?php echo ($tablet=='default')?'readonly="true"':'' ?> >
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="desktop_sizes">Desktop Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <?php $desktop = (old('desktop')) ? old('desktop') : ((!empty($AdsData)) ? $AdsData[0]['desktop_sizes'] : 'default'); 
          ?>
			<input type="radio"  class="desktop" name="desktop"  value="default" <?php echo ($desktop=='default')?'checked="checked"':'' ?> >Default
			<input type="radio"  class="desktop" name="desktop" value="custom" <?php echo ($desktop!='default')?'checked="checked"':'' ?> >Custom
        </div>
	 	<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Desktop Sizes" <?php echo ($desktop=='default')?'readonly="true"':'' ?> class="form-control col-md-7 col-xs-12 desktop_sizes" name="desktop_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['desktop_sizes'] != 'default'))?$AdsData[0]['desktop_sizes']:'' }}">
        </div>
        <div class="clearfix"></div>
    </div>
    
    <br>
    
    <div class="form-group">
       <div class="col-md-1 col-sm-1 col-xs-12">
       <?php $lazyload = (old('lazyload')) ? old('lazyload') : ((!empty($AdsData)) ? $AdsData[0]['lazyload'] : '0');
          ?>
            <input type="checkbox" name="lazyload" value="1" <?php echo ($lazyload==1)?'checked="checked"':'' ?>/>
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Lazy Load</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
       <div class="col-md-6 col-sm-6 col-xs-12">
           <h4>Display on page type</h4>
        </div>
        <div class="clearfix"></div>
    </div>    
    <div class="form-group">
    <?php 
    
    (!empty($AdsData))?($pageTypeArray=unserialize($AdsData[0]['page_type'])):($pageTypeArray=array());

    $HomePage = (old('page_type')) ? ((!empty(old('page_type')) && in_array(1,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(1,$pageTypeArray)) ? 'checked="checked"' : '');
    $ArticalPage = (old('page_type')) ?  ((!empty(old('page_type')) && in_array(2,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(2,$pageTypeArray)) ? 'checked="checked"' : '');
    $VideoPage = (old('page_type')) ?  ((!empty(old('page_type')) && in_array(3,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(3,$pageTypeArray)) ? 'checked="checked"' : '');
    ?>
       <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="1"  <?php echo $HomePage; ?> />
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Home page</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="2" <?php echo $ArticalPage; ?> />
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Article page</label>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <div class="col-md-1 col-sm-1 col-xs-12">
            <input type="checkbox" name="page_type[]" value="3" <?php echo $VideoPage; ?> />
        </div><label class="control-label text-left col-md-2 col-sm-2 col-xs-12" for="Status">Video page</label>
        <div class="clearfix"></div>
    </div>


<div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success">{{ $submitButtonText }}</button>
        </div>
        <div class="clearfix"></div>
    </div>
 