<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 100px;}
	table col.c4 { width: 130px;}
	table col.c5 { width: 130px;}
	table col.c6 { width: 100px; }
	table col.c7 { width: 130px;}
	table col.c8 { width: 140px;} /*DT NGT*/
	table col.c9 { width: 150px; }
	table col.c10 { width: 130px;}
	table col.c11 { width: 100px;}
	table col.c12 { width: 120px; }
	table col.c13 { width: 150px;}
	table col.c14 { width: 120px;}
	table col.c15 { width: 120px; }
	table col.c16 { width: 100px;} /*Hang*/
	table col.c17 { width: 150px;}
	table col.c18 { width: 130px; }
	table col.c19 { width: 130px; }
	table col.c20 { width: 130px;}
	table col.c21 { width: 130px;}
	table col.c22 { width: 130px;}
	table col.c23 { width: 130px;}
	table col.c24 { width: 130px;}
	table col.c25 { width: 130px;}
	table col.c26 { width: 130px;}
	table col.c27 { width: 70px;}
	table col.c28 { width: auto;}
	.col-md-4{ white-space: nowrap !important;}
</style>
<script type="text/javascript" src="<?=url_tmpl();?>fancybox/source/jquery.fancybox.pack.js"></script>  
<link href="<?=url_tmpl();?>fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<div class="row">
	<?=$this->load->inc('breadcrumb');?>
</div>
<div class="portlet box blue mtop0">
	<div class="portlet-title">
		<div class="caption caption2">
			 <div class="brc mtop3">
				  <a id="viewtotal2" class="btn btn-info" style="border-radius:0;">
					  <?=getLanguage('tong');?> (<span class="semi-bold viewtotal">0</span>)
				  </a>
				  <a id="viewtotal2" class="btn btn-info" style="border-radius:0;">
					  <?=getLanguage('het-han-bao-hanh');?> (<span class="semi-bold viewtotal2">0</span>)
				  </a>
				  <a id="viewtotal3" class="btn btn-warning" style="border-radius:0;">
					  <?=getLanguage('sap-het-han');?> (<span class="semi-bold viewtotal3">0</span>)
				  </a>
				  <a id="viewtotal3" class="btn btn-danger" style="border-radius:0;">
					  <?=getLanguage('het-han-bao-hiem');?> (<span class="semi-bold viewtotal3">0</span>)
				  </a>
			 </div>			
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
				<?php if(isset($permission['export'])){?>
				<li id="export">
					<button class="button">
						<i class="fa fa-file-excel-o"></i>
						<?=getLanguage('export')?>
					</button>
				</li>
				<?php } ?>
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
							<?php for($i=1; $i< 29; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr>							
								<th>#</th>
								<th><?=getLanguage('stt')?></th>								
								<th id="ord_c.car_number"><?=getLanguage('bien-so-xe');?></th>
								<th id="ord_c.car_cavet_name"><?=getLanguage('ten-cavet');?></th>
								<th id="ord_c.customer_name"><?=getLanguage('ten-chu-xe');?></th>
								<th id="ord_c.customer_name"><?=getLanguage('dien-thoai-chu-xe');?> </th>
								<th id="ord_c.presenter_name"><?=getLanguage('ten-nguoi-gt');?> </th>
								<th id="ord_c.presenter_phone"><?=getLanguage('dien-thoai-nguoi-gt');?> </th>
								<th id="ord_c.manufacturer_id"><?=getLanguage('hang-xe');?> </th>
								<th id="ord_c.cartype_id"><?=getLanguage('loai-xe');?> </th>
								<th id="ord_c.vehicleload_id"><?=getLanguage('trong-tai');?> </th>
								<th ><?=getLanguage('hinh-xe');?> </th>
								<th id="ord_c.box_serial"><?=getLanguage('serial');?> </th>
								<th id="ord_c.box_web"><?=getLanguage('web');?> </th>
								<th id="ord_c.box_username"><?=getLanguage('username');?> </th>
								<th id="ord_c.box_password"><?=getLanguage('password');?> </th>
								<th id="ord_c.box_guarantee"><?=getLanguage('bao-hanh');?> </th>
								<th id="ord_c.box_description"><?=getLanguage('ghi-chu');?> </th>
								<th id="ord_c.registrationstation_id"><?=getLanguage('tram-dang-kiem');?> </th>
								<th id="ord_c.registrationstation_date"><?=getLanguage('ngay-dang-kiem');?> </th>
								<th id="ord_c.registrationstation_expires"><?=getLanguage('ngay-het-han');?> </th>
								<th ><?=getLanguage('hinh-dang-kiem');?> </th>
								<th id="ord_c.insurance_id"><?=getLanguage('hang-bao-hiem');?> </th>
								<th id="ord_c.insurance_expires"><?=getLanguage('ngay-het-han');?> </th>
								<th id="ord_c.pay_total"><?=getLanguage('tong-tien');?> </th>
								<th id="ord_c.pay_advance"><?=getLanguage('da-thanh-toan');?> </th>
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
							<?php for($i=1; $i < 29; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr class="row-search">
								<td></td>
								<td></td>
								<td><input type="text" name="car_number" id="car_number" class="searchs form-control" /></td>
								<td><input type="text" name="car_cavet_name" id="car_cavet_name" class="searchs form-control"/>
								<td><input type="text" name="customer_name" id="customer_name" class="searchs form-control"/></td>
								<td><input type="text" name="customer_name" id="customer_name" class="searchs form-control"/></td>
								<td><input type="text" name="presenter_name" id="presenter_name" class="searchs form-control"/></td>
								<td><input type="text" name="presenter_phone" id="presenter_phone" class="searchs form-control"/></td>
								<td>
									<select id="manufacturer_id" name="manufacturer_id" class="combos" >
										<?php foreach($manufacturers as $item){?>
											<option value="<?=$item->id;?>"><?=$item->name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<select id="cartype_id" name="cartype_id" class="combos" >
										<?php foreach($cartypes as $item){?>
											<option value="<?=$item->id;?>"><?=$item->name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<select id="vehicleload_id" name="vehicleload_id" class="combos" >
										<?php foreach($vehicleloads as $item){?>
											<option value="<?=$item->id;?>"><?=$item->name;?></option>
										<?php }?>
									</select>
								</td>
								<td></td>
								<td><input type="text" name="box_serial" id="box_serial" class="searchs form-control" value="box_serial"/></td>
								<td><input type="text" name="box_web" id="box_web" class="searchs form-control"/></td>
								<td><input type="text" name="box_username" id="box_username" class="searchs form-control"/></td>
								<td><input type="text" name="box_password" id="box_password" class="searchs form-control"/></td>
								<td>
									<div id="registrationstation_date_click" class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
										<input type="text" id="box_guarantee" placeholder="<?=cfdateHtml();?>" name="box_guarantee" class="form-input form-control" value="">
										<span class="input-group-btn ">
											<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td><input type="text" name="box_description" id="box_description" class="searchs form-control"/></td>
								<td>
									<select id="registrationstation_id" name="registrationstation_id" class="combos" >
										<?php foreach($registrationstations as $item){?>
											<option value="<?=$item->id;?>"><?=$item->name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<div id="registrationstation_date_click" class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
										<input type="text" id="registrationstation_date" placeholder="<?=cfdateHtml();?>" name="registrationstation_date" class="form-input form-control" value="">
										<span class="input-group-btn ">
											<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td>
									<div id="registrationstation_expires_click" class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
										<input type="text" id="registrationstation_expires" placeholder="<?=cfdateHtml();?>" name="registrationstation_expires" class="form-input form-control" value="">
										<span class="input-group-btn ">
											<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td></td>
								<td>
									<select id="insurance_id" name="insurance_id" class="combos" >
										<?php foreach($insurances as $item){?>
											<option value="<?=$item->id;?>"><?=$item->name;?></option>
										<?php }?>
									</select>
								</td>
								<td>
									<div id="insurance_expires_click" class="input-group date date-picker" data-date-format="<?=cfdateHtml();?>">
										<input type="text" id="insurance_expires" placeholder="<?=cfdateHtml();?>" name="insurance_expires" class="form-input form-control" value="">
										<span class="input-group-btn ">
											<button class="btn default btn-picker" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td><input type="text" name="pay_total" id="pay_total" class="searchs form-control"/></td>
								<td><input type="text" name="pay_advance" id="pay_advance" class="searchs form-control"/></td>
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
  <div class="modal-dialog w900">
    <!-- Modal content-->
    <div class="modal-content ">
      <div id="loadContentFrom" class="modal-body" style="padding:5px;">
      </div>
      <div class="modal-footer">
        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!--E Modal -->
<!-- view Img -->
<div id="viewImg-form" style="display:none;">
	<div class="">
		<div id="viewImg-form-gridview" >
			
		</div>
	</div>
</div>
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
		searchFunction();
	});
	function searchFunction(){
		$("#typecar_name").keyup(function() {
			searchList();	
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
		var search = getFormInput();
		var obj = $.evalJSON(search); 
		if(obj.car_number == ''){
			warning("Biển số xe không được trống."); return false;	
		}
		if(obj.car_cavet_name == ''){
			warning("Tên cavet không được trống."); return false;	
		}
		if(obj.customer_name == ''){
			warning("Tên chủ xe không được trống."); return false;	
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
					if(id == ''){
						error("Đăng bán không thành công"); return false;	
					}
					else{
						error("Sửa không thành công"); return false;	
					}
				}
				else if(obj.status == -1){
					error(dldtt); return false;		
				}
				else{
					if(id == ''){
						success("Đăng bán thành công"); 
					}
					else{
						success("Sửa thành công"); 
					}
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				error("Lỗi dữ liệu"); return false;	
			}
		});
	}
	function init(){
		$('#manufacturer_id').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-hang-xe');?>',
			onClick: function(view){
				searchList();
			}
		});
		$('#cartype_id').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-loai-xe');?>',
			onClick: function(view){
				searchList();
			}
		});
		$('#vehicleload_id').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-trong-tai');?>',
			onClick: function(view){
				searchList();
			}
		});
		$('#registrationstation_id').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-tram-dang-kiem');?>',
			onClick: function(view){
				searchList();
			}
		});
		$('#insurance_id').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-hang-bao-hiem');?>',
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
		$(".viewImgs").each(function(e) {
			$(this).click(function() {
				var id = $(this).attr('id');
				viewImgs(id);
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
	function viewImgs(url) {
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
				$('#viewImg-form-gridview').html('<img style="width:600px; height:500px;" src="<?=base_url();?>files/goods/'+url+'" />');
			}
		});
    }
</script>
