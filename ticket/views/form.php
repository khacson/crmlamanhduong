<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tieu-de');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_ticket_name"  id="input_ticket_name" class="form-input form-control " 
				value="<?=$finds->ticket_name;?>" placeholder=""
				/>
				<input type="hidden" name="input_ticket_code"  id="input_ticket_code" class="form-input" 
				value="<?=$finds->ticket_code;?>" placeholder=""/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('do-uu-tien');?> </label>
			<div class="col-md-8">
				<select id="input_priorityid" name="input_priorityid" class="combos-input select2me form-control" data-placeholder="<?=getLanguage('chon-do-uu-tien')?>">
					<option value=""></option>
					<?php foreach($prioritys as $item){?>
						<option <?php if($item->id == $finds->priorityid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->priority_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('noi-dung-yeu-cau');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<textarea name="input_ticket_description"  id="input_ticket_description" class="form-input form-control " ><?=$finds->ticket_description;?></textarea>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nguoi-lien-he');?></label>
			<div class="col-md-8">
				<input type="text" name="input_ticket_contat_name"  id="input_ticket_contat_name" class="form-input form-control " 
				value="<?=$finds->ticket_contat_name;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
			<div class="col-md-8">
				<input type="text" name="input_ticket_contact_phone"  id="input_ticket_contact_phone" class="form-input form-control " 
				value="<?=$finds->ticket_contact_phone;?>" placeholder=""
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('hinh-anh')?></label>
			<div class="col-md-8">
				<div class="col-md-3" style="padding:0px !important;" >
					<ul style="margin:0px;" class="button-group">
						<li class="" onclick ="javascript:document.getElementById('ticket_image').click();"><button type="button" class="btnone"><?=getLanguage('chon-file')?></button></li>
					</ul>
					<input class="tab-event" style='display:none;' accept="*" id ="ticket_image" type="file" name="userfile" multiple>
				</div>
				<div class="col-md-9" >
					 <div class="row">
						 <span id="show_ticket_image">
							<?php if(!empty($finds->ticket_image)){
								$arr_car_images = explode(';',$finds->ticket_image);
								foreach($arr_car_images as $key=>$val){
									if(empty($val)){
										continue;
									}
								?>
								<div class="oneimg newimg" name="<?=$val;?>"><img height="40" width="50" src="<?=base_url();?>files/ticket/<?=$val;?>" class="imgupload" /><div class="rmoneimg" id="<?=$finds->id;?>" file="<?=$val;?>"><i class="fa fa-times" aria-hidden="true"></i></div></div>
							<?php }}?>
						 </span> 
					 </div>
				</div>
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
</style>
<script>
	var listimg = {};
	var storedOldNameFiles = [];
	var storedFiles = [];
	var replyResult = parseInt('<?=$finds->reply_result;?>'); 
	$(function(){
		initForm();
		handleSelect2();
		ticket_image_picture();
	});
	function initForm(){
		$('#input_ticket_name').select();
		if(replyResult != 0){//Nếu ticket đã phản hồi thì không được sửa
			$('#actionSave').hide();
		}
		else{
			$('#actionSave').show();
		}
	}
	function ticket_image_picture() { 
        $('#ticket_image').change(function (evt) { 
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                /*if (!f.type.match('image.*')){
                    continue;
				}*/
                var reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        listimg[theFile.name] = e.target.result;
                        $("#noimg").css("display", "none");
                        $("#show_ticket_image").append('<div class="oneimg newimg" name="' + theFile.name + '"><img height="40" width="50" src="' + e.target.result + '" class="imgupload" /><div class="rmoneimg"><i class="fa fa-times" aria-hidden="true"></i></div></div>');
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        });
        $(document.body).on("click", ".rmoneimg", function () {
            // lay index cua phan tu moi remove
            var index = $(".newimg").index($(this).parent());
            // ghi lai ten nhung file bi xoa de xoa file trong thu muc
            if ($(this).parent().hasClass("oldimg")) {
                storedOldNameFiles.push($(this).parent().attr("name"));
            }
            // remove phan tu vua click
            $(this).parent().remove();
            // xoa file bi remove ra khoi mang        
            storedFiles.splice(index, 1);
            // kiem tra neu khong co img nao thi hien no image
            if ($(".oneimg").length === 0) {
                $("#noimg").css("display", "");
            }
			var id = $(this).attr('id');
			var file = $(this).attr('file'); 
			deleteImg(id,file)
        });
    }
	function deleteImg(id,file){
		$.ajax({
			url : controller + 'deleteImg',
			type: 'POST',
			async: false,
			data:{id:id,file:file},  
			success:function(datas){}
		});
	}
</script>
