<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-tram');?></label>
			<div class="col-md-8">
				<input type="text" name="input_registrationstation_code"  id="input_registrationstation_code" class="form-input form-control tab-event" 
				value="<?=$finds->registrationstation_code;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-tram');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_registrationstation_name"  id="input_registrationstation_name" class="form-input form-control tab-event" 
				value="<?=$finds->registrationstation_name;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
			<div class="col-md-8">
				<input type="text" name="input_registrationstation_address"  id="input_registrationstation_address" class="form-input form-control tab-event" 
				value="<?=$finds->registrationstation_address;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
			<div class="col-md-8">
				<input type="text" name="input_registrationstation_phone"  id="input_registrationstation_phone" class="form-input form-control tab-event" 
				value="<?=$finds->registrationstation_phone;?>" placeholder=""
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
		$('#input_registrationstation_name').select();
	}
</script>
