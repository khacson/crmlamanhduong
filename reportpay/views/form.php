<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('khach-hang');?></label>
			<div class="col-md-8" >
				<select readonly  class="select2me form-control" data-placeholder="<?=getLanguage('chon-nha-cung-cap')?>">
					<option value=""></option>
					<?php foreach ($customers as $item) { ?>
						<option <?php if($finds->customerid == $item->id){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->customer_name;?> - <?=$item->phone;?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tong-tien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" id="input_ticket_price" name="input_ticket_price" class="form-input form-control fm-number" value="<?=number_format($finds->ticket_price);?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('han-thanh-toan');?></label>
			<div class="col-md-8">
				<?php
					$ticket_date_expired = '';
					if(!empty($finds->ticket_date_expired) && $finds->ticket_date_expired != '0000-00-00'){
						$ticket_date_expired = date(cfdate(),strtotime($finds->ticket_date_expired));
					}
				?>
				 <div class="col-md-8 input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
					<input type="text" id="input_ticket_date_expired" placeholder="<?=cfdateHtml();?>" name="input_ticket_date_expired" class="form-input form-control" value="<?=$ticket_date_expired;?>" >
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
				<input type="text" name="input_ticket_description_pay" id="input_ticket_description_pay" placeholder="" class="form-input form-control " value="<?=$finds->ticket_description_pay;?>" />
			</div>
		</div>
	</div>
</div>
<div class="row mtop10"></div>
<script>
	$(function(){
		handleSelect2();
		ComponentsPickers.init();
		formatNumberKeyUp('fm-number');
		initForm();
	});
	function initForm(){
	}
</script>
