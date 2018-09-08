<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nha-cung-cap');?> (<span class="red">*</span>)</label>
			<div class="col-md-8" >
				<select readonly  class="select2me form-control" data-placeholder="<?=getLanguage('chon-nha-cung-cap')?>">
					<option value=""></option>
					<?php foreach ($suppliers as $item) { ?>
						<option <?php if($finds->supplierid == $item->id){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->supplier_name;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('cong-no');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text"  class="form-control fm-number" value="<?=number_format($finds->amount_debt);?>" readonly />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('han-thanh-toan');?></label>
			<div class="col-md-8">
				<?php
					$expirationdate = '';
					if(!empty($finds->expirationdate) && $finds->expirationdate != '0000-00-00'){
						$expirationdate = date(cfdate(),strtotime($finds->expirationdate));
					}
				?>
				 <div class="col-md-8 input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
					<input type="text" id="input_expirationdate" placeholder="<?=cfdateHtml();?>" name="input_expirationdate" class="form-input form-control" value="<?=$expirationdate;?>" >
					<span class="input-group-btn ">
						<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
					</span>
				</div>
			 </div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
			<div class="col-md-8">
				<input type="text" name="input_description" id="input_description" placeholder="" class="form-input form-control " value="<?=$finds->description;?>" />
			</div>
		</div>
	</div>
</div>
<div class="row mtop10"></div>

<script>
	$(function(){
		handleSelect2();
		ComponentsPickers.init();
		initForm();
	});
	function initForm(){
	}
</script>
