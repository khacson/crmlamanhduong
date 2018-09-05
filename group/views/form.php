<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nhom-quyen')?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="groupname" id="groupname" class="form-input form-control " maxlength="100" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai-nhom')?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<select name="input_grouptype"  class="combos-input select2me form-control" id="input_grouptype" data-placeholder="<?=getLanguage('chon-nhom-quyen')?>">
					<option value=""></option>
					<?php if(empty($companyid)){?>
					<option <?php if($finds->grouptype == 1){?>  selected <?php }?> value="1"><?=getLanguage('root');?></option>
					<?php }?>
					<option <?php if($finds->grouptype == 2){?>  selected <?php }?> value="2"><?=getLanguage('admin');?></option>
					<option <?php if($finds->grouptype == 3){?>  selected <?php }?> value="3"><?=getLanguage('nhan-vien');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10" >
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('khach-hang');?></label>
			<div class="col-md-8">
				<select name="input_companyid" class="combos-input select2me form-control" id="input_companyid" data-placeholder="<?=getLanguage('chon-khach-hang')?>">
					<?php if(count($companys) > 1){?>
					<option value=""></option>
					<?php }?>
					<?php foreach($customers as $item){
						?>
					<option <?php if($finds->companyid == $item->id){?>  selected <?php }?> value="<?=$item->id;?>"><?=$item->customer_name;?> - <?=$item->phone;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
</div>	
<script type="text/javascript">
	$(function(){	
		handleSelect2();
		initForm();
	});
	function initForm(){
		
	}
</script>