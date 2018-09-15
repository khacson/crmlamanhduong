<script type="text/javascript" src="<?=url_tmpl();?>fancybox/source/jquery.fancybox.pack.js"></script>  
<link href="<?=url_tmpl();?>fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('yeu-cau');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<?=$finds->ticket_name;?>
				<input type="hidden" name="input_ticket_code"  id="input_ticket_code" class="form-input" 
				value="<?=$finds->ticket_code;?>" placeholder=""/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('do-uu-tien');?> </label>
			<div class="col-md-8">
				<b><?=$prioritys->priority_name;?></b>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('noi-dung-yeu-cau');?></label>
			<div class="col-md-8">
				<?=$finds->ticket_description;?>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nguoi-lien-he');?></label>
			<div class="col-md-8">
				<?=$finds->ticket_contat_name;?>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
			<div class="col-md-8">
				<?=$finds->ticket_contact_phone;?>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('hinh-anh')?></label>
			<div class="col-md-8">
				<div class="row">
				 <span id="show_ticket_image">
					<?php if(!empty($finds->ticket_image)){
						$arr_car_images = explode(';',$finds->ticket_image);
						foreach($arr_car_images as $key=>$val){
							if(empty($val)){
								continue;
							}
						?>
						<div  class="viewImg oneimg newimg" id="<?=$val;?>" name="<?=$val;?>"><img height="40" width="50" src="<?=base_url();?>files/ticket/<?=$val;?>" class="imgupload" /></div>
					<?php }}?>
				 </span> 
			 </div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12 mtop10" style="border-top:1px dashed; padding-top:10px !important;">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tinh-trang');?> Ticket</label>
			<div class="col-md-8">
				<select id="input_reply_status" name="input_reply_status" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-tinh-trang')?>">
					<option <?php if(1 == $finds->reply_status){ echo 'selected';}?> value="1"><?=getLanguage('mo');?></option>
					<option <?php if(2 == $finds->reply_status){ echo 'selected';}?> value="2"><?=getLanguage('dong');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('trang-thai');?> </label>
			<div class="col-md-8">
				<select id="input_reply_result" name="input_reply_result" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if(0 == $finds->reply_result){ echo 'selected';}?> value="0"><?=getLanguage('chua-xu-ly');?></option>
					<option <?php if(1 == $finds->reply_result){ echo 'selected';}?> value="1"><?=getLanguage('da-xu-ly');?></option>
					<option <?php if(2 == $finds->reply_result){ echo 'selected';}?> value="2"><?=getLanguage('khong-xu-ly-duoc');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
			<div class="col-md-8">
				<textarea name="input_reply_description"  id="input_reply_description" class="form-input form-control " ><?=$finds->reply_description;?></textarea>
			</div>
		</div>
	</div>
	
</div>
<style>
	.oneimg{
		float: left;
		display: inline-flex;
		text-align: left;
		width: 70px;
	}
	.rmoneimg{
		width: 18px;
		position: relative;
		margin-top: -10px;
		border: 1px solid #333;
		height: 18px;
		padding: 3px;
		border-radius: 50% !important;
		margin-left:-5px;
	}
	.rmoneimg i{
		margin-top: -2px !important;
		float: left;
	}
	.modal-backdrop {
		border: 0 !important;
		outline: none !important;
		z-index: 0 !important;
	}
</style>
<script>
	var listimg = {};
	var storedOldNameFiles = [];
	var storedFiles = [];
	var replyStatus = parseInt('<?=$finds->reply_status;?>'); 
	$(function(){
		initForm();
		handleSelect2();
	});
	function initForm(){
		$('#input_ticket_name').select();
		if(replyStatus == 2){//Nếu ticket đã phản hồi thì không được sửa
			$('#actionSave').hide();
			$('#actionSave2').hide();
		}
		else{
			$('#actionSave').show();
			$('#actionSave2').show();
		}
		$(".viewImg").each(function(e) {
			$(this).click(function() {
				var id = $(this).attr('id');
				viewImg(id);
			});
		});
	}
	function viewImg(url) {
		$.fancybox({
			'width': 600,
			'height': 500,
			'autoSize' : false,
			'hideOnContentClick': true,
			'enableEscapeButton': true,
			'titleShow': true,
			'href': "#viewImg-form",
			'scrolling': 'no',
			'afterShow': function(){
				$('#viewImg-form-gridview').html('<img style="width:600px; height:500px;" src="<?=base_url();?>files/ticket/'+url+'" />');
			}
		});
    }
</script>
