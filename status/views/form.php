<div class="row">
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('trang-thai');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_status_name"  id="input_status_name" class="form-input form-control tab-event" 
				value="<?=$finds->status_name;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('mau-chu');?></label>
			<div class="col-md-8">
				<input type="text" name="input_color"  id="input_color" class="form-input form-control tab-event" 
				value="<?=$finds->color;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('hinh-nen');?></label>
			<div class="col-md-8">
				<input type="text" name="input_background"  id="input_background" class="form-input form-control tab-event" 
				value="<?=$finds->background;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		handleSelect2();
		initForm();
	});
	function initForm(){
		$('#input_status_name').select();
	}
</script>
