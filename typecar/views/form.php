<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai-xe');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_typecar_name"  id="input_typecar_name" class="form-input form-control tab-event" 
				value="<?=$finds->typecar_name;?>" placeholder=""
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
		$('#input_typecar_name').select();
	}
</script>
