<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 180px;}
	table col.c4 { width: 110px;}
	table col.c5 { width: 100px;}
	table col.c6 { width: 120px;}
	table col.c7 { width: 110px;}
	table col.c8 { width: 120px;}
	table col.c9 { width: 250px;}
	table col.c10 { width: auto;}
	.col-md-4{ white-space: nowrap !important;}
</style>

<!-- BEGIN PORTLET-->
<div class="row">
	<?=$this->load->inc('breadcrumb');?>
</div>
<div class="portlet box blue mtop0">
	<div class="portlet-title">
		<div class="caption caption2">
			<div class="brc mtop3"><i class="fa fa-bars"></i> <?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('thanh-toan');?></div>			
		</div>
		<div class="tools" style="margin-top:-1px;">
			<ul class="button-group pull-right">
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
				<?php if(isset($permission['edit'])){?>
				<li id="edit" data-toggle="modal" data-target="#myModalFrom">
					<button class="button">
						<i class="fa fa-save"></i>
						<?=getLanguage('cap-nhat-so-tien')?>
					</button>
				</li>
				<?php } ?>
				<?php if(isset($permission['pay'])){?>
				<li id="pay" data-toggle="modal" data-target="#myModalFromPay">
					<button class="button">
						<i class="fa fa-usd"></i>
						<?=getLanguage('thanh-toan')?>
					</button>
				</li>
				<?php } ?>
				<li id="export" data-toggle="modal" data-target="#myModalFromPay">
					<button class="button">
						<i class="fa fa-file-excel-o"></i>
						<?=getLanguage('export')?>
					</button>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<div class="portlet-body mtop10">
		<div class="portlet-body">
        	<div id="gridview" >
				<table class="resultset" id="grid"></table>
				<!--header-->
				<div id="cHeader">
					<div id="tHeader">    	
						<table id="tbheader" width="100%" cellspacing="0" border="1" >
							<?php for($i=1; $i< 11; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr>							
								<th><input type="checkbox" name="checkAll" id="checkAll" /></th>
								<th><?=getLanguage('stt')?></th>
								<th id="ord_tk.customerid "><?=getLanguage('khach-hang')?></th>
								<th id="ord_tk.ticket_code"><?=getLanguage('ticket')?></th>
								<th id="ord_tk.ticket_price"><?=getLanguage('tong-tien')?></th>
								<th><?=getLanguage('da-thanh-toan')?></th>
								<th><?=getLanguage('con-no')?></th>
								<th id="ord_tk.ticket_date_expired"><?=getLanguage('han-thanh-toan')?></th>
								<th id="ord_tk.ticket_description_pay"><?=getLanguage('ghi-chu')?></th>
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
							<?php for($i=1; $i < 11; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr class="row-search">
								<td></td>
								<td></td>
								<td>
									<select id="customerid" name="customerid" class="combos" >
										<?php foreach($customers as $item){?>
											<option value="<?=$item->id;?>"><?=$item->customer_name;?> - <?=$item->phone;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<input type="text" name="ticket_code" id="ticket_code" class="searchs form-control " />
								</td>
								<td>
									<input type="text" name="ticket_price" id="ticket_price" class="searchs form-control " />
								</td>
								<td></td>
								<td></td>
								<td>
									<div id="click_date" class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
										<input type="text" id="ticket_date_expired" placeholder="<?=cfdateHtml();?>" name="ticket_date_expired" class="searchs form-control" >
										<span class="input-group-btn ">
											<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td><input type="text" name="ticket_description_pay" id="ticket_description_pay" class="searchs form-control " /></td>
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
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 1000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 15%;left:35%;text-align: center;">
		<img src="<?=url_tmpl()?>img/ajax_loader.gif" style="z-index: 2;position: absolute;"/>
	</div>
</div> 
<!--S Modal -->
<div id="myModalFrom" class="modal fade" role="dialog">
  <div class="modal-dialog w500">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalTitleFrom"><?=getLanguage('sua');?></h4>
      </div>
      <div id="loadContentFrom" class="modal-body">
      </div>
      <div class="modal-footer">
		 <button id="actionSave" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i>  <?=getLanguage('luu');?></button>
        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!--E Modal -->
<!--S Modal -->
<div id="myModalFromPay" class="modal fade" role="dialog">
  <div class="modal-dialog w800">
    <!-- Modal content-->
    <div class="modal-content ">
      <div id="loadContentFromPay" class="modal-body">
      </div>
	  <!--E Content-->
		<div class="modal-footer">
			 <button id="actionsaveRecept" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i> <?=getLanguage('luu');?></button>
			  <!--<button id="printRecept" type="button" class="btn btn-info" ><i class="fa fa-print" aria-hidden="true"></i>  <?=getLanguage('in-phieu-chi');?></button>-->
			<button id="close2" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
	    </div>
    </div>
  </div>
</div>
<!--E Modal -->
<!--S Modal -->
<div id="myModalFromCN" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:1000px;">
    <!-- Modal content-->
    <div class="modal-content ">
		 <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" ><?=getLanguage('thong-tin-don-hang');?></h4>
		  </div>
		 <div id="loadContentFromCN" class="modal-body">
			
		 </div>
	  <!--E Content-->
		<div class="modal-footer">
			<button id="close3" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
	    </div>
    </div>
  </div>
</div>
<!--E Modal -->
<input type="hidden" name="id" id="id" />
<input type="hidden" name="ptid" id="ptid" />
<script>
	var controller = '<?=base_url().$routes;?>/';
	var csrfHash = '<?=$csrfHash;?>';
	var cpage = 0;
	var search;
	$(function(){
		$('#id,#ptid').val('');
		init();
		formatNumberKeyUp('fm-number');
		refresh();
		$('#search').click(function(){
			$(".loading").show();
			searchList();	
		});
		$('#refresh').click(function(){
			$('.loading').show();
			refresh();
		});
		$("#close").click(function(){
			$(".loading").show();
			refresh();
		});
		$('#save').click(function(){
			$('#id').val('');
			loadForm();
		});
		$('#edit').click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning("Chọn ticket");
				return false;
			} 
			loadForm(id);
		});
		$('#pay').click(function(){
			var id = $('#id').val();
			if(id == ''){
				//$('#close2').click();
				warning("Chọn ticket"); return false;
			}
			loadFormPay(id);
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
		searchFunction();
	});
	$(document.body).on('click', '#actionSave',function (){
		save();
	});
	$(document.body).on('click', '#actionsaveRecept',function (){
		saveDetail();
	});
	$(document.body).on('click', '#printRecept',function (){
		var ptid = $('#ptid').val();
		printRecept(ptid);
	});
	function searchFunction(){
		$("#ticket_code,#ticket_price,#ticket_description_pay").keyup(function() {
			searchList();	
		});
		$("#click_date").on("changeDate", function(e) {
			searchList();
		});
	}
	function saveDetail(){
		var id = $('#id').val();
		var money = $('#money').val();
		var description = $('#description_detail').val();
		var payment = $('#payment').val();
		var bankid = $('#bankid').val();
		var datepo  = $('#input_datepo').val();
		var customerid = $('#customerid').val();
		if(money == ''){
			warning("Số tiền không được trống"); return false;	
		}
		$.ajax({
			url : controller + 'saveRecept',
			type: 'POST',
			async: false,
			data:{id:id,money:money,description:description,payment:payment,bankid:bankid,datepo:datepo,customerid:customerid},
			success:function(datas){
				success("Cập nhật thanh toán thành công"); 
				$('#ptid').val(datas);
				searchList();
				getDetail();
			}
		});
	}
	function printRecept(ptid){
		if(ptid == ""){
			warning("<?=getLanguage('in-loi');?>"); return false;	
			return false;
		}
		$.ajax({
			url : controller + 'getDataPrintPC',
			type: 'POST',
			async: false,
			data: {ptid:ptid},
			success:function(datas){
				var object = $.evalJSON(datas); 
				var disp_setting = "toolbar=yes,location=yes,directories=yes,menubar=no,";
				disp_setting += "scrollbars=yes,width=900, height=auto, left=0.0, top=0.0";
				var docprint = window.open("certificate", "certificate", disp_setting);
				docprint.document.open();
				docprint.document.write('<html>');
				//docprint.document.write(css);
				docprint.document.write('<body onLoad="self.print()">');
				docprint.document.write(object.content);
				docprint.document.write('</body></html>');
				docprint.document.close();
				docprint.focus();
			}
		});
		return false;
	}
	function loadFormPay(id){
		$.ajax({
			url : controller + 'formPay',
			type: 'POST',
			async: false,
			data:{id:id},  
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$('#loadContentFromPay').html(obj.content);
				$('#id').html(obj.id);
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
				$('#input_distric_name').select();
				$('#id').html(obj.id);
			}
		});
	}
	function save(){
		var id = $('#id').val(); 
		var func = 'save';
		if(id != ''){
			func = 'edit';
		}
		search = getFormInput();
		var obj = $.evalJSON(search); 
		/*if(obj.customerid == ''){
			warning("<?=getLanguage('chon-khach-hang')?>"); return false;	
		}
		if(obj.price == ''){
			warning("<?=getLanguage('thanh-toan-khong-duoc-trong')?>"); return false;	
		}*/
		$('.loading').show();
		var token = $('#token').val();
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
					error("Cập nhật không thành công"); return false;	
				}
				else if(obj.status == -1){
					error(dldtt); return false;		
				}
				else{
					success("Cập nhật thành công"); 
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				error("Cập nhật không thành công"); return false;	
			}
		});
	}
	function init(){
		$('#customerid').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-khach-hang')?>',
			onClick: function(view){
				searchList();
			}
		});
	}
    function funcList(obj){
		$('.edit').each(function(e){
			$(this).click(function(){ 
				 var price = $('.price').eq(e).html();
				 var description = $('.description').eq(e).html();
				 var expirationdate = $('.expirationdate').eq(e).html();
				 var customerid = $(this).attr('customerid');
				 var id = $(this).attr('id');
				 $('#id').val(id);	
				 $('#description').val(description);	
				 $('#price').val(price);	
				 $('#expirationdate').val(expirationdate);	
				 $('#customerid').multipleSelect('setSelects', customerid.split(','));

			});
		});	
		$('.edititem').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				loadForm(id);
			});
		});
		$('.itemView').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				viewDataPNK(id);
			});
		});
	}
	function viewDataPNK(id){
		var token = $('#token').val();
		$.ajax({
			url : '<?=base_url();?>inputinventory/viewPhieunhapkho?unit=',
			type: 'POST',
			async: false,
			data: {id:id},
			success:function(datas){
				var object = $.evalJSON(datas);  
				$('#loadContentFromCN').html(object.content);
			}
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
	
</script>
