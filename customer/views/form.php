<ul class="nav nav-tabs" style="margin-top:-10px;">
  <li class="active showsave"><a data-toggle="tab" href="#home"><?=$title;?></a></li>
  <li id="loadrawdata" class="hiddensave"><a data-toggle="tab" href="#menu1"><?=getLanguage('nguoi-lien-he');?></a></li>
  <li style="float:right;">
	 <button type="button" style="margin-top:10px;" class="close" data-dismiss="modal">&times;</button>
  </li>
</ul>
<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
		<!--S Content-->
		<div class="row">
			<div class="col-md-6 mtop10">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ma-khach-hang');?></label>
					<div class="col-md-8">
						<input type="text" name="input_customer_code" id="input_customer_code" placeholder=""  maxlength="30" class="form-input  form-control" value="<?=$finds->customer_code;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6 mtop10">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ten-khach-hang');?> (<span class="red">*</span>)</label>
					<div class="col-md-8">
						<input type="text" name="input_customer_name" id="input_customer_name" placeholder=""  maxlength="70" class="form-input form-control" value="<?=$finds->customer_name;?>"  />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('mst');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_taxcode" id="input_taxcode" placeholder="" class="form-input form-control" value="<?=$finds->taxcode;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('email');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_email" id="input_email" placeholder="" class="form-input form-control" value="<?=$finds->email;?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_phone" id="input_phone" placeholder="" class="form-input form-control" value="<?=$finds->phone;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('fax');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_fax" id="input_fax" placeholder="" class="form-input form-control" value="<?=$finds->fax;?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_address" id="input_address" placeholder="" class="form-input form-control" value="<?=$finds->address;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<?php 
						$birthday = '';
						if(!empty($finds->birthday) && $finds->birthday != '0000-00-00'){
							$birthday = date(cfdate(),strtotime($finds->birthday));
						}
					?>
					<label class="control-label col-md-4"><?=getLanguage('sinh-nhat');?></label>
					<div id="input_birthday" class="col-md-8 date date-picker form-input" data-date-format="<?=cfdateHtml();?>" >
						<input type="text" id="birthday" placeholder="<?=cfdateHtml();?>" name="birthday" class="form-control form-input" value="<?=$birthday;?>">
						<span class="input-group-btn ">
							<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('tk-ngan-hang');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_bankcode" id="input_bankcode" placeholder="" class="form-input form-control" value="<?=$finds->bankcode;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ngan-hang');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_bankname" id="input_bankname" placeholder="" class="form-input form-control" value="<?=$finds->bankname;?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('web');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_web" id="input_web" placeholder="" class="form-input form-control" value="<?=$finds->web;?>" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="menu1" class="tab-pane fade">
		<!--S Content-->
		<div class="row mtop10">
			<div class="col-md-6 mtop10">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('nguoi-lien-he');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_contact_name" id="input_contact_name" placeholder="" class="form-input form-control" value="<?=$finds->contact_name;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6 mtop10">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_contact_phone" id="input_contact_phone" placeholder="" class="form-input form-control" value="<?=$finds->contact_phone;?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('email');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_contact_email" id="input_contact_email" placeholder="" class="form-input form-control" value="<?=$finds->contact_email;?>" />
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
					<div class="col-md-8">
						<input type="text"  maxlength="50" name="input_contact_address" id="input_contact_address" placeholder="" class="form-input form-control" value="<?=$finds->contact_address;?>" />
					</div>
				</div>
			</div>
		</div>
		<!--E Content-->
	</div>
</div>
<script>
	$(function(){
		handleSelect2();
		initForm();
		ComponentsPickers.init();
	});
	function initForm(){
		$('#input_customer_code').select();
	}
</script>
