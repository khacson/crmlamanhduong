<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 100px;}
	table col.c4 { width: 180px;}
	table col.c5 { width: 110px;}
	table col.c6 { width: 250px;}
	table col.c7 { width: 130px;}
	table col.c8 { width: 120px;}
	table col.c9 { width: 120px;}
	table col.c10 { width: 120px;}
	table col.c11 { width: 120px;}
	table col.c12 { width: 180px;}
	table col.c13 { width: 130px;}
	table col.c14 { width: 120px;}
	table col.c15 { width: 150px;}
	table col.c16 { width: 250px;}
	table col.c17 { width: 100px;}
	table col.c18 { width: auto;}
	.col-md-4{ white-space: nowrap !important;}
</style>
<script type="text/javascript" src="<?=url_tmpl();?>fancybox/source/jquery.fancybox.pack.js"></script>  
<link href="<?=url_tmpl();?>fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<link type="text/css" href="<?=url_tmpl();?>css/daterangepicker.css"  rel="stylesheet">	
<script type="text/javascript" src="<?=url_tmpl();?>js/moment.js"></script>
<script type="text/javascript" src="<?=url_tmpl();?>js/daterangepicker.js"></script>

<div class="row">
	<?=$this->load->inc('breadcrumb');?>
</div>
<div class="portlet box blue mtop0">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3"><i class="fa fa-bars"></i> <?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('ticket');?></div>			
		</div>
		<div class="tools">
			<ul class="button-group pull-right" style="margin-top:-5px; margin-bottom:5px;">
				<li id="search">
					<button class="button">
						<i class="fa fa-search"></i>
						<?=getLanguage('tim-kiem')?>
					</button>
				</li>
				<li id="refresh" >
					<button class="button">
						<i class="fa fa-refresh"></i>
						<?=getLanguage('lam-moi')?>
					</button>
				</li>
				<?php if(isset($permission['add'])){?>
				<li id="save" data-toggle="modal" data-target="#myModalFrom">
					<button class="button">
						<i class="fa fa-plus"></i>
						<?=getLanguage('tao-ticket')?>
					</button>
				</li>
				<?php } ?>
				<?php if(isset($permission['edit'])){?>
				<li id="edit" data-toggle="modal" data-target="#myModalFrom">
					<button class="button">
						<i class="fa fa-save"></i>
						<?=getLanguage('sua')?>
					</button>
				</li>
				<?php } ?>
				<?php if(isset($permission['delete'])){?>
				<li id="delete">
					<button class="button">
						<i class="fa fa-times"></i>
						<?=getLanguage('xoa')?>
					</button>
				</li>
				<?php }?>
				<li id="export" data-toggle="modal" data-target="#myModalFromPay">
					<button class="button">
						<i class="fa fa-file-excel-o"></i>
						<?=getLanguage('export')?>
					</button>
				</li>
			</ul>
		</div>
	</div>
	<div class="portlet-body">
		<div class="portlet-body">
        	<div id="gridview" >
				<table class="resultset" id="grid"></table>
				<!--header-->
				<div id="cHeader">
					<div id="tHeader">    	
						<table id="tbheader" width="100%" cellspacing="0" border="1" >
							<?php for($i=1; $i< 19; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr>							
								<th><input type="checkbox" name="checkAll" id="checkAll" /></th>
								<th><?=getLanguage('stt');?></th>								
								<th id="ord_tk.ticket_code"><?=getLanguage('ma-yeu-cau');?></th>
								<th id="ord_tk.ticket_name"><?=getLanguage('yeu-cau');?></th>
								<th id="ord_tk.priorityid"><?=getLanguage('do-uu-tien');?></th>
								<th id="ord_tk.ticket_description"><?=getLanguage('noi-dung-yeu-cau');?></th>
								<th><?=getLanguage('hinh-anh');?></th>
								<th id="ord_tk.datecreate"><?=getLanguage('ngay-yeu-cau');?></th>
								<th id="ord_tk.usercreate"><?=getLanguage('nguoi-yeu-cau');?></th>
								<th id="ord_tk.ticket_contat_name"><?=getLanguage('nguoi-lien-he');?></th>
								<th id="ord_tk.ticket_contact_phone"><?=getLanguage('dien-thoai');?></th>
								<th id="ord_tk.customerid"><?=getLanguage('cong-ty');?></th>
								<th id="ord_tk.reply_result"><?=getLanguage('trang-thai');?></th>
								<th id="ord_tk.reply_status"><?=getLanguage('tinh-trang');?> Ticket</th>
								<th id="ord_tk.reply_description"><?=getLanguage('ghi-chu');?></th>
								<th><?=getLanguage('phan-hoi-khach-hang')?></th>
								<th></th>
								<th></th>
							</tr>
						</table>
					</div>
				</div>
				<!--end header-->
				<!--body-->
				<div id="data">
					<div id="gridView">
						<table id="tbbody" width="100%" cellspacing="0" border="1">
							<?php for($i=1; $i < 19; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr class="row-search">
								<td></td>
								<td></td>
								<td>
									<input type="text" name="ticket_code" id="ticket_code" class="searchs form-control " />
								</td>
								<td>
									<input type="text" name="ticket_name" id="ticket_name" class="searchs form-control " />
								</td>
								<td>
									<select id="priorityid" name="priorityid" class="combos" data-placeholder="<?=getLanguage('chon-do-uu-tien')?>">
										<?php foreach($prioritys as $item){?>
											<option value="<?=$item->id;?>"><?=$item->priority_name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<input type="text" name="ticket_description" id="ticket_description" class="searchs" />
								</td>
								<td></td>
								<td>
									<div class="col-md-12" data-date-format="dd/mm/yyyy" style="display:inline-flex; padding-left:0; padding-right:25px;">
										<input style="float:left; text-align:center;" placeholder="Chọn ngày" type="text" id="datecreate" placeholder="dd/mm/yyyy" name="datecreate" class="form-control searchs" value="" >
										<span class="input-group-btn" >
											<button class="btn default btn-picker datecreateClick" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td></td>
								<td>
									<input type="text" name="ticket_contat_name" id="ticket_contat_name" class="searchs" />
								</td>
								<td>
									<input type="text" name="ticket_contact_phone" id="ticket_contact_phone" class="searchs" />
								</td>
								<td></td>
								<td>
									<select id="reply_result" name="reply_result" class="combos">
										<?php foreach($statuss as $item){?>
											<option value="<?=$item->id;?>"><?=$item->status_name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<select id="reply_status" name="reply_status" class="combos">
										<option value="1">Mở</option>
										<option value="2">Đóng</option>
									</select>
								</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tbody id="grid-rows"></tbody>
						</table>
					</div>
				</div>
				<!--end body-->				
			</div>
		</div>
		<div class="portlet-body">
			<div class="fleft" id="paging"></div>
        </div>
	</div>		
</div>
<!-- END PORTLET-->
<div class="loading" style="display: none;">
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 9999000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 0%;left:35%;text-align: center; z-index: 9999000;">
		<img src="<?=url_tmpl()?>img/ajax_loader.gif" style="z-index: 2;position: absolute; z-index: 9999000;"/>
	</div>
</div> 
<!--S Modal -->
<div id="myModalFrom" class="modal fade" role="dialog">
  <div class="modal-dialog w500">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalTitleFrom"></h4>
      </div>
      <div id="loadContentFrom" class="modal-body">
      </div>
      <div class="modal-footer">
		 <button id="actionSave" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i>  <?=getLanguage('luu');?></button>
		  <button id="actionSave2" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i>  <?=getLanguage('tra-loi');?></button>
        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!--E Modal -->
<!--S feedback -->
<div id="myModalFromFeedback" class="modal fade" role="dialog">
  <div class="modal-dialog w500">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalTitleFromFeedback"></h4>
      </div>
      <div id="loadContentFromFromFeedback" class="modal-body"></div>
      <div class="modal-footer">
		 <button id="actionSaveFeedback" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i>  <?=getLanguage('luu');?></button>
        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!--E feedback -->
<!-- view Img -->
<div id="viewImg-form" style="display:none;"><div class=""><div id="viewImg-form-gridview" ></div></div></div>
<!-- view Img -->
<input type="hidden" name="id" id="id" />
<script>
	var controller = '<?=base_url().$routes;?>/';
	var csrfHash = '<?=$csrfHash;?>';
	var cpage = 0;
	var search;
	$(function(){
		init();
		refresh();
		$('#search').click(function(){
			$(".loading").show();
			searchList();	
		});
		$('#refresh').click(function(){
			$('.loading').show();
			refresh();
		});
		$('#save').click(function(){
			$('#id').val('');
			loadForm();
		});
		$('#edit').click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning(cldcs);
				return false;
			} 
			loadForm(id);
		});
		$("#delete").click(function(){
			var id = getCheckedId();
			if(id == ''){ return false;}
			confirmDelete(id);
			return false
		});
		$(document).keypress(function(e) {
			 var id = $("#id").val();
			 if (e.which == 13) {
				$(".loading").show();
				searchList();
			 }
		});
		$('#actionSave').click(function(){
			save();
		});	
		$('#actionSave2').click(function(){
			saveAnswer();
		});	
		$('#actionSaveFeedback').click(function(){
			actionSaveFeedback();
		});	
		$('#datecreate').daterangepicker({
			 locale: {
			  format: 'DD/MM/YYYY'
			},
			startDate: '<?=$fromdates;?>',
			endDate: '<?=$todates;?>',
			timePicker: false,
        	timePickerIncrement: 8,
        	showDropdowns: true
			
		});
		$('.datecreateClick').click(function(){
			$('#datecreate').click();
		});
		$('#export').click(function(){
			window.location = controller + 'export?search='+getSearch();
		});
		searchFunction();
	});
	function searchFunction(){
		$("#ticket_code,#ticket_name,#ticket_description").keyup(function() {
			searchList();	
		});
		$('.datecreateClick').click(function(){
			searchList();
		});
	}
	function saveAnswer(){
		var id = $('#id').val(); 
		var func = 'saveAnswer';
		var search = getFormInput();
		var obj = $.evalJSON(search); 
		
		var token = $('#token').val();
		$('.loading').show();
		$.ajax({
			url : controller + func,
			type: 'POST',
			async: false,
			data: {id:id,search:search},
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$("#token").val(obj.csrfHash);
				$('.loading').hide();
				if(obj.status == 0){
					error("Trả lời không thành công."); return false;	
				}
				else{
					success("Trả lời thành công"); 
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				error("Trả lời không thành công."); return false;	
			}
		});
	}
	function loadForm(id){
		$.ajax({
			url : controller + 'form',
			type: 'POST',
			async: false,
			data:{id:id},  
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$('#loadContentFrom').html(obj.content);
				$('#modalTitleFrom').html(obj.title);
				$('#id').html(obj.id);
			}
		});
	}
	function loadFormFeedback(id){
		$.ajax({
			url : controller + 'feedback',
			type: 'POST',
			async: false,
			data:{id:id},  
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$('#modalTitleFromFeedback').html(obj.title);
				$('#loadContentFromFromFeedback').html(obj.content);
				$('#id').html(obj.id);
			}
		});
	}
	function actionSaveFeedback(){
		var id = $('#id').val(); 
		var func = 'saveFeedback';
		var search = getFormInput();
		var obj = $.evalJSON(search); 
		if(obj.customer_reviews == ''){
			warning("Nội dung phản hồi không được trống"); return false;	
		}
		var token = $('#token').val();
		$('.loading').show();
		$.ajax({
			url : controller + func,
			type: 'POST',
			async: false,
			data: {csrf_stock_name:token,search:search , id:id},
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$("#token").val(obj.csrfHash);
				$('.loading').hide();
				if(obj.status == 0){
					error("Phản hồi không thành công"); return false;	
				}
				else{
					success("Phản hồi thành công"); 
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				error("Phản hồi không thành công"); return false;	
			}
		});
	}
	function save(){
		var id = $('#id').val(); 
		var func = 'save';
		if(id != ''){
			func = 'edit';
		}
		var search = getFormInput();
		var obj = $.evalJSON(search); 
		if(obj.ticket_name == ''){
			warning("Tiêu đề không được trống"); return false;	
		}
		if(obj.ticket_description == ''){
			warning("Mô tả không được trống"); return false;	
		}
		var token = $('#token').val();
		$('.loading').show();
		var data = new FormData();
		//ticket_image
		var objectfile = document.getElementById('ticket_image').files;
		var length = objectfile.length; 
		for (var i = 0; i < length; i++) {
			data.append('ticket_image' + i, objectfile[i]);
		}
		data.append('length', length);
		data.append('search', search);
		data.append('id', id);
		$.ajax({
			url : controller + func,
			type: 'POST',
			async: false,
			data: data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$("#token").val(obj.csrfHash);
				$('.loading').hide();
				if(obj.status == 0){
					if(id == ''){
						error(tmktc); return false;	
					}
					else{
						error(sktc); return false;	
					}
				}
				else if(obj.status == -1){
					error(dldtt); return false;		
				}
				else{
					if(id == ''){
						success(tmtc); 
					}
					else{
						success(stc); 
					}
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				if(id == ''){
					error(tmktc); return false;	
				}
				else{
					error(sktc); return false;	
				}
			}
		});
	}
	function init(){
		$('#priorityid').multipleSelect({
			filter: true,
			single: false,
			placeholder: 'Chọn độ ưu tiên',
			onClick: function(view){
				searchList();
			}
		});
		$('#reply_result').multipleSelect({
			filter: true,
			single: false,
			placeholder: 'Chọn trạng thái',
			onClick: function(view){
				searchList();
			}
		});
		$('#reply_status').multipleSelect({
			filter: true,
			single: false,
			placeholder: 'Chọn tình trạng ticket',
			onClick: function(view){
				searchList();
			}
		});
	}
    function funcList(obj){
		$('.edit').each(function(e){
			$(this).click(function(){ 
				
			});
		});	
		$('.edititem').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				loadForm(id);
			});
		});
		$('.deleteitem').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				confirmDelete(id);
				return false
			});
		});
		$('.feedback').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				loadFormFeedback(id);
			});
		});
		$(".viewImg").each(function(e) {
			$(this).click(function() {
				var id = $(this).attr('id');
				viewImg(id);
			});
		});
	}
	function refresh(){
		$('.loading').show();
		$('.searchs').val('');		
		csrfHash = $('#token').val();
		$('select.combos').multipleSelect('uncheckAll');
		search = getSearch();
		getList(cpage,csrfHash);	
	}
	function searchList(){
		search = getSearch();
		csrfHash = $('#token').val();
		getList(0,csrfHash);	
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
