<!--Thông tin khách hàng-->
<div class="portlet box blue mtop0">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><b>Thông tin Xe & Khách hàng</b></div>			
		</div>
		<div class="tools"> <button style="margin-top:5px;" type="button" class="close" data-dismiss="modal">&times;</button></div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
        	<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('bien-so-xe');?> (<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="input_car_number"  id="input_car_number" class="form-input form-control " 
							value="<?=$finds->car_number;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ten-cavet');?> (<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="input_car_cavet_name"  id="input_car_cavet_name" class="form-input form-control " 
							value="<?=$finds->car_cavet_name;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ten-chu-xe');?> (<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="input_customer_name"  id="input_customer_name" class="form-input form-control " 
							value="<?=$finds->customer_name;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('dien-thoai-chu-xe');?> (<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="input_car_customer_phone"  id="input_customer_phone" class="form-input form-control " 
							value="<?=$finds->car_cavet_name;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ten-nguoi-gt');?></label>
						<div class="col-md-8">
							<input type="text" name="input_presenter_name"  id="input_presenter_name" class="form-input form-control " 
							value="<?=$finds->presenter_name;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('dien-thoai-nguoi-gt');?></label>
						<div class="col-md-8">
							<input type="text" name="input_presenter_phone"  id="input_presenter_phone" class="form-input form-control " 
							value="<?=$finds->presenter_phone;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('hang-xe');?> </label>
						<div class="col-md-8">
							<select id="input_manufacturer_id" name="input_manufacturer_id" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-hang-xe')?>">
								<option value=""></option>
								<?php foreach($manufacturers as $item){?>
									<option <?php if($item->id == $finds->manufacturer_id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('loai-xe');?> </label>
						<div class="col-md-8">
							<select id="input_cartype_id" name="input_cartype_id" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-loai-xe')?>">
								<option value=""></option>
								<?php foreach($cartypes as $item){?>
									<option <?php if($item->id == $finds->cartype_id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('trong-tai');?> </label>
						<div class="col-md-8">
							<select id="input_vehicleload_id" name="input_vehicleload_id" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-trong-tai')?>">
								<option value=""></option>
								<?php foreach($vehicleloads as $item){?>
									<option <?php if($item->id == $finds->vehicleload_id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
		</div>
	</div>		
</div>
<!--S Thông tin khách hàng-->
<!--Thông tin hộp đen-->
<div class="portlet box blue mtop10">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><b>Hộp đen</b></div>			
		</div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
        	<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('serial');?> (<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="input_box_serial"  id="input_box_serial" class="form-input form-control " 
							value="<?=$finds->box_serial;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('Web');?></label>
						<div class="col-md-8">
							<input type="text" name="input_box_web"  id="input_box_web" class="form-input form-control " 
							value="<?=$finds->box_web;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('username');?></label>
						<div class="col-md-8">
							<input type="text" name="input_box_username"  id="input_box_username" class="form-input form-control " 
							value="<?=$finds->box_username;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('password');?></label>
						<div class="col-md-8">
							<input type="text" name="input_box_password"  id="input_box_password" class="form-input form-control " 
							value="<?=$finds->box_password;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('bao-hanh');?></label>
						<div class="col-md-8">
							<?php
								$box_guarantee = '';
								if(!empty($finds->box_guarantee) && $finds->box_guarantee != '0000-00-00'){
									$box_guarantee = date(cfdate(),strtotime($finds->box_guarantee));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_box_guarantee" placeholder="<?=cfdateHtml();?>" name="input_box_guarantee" class="form-input form-control" value="<?=$box_guarantee;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
						<div class="col-md-8">
							<input type="text" name="input_box_description"  id="input_box_description" class="form-input form-control " 
							value="<?=$finds->box_description;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>
<!--S Thông tin hộp đen-->
<!--Thông tin hộp đen-->
<div class="portlet box blue mtop10">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><b>Đăng kiểm</b></div>			
		</div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
        	<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('tram-dang-kiem');?> </label>
						<div class="col-md-8">
							<select id="input_registrationstation_id" name="input_registrationstation_id" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-tram-dang-kiem')?>">
								<option value=""></option>
								<?php foreach($registrationstations as $item){?>
									<option <?php if($item->id == $finds->registrationstation_id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ngay-dang-kiem');?></label>
						<div class="col-md-8">
							<?php
								$registrationstation_date = '';
								if(!empty($finds->registrationstation_date) && $finds->registrationstation_date != '0000-00-00'){
									$registrationstation_date = date(cfdate(),strtotime($finds->registrationstation_date));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_registrationstation_date" placeholder="<?=cfdateHtml();?>" name="input_registrationstation_date" class="form-input form-control" value="<?=$registrationstation_date;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ngay-het-han');?></label>
						<div class="col-md-8">
							<?php
								$registrationstation_expires = '';
								if(!empty($finds->registrationstation_expires) && $finds->registrationstation_expires != '0000-00-00'){
									$registrationstation_expires = date(cfdate(),strtotime($finds->registrationstation_expires));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_registrationstation_expires" placeholder="<?=cfdateHtml();?>" name="input_registrationstation_expires" class="form-input form-control" value="<?=$registrationstation_expires;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
		</div>
	</div>		
</div>
<!--S Thông tin hộp đen-->
<!--Thông tin Bảo hiểm-->
<div class="portlet box blue mtop10">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><b>Bảo hiểm</b></div>			
		</div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
        	<!--S Row-->
			<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('hang-bao-hiem');?> </label>
						<div class="col-md-8">
							<select id="input_insurance_id" name="input_insurance_id" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-hang-bao-hiem')?>">
								<option value=""></option>
								<?php foreach($insurances as $item){?>
									<option <?php if($item->id == $finds->insurance_id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ngay-het-han');?></label>
						<div class="col-md-8">
							<?php
								$insurance_expires = '';
								if(!empty($finds->insurance_expires) && $finds->insurance_expires != '0000-00-00'){
									$insurance_expires = date(cfdate(),strtotime($finds->insurance_expires));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_insurance_expires" placeholder="<?=cfdateHtml();?>" name="input_insurance_expires" class="form-input form-control" value="<?=$insurance_expires;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
		</div>
	</div>		
</div>
<!--S Thông tin Bảo hiểm-->
<!--Thông tin Thanh toán-->
<div class="portlet box blue mtop10">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><b>Thanh toán</b></div>			
		</div>
		<div class="tools"></div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
			<!--S Row-->
        	<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('tong-tien');?></label>
						<div class="col-md-8">
							<input type="text" name="input_pay_total"  id="input_pay_total" class="fm-number form-input form-control " 
							value="<?=$finds->pay_total;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('da-thanh-toan');?></label>
						<div class="col-md-8">
							<input type="text" name="input_pay_advance"  id="input_pay_advance" class="fm-number form-input form-control " 
							value="<?=$finds->pay_advance;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
        	<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('con-lai');?></label>
						<div class="col-md-8">
							<input type="text" id="conlai"  class="fm-number form-control" 
							value="<?=($finds->pay_total - $finds->pay_advance);?>" placeholder=""
							/>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ngay-thanh-toan');?></label>
						<div class="col-md-8">
							<?php
								$pay_start_date =  gmdate(cfdate(), time() + 7 * 3600);;
								if(!empty($finds->pay_start_date) && $finds->pay_start_date != '0000-00-00'){
									$pay_start_date = date(cfdate(),strtotime($finds->pay_start_date));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_pay_start_date" placeholder="<?=cfdateHtml();?>" name="input_pay_start_date" class="form-input form-control" value="<?=$pay_start_date;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--S Row-->
        	<div class="row mtop10">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('han-thanh-toan');?></label>
						<div class="col-md-8">
							<?php
								$pay_expires_date = '';
								if(!empty($finds->pay_expires_date) && $finds->pay_expires_date != '0000-00-00'){
									$pay_expires_date = date(cfdate(),strtotime($finds->pay_expires_date));
								}
							?>
							<div class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
								<input type="text" id="input_pay_expires_date" placeholder="<?=cfdateHtml();?>" name="input_pay_expires_date" class="form-input form-control" value="<?=$pay_expires_date;?>">
								<span class="input-group-btn ">
									<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
						<div class="col-md-8">
							<input type="text" id="input_pay_description" name="input_pay_description"  class="form-control" 
							value="<?=$finds->pay_description;?>" placeholder=""
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>
<!--S Thông tin Thanh toán-->
<script>
	$(function(){
		handleSelect2();
		initForm();
		
	});
	function initForm(){
		//$('#input_typecar_name').select();
		formatNumberKeyUp('fm-number');
		ComponentsPickers.init();
	}
</script>
