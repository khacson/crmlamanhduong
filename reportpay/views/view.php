<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 160px;}
	table col.c4 { width: 110px;}
	table col.c5 { width: 180px;}
	table col.c5 { width: 100px;}
	table col.c6 { width: 100px;}
	table col.c7 { width: 110px;}
	table col.c8 { width: 110px;}
	table col.c9 { width: 250px;}
	table col.c10 { width: auto;}
	.col-md-4{ white-space: nowrap !important;}
</style>
<link type="text/css" href="<?=url_tmpl();?>css/daterangepicker.css"  rel="stylesheet">	
<script type="text/javascript" src="<?=url_tmpl();?>js/moment.js"></script>
<script type="text/javascript" src="<?=url_tmpl();?>js/daterangepicker.js"></script>
<!-- BEGIN PORTLET-->
<div class="row">
	<?=$this->load->inc('breadcrumb');?>
</div>
<div class="portlet box blue mtop0">
	<div class="portlet-title">
		<div class="caption caption2">
			<div class="brc mtop3"><i class="fa fa-bars"></i> <?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('bao-cao-doanh-thu');?></div>			
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
								<th id="ord_tk.ticket_code"><?=getLanguage('ma-yeu-cau')?></th>
								<th id="ord_tk.ticket_name"><?=getLanguage('yeu-cau')?></th>
								<th id="ord_p.amount"><?=getLanguage('so-tien')?></th>
								<th id="ord_p.datepo"><?=getLanguage('ngay-nhan')?></th>
								<th id="ord_p.usercreate"><?=getLanguage('nguoi-nhan')?></th>
								<th id="ord_p.notes"><?=getLanguage('ghi-chu')?></th>
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
									<input type="text" name="ticket_name" id="ticket_name" class="searchs form-control " />
								</td>
								<td>
									<input type="text" name="ticket_price" id="ticket_price" class="searchs form-control " />
								</td>
								<td>
									<div class="col-md-12" data-date-format="dd/mm/yyyy" style="display:inline-flex; padding-left:0; padding-right:25px;">
										<input style="float:left; text-align:center;" placeholder="Chọn ngày" type="text" id="datecreate" placeholder="dd/mm/yyyy" name="datecreate" class="form-control searchs" value="" >
										<span class="input-group-btn" >
											<button class="btn default btn-picker datecreateClick" type="button"><i class="fa fa-calendar "></i></button>
										</span>
									</div>
								</td>
								<td>
									<input type="text" name="usercreate" id="usercreate" class="searchs form-control" />
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
<input type="hidden" name="id" id="id" />
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
		$(document).keypress(function(e) {
			 var id = $("#id").val();
			 if (e.which == 13) {
				$(".loading").show();
				searchList();
			 }
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
		$("#ticket_code,#ticket_code,#ticket_price,#ticket_description_pay,#usercreate").keyup(function() {
			searchList();	
		});
		$('.datecreateClick').click(function(){
			searchList();
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
</script>
