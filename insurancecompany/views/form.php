<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-hang-bh');?></label>
			<div class="col-md-8">
				<input type="text" name="input_insurance_code"  id="input_insurance_code" class="form-input form-control tab-event" 
				value="<?=$finds->insurance_code;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-hang-bh');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_insurance_name"  id="input_insurance_name" class="form-input form-control tab-event" 
				value="<?=$finds->insurance_name;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		initForm();
	});
	function initForm(){
		$('#input_insurance_name').select();
	}
</script>
