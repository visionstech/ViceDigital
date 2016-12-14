   <h2>Configurate AdSlot</h2>
   <div class="form-group">
       <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="Status">Status</label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <?php $Status = (old('status')) ? old('status') : ((!empty($AdsData)) ? $AdsData[0]['status'] : 'Live');  
        ?>
        <div class="select-wrap">
            <select name="status" class="form-control col-md-7 col-xs-12">
                <option value="Live" <?php echo ($Status =='Live')? "selected":''; ?> >Live</option>
                <option value="Suspended" <?php echo ($Status =='Suspended')? "selected":''; ?>>Suspended</option>
                <option value="Paused" <?php echo ($Status =='Paused')? "selected":''; ?>>Paused</option>
            </select>
            <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
        </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="slot">Slot name<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $slotName = (old('slotname')) ? old('slotname') : ((!empty($AdsData)) ? $AdsData[0]['slotname'] : '');  ?>
           <input type="text" placeholder="Slot name" class="form-control col-md-7 col-xs-12" name="slotname" value="{{ $slotName }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="container">Container<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $container = (old('container')) ? old('container') : ((!empty($AdsData)) ? $AdsData[0]['container'] : '');  ?>
            <input type="text" placeholder="Container" class="form-control col-md-7 col-xs-12" name="container" value="{{ $container }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="positioning">Positioning<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $positioning = (old('positioning')) ? old('positioning') : ((!empty($AdsData)) ? $AdsData[0]['positioning'] : '');  
        ?>
        <div class="select-wrap">
            <select name='positioning' class="form-control col-md-7 col-xs-12">
                <option value="">Select Positioning</option>
                @foreach($positions as $position)
                    <option value="{{ $position['name'] }}" <?php echo ($positioning ==$position['name'])? "selected":''; ?> >{{ $position['name'] }}</option>
                @endforeach
            </select>
            <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
        </div>
        </div>
        <div class="clearfix"></div>
    </div>
	 <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="mobile_sizes">Mobile Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <?php $mobile = (old('mobile')) ? old('mobile') : ((!empty($AdsData)) ? $AdsData[0]['mobile_sizes'] : 'default'); 
          ?>
            <div class="custom-radio">
             <input type="radio"  id="mobileDefault" class="mobile" name="mobile" value="default" <?php echo ($mobile == 'default')?'checked="checked"':'' ?> >
             <label for="mobileDefault"><span></span>Default</label>
            </div>
            <div class="custom-radio">
               <input type="radio"  id="mobileCustom"  class="mobile" name="mobile" value="custom" <?php echo ($mobile != 'default')?'checked="checked"':'' ?> >
              <label for="mobileCustom"><span></span>Custom</label>
            </div>
        </div>
		<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Mobile Sizes" class="form-control col-md-7 col-xs-12 mobile_sizes" name="mobile_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['mobile_sizes'] != 'default'))?$AdsData[0]['mobile_sizes']:'' }}" <?php echo ($mobile=='default')?'readonly="true"':'' ?>>
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="tablet_sizes">Tablet Sizes<span class="required">*</span></label>
	 	<div class="col-md-2 col-sm-2 col-xs-12">
        <?php $tablet = (old('tablet')) ? old('tablet') : ((!empty($AdsData)) ? $AdsData[0]['tablet_sizes'] : 'default'); 
          ?>
            <div class="custom-radio">
                <input type="radio" id="tabletDefault" class="tablet" name="tablet" value="default" <?php echo ($tablet == 'default')?'checked="checked"':'' ?> >
                 <label for="tabletDefault"><span></span>Default</label>
            </div>
            <div class="custom-radio">
               <input type="radio" id="tabletCustom" class="tablet" name="tablet" value="custom" <?php echo ($tablet != 'default')?'checked="checked"':'' ?> >
              <label for="tabletCustom"><span></span>Custom</label>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Tablet Sizes" class="form-control col-md-7 col-xs-12 tablet_sizes" name="tablet_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['tablet_sizes'] != 'default'))?$AdsData[0]['tablet_sizes']:'' }}" <?php echo ($tablet=='default')?'readonly="true"':'' ?> >
        </div>
        <div class="clearfix"></div>
    </div>
 <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="desktop_sizes">Desktop Sizes<span class="required">*</span></label>
        <div class="col-md-2 col-sm-2 col-xs-12">
        <?php $desktop = (old('desktop')) ? old('desktop') : ((!empty($AdsData)) ? $AdsData[0]['desktop_sizes'] : 'default'); 
          ?>

            <div class="custom-radio">
                <input type="radio" id="desktopDefault" class="desktop" name="desktop"  value="default" <?php echo ($desktop=='default')?'checked="checked"':'' ?> >
                 <label for="desktopDefault"><span></span>Default</label>
            </div>
            <div class="custom-radio">
               <input type="radio" id="desktopCustom" class="desktop" name="desktop" value="custom" <?php echo ($desktop!='default')?'checked="checked"':'' ?> >
              <label for="desktopCustom"><span></span>Custom</label>
            </div>
        </div>
	 	<div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" placeholder="Desktop Sizes" <?php echo ($desktop=='default')?'readonly="true"':'' ?> class="form-control col-md-7 col-xs-12 desktop_sizes" name="desktop_sizes" value="{{ ((!empty($AdsData)) && ($AdsData[0]['desktop_sizes'] != 'default'))?$AdsData[0]['desktop_sizes']:'' }}">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group" id="targeting_main">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="targeting">Targeting</label>

            <?php $tagetkey = (old('targeting_key')) ? old('targeting_key.0') : ((!empty($TargetingData)) ? $TargetingData[0]['key'] : '');  ?>
            <div class="col-md-3 col-sm-3 col-xs-4">
                <input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value="{{ $tagetkey }}">
            </div>

            <?php $tagetVal = (old('targeting_value')) ? old('targeting_value.0'): ((!empty($TargetingData)) ? $TargetingData[0]['value'] : '');  ?>
            <div class="col-md-3 col-sm-3 col-xs-4">
                <input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value="{{ $tagetVal }}">
            </div>
            
        <div class="col-md-2 col-sm-2 col-xs-4">
            <span class="btn btn-primary" id="add_targeting"><i class="fa fa-plus"></i></span>
            <span class="btn btn-primary" id="delete_targeting"><i class="fa fa-minus"></i></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="target_main one">
        <?php if(sizeof($TargetingData)>1){
                $target=0;
                foreach($TargetingData as $Targeting){ 
                    if($target>0){
                        $tagetkey = (old('targeting_key')) ? old('targeting_key.'.$target) : ((!empty($TargetingData)) ? $Targeting['key'] : '');
                        $tagetVal = (old('targeting_value')) ? old('targeting_value.'.$target) : ((!empty($TargetingData)) ? $Targeting['value'] : '');
        ?>
            <div class="target_sub"><div class="form-group"><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value="{{ $tagetkey }}"></div><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value="{{ $tagetVal }}"></div></div></div>
        <?php   } $target++;} } ?>
    </div>
    <br>
    <div class="form-group">
       <div class="col-md-6 col-sm-6 col-xs-12 custom-check">
       <?php $lazyload = (old('lazyload')) ? old('lazyload') : ((!empty($AdsData)) ? $AdsData[0]['lazyload'] : '0');
          ?>
            <input type="checkbox" id="lazyload" name="lazyload" value="1" <?php echo ($lazyload==1)?'checked="checked"':'' ?>/>
            <label class="" for="lazyload">Lazy Load</label>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
       <div class="col-md-6 col-sm-6 col-xs-12">
           <h4>Display on page type</h4>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php 
    
    (!empty($AdsData))?($pageTypeArray=unserialize($AdsData[0]['page_type'])):($pageTypeArray=array());

    $HomePage = (old('page_type')) ? ((!empty(old('page_type')) && in_array(1,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(1,$pageTypeArray)) ? 'checked="checked"' : '');
    $ArticalPage = (old('page_type')) ?  ((!empty(old('page_type')) && in_array(2,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(2,$pageTypeArray)) ? 'checked="checked"' : '');
    $VideoPage = (old('page_type')) ?  ((!empty(old('page_type')) && in_array(3,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(3,$pageTypeArray)) ? 'checked="checked"' : '');
    ?>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 custom-check">
            <?php if(count($Pagetypes)>0){ ?>
                @foreach($Pagetypes as $key=>$Pagetype)
                    <?php
                    $CheckedPagetype = (old('page_type')) ? ((!empty(old('page_type')) && in_array(($Pagetype->id) ,old('page_type'))) ? 'checked="checked"' : '') : ((!empty($pageTypeArray) && in_array(($Pagetype->id),$pageTypeArray)) ? 'checked="checked"' : '');
                    ?>    
                    <input type="checkbox" name="page_type[]" value="{{ $Pagetype->id }}" id="{{ $key }}"  {{ $CheckedPagetype }} />
                    <label class="" for="{{ $key }}"> {{ $Pagetype->title }} </label>
                    <br/>
                @endforeach
            <?php } ?>
        </div>       
        <div class="clearfix"></div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success">{{ $submitButtonText }}</button>
        </div>
        <div class="clearfix"></div>
    </div> 