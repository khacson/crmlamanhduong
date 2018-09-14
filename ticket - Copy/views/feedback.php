<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tieu-de');?></label>
			<div class="col-md-8">
				<?=$finds->ticket_name;?>
				<input type="hidden" name="input_id"  id="input_id" class="form-input" 
				value="<?=$finds->id;?>" />
				<input type="hidden" name="input_ticket_code"  id="input_ticket_code" class="form-input" 
				value="<?=$finds->ticket_code;?>" placeholder=""/>
				<input type="hidden" name="input_customerid"  id="input_customerid" class="form-input" 
				value="<?=$finds->customerid;?>" placeholder=""/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('trang-thai');?> </label>
			<div class="col-md-8">
				<select id="input_customer_reviews_status" name="input_customer_reviews_status" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-trang-thai');?>">
					<option <?php if(1 == $finds->customer_reviews_status){ echo 'selected';}?> value="1"><?=getLanguage('hai-long');?></option>
					<option <?php if(2 == $finds->customer_reviews_status){ echo 'selected';}?> value="2"><?=getLanguage('chua-hai-long');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('noi-dung-phan-hoi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<textarea name="input_customer_reviews"  id="input_customer_reviews" class="form-input form-control " ><?=$finds->customer_reviews;?></textarea>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		initForm();
		handleSelect2();
	});
	function initForm(){
		//$('#input_ticket_name').select();
	}
</script>
