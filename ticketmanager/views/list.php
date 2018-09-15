
<?php 	$i = $start;
foreach ($datas as $key => $item) { 	
	$id = $item->id;
	$priority_name = $item->priority_name;
	if($item->priorityid == 1){
		$priority_name = '<a class="btn btn-danger radius8" style="padding:0 3px;">'.$priority_name.'</a>';
	}
	elseif($item->priorityid == 2){
		$priority_name = '<a class="btn btn-warning radius8" style="padding:0 3px;">'.$priority_name.'</a>';
	}
	else{
		$priority_name = '<a class="btn btn-info radius8" style="padding:0 3px;">'.$priority_name.'</a>';
	}
	//Tinh trang
	//Tinh trang
	
	$background = $item->background;
	$reply_result = '<a id="'.$id.'" href="#" class="btn '.$background.' radius8 reply" style="padding:0 3px;" href="#" data-toggle="modal" data-target="#myModalFromReply">'.$item->status_name .'</a>';
	//reply_status
	$reply_status = ''; 
	$color = '';
	if($item->reply_status == 1){
		$reply_status = '<a class="btn btn-info radius8" style="padding:0 3px;">'.getLanguage('mo').'</a>';
	}
	elseif($item->reply_status == 2){
		$reply_status = '<a class="btn btn-default radius8" style="padding:0 3px;">'.getLanguage('dong').'</a>';
	}
	?>
	<tr style="<?=$color;?>" class="edit" id="<?=$item->id;?>" >
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="ticket_code text-center"><?=$item->ticket_code;?></td>
		<td class="ticket_name"><?=$item->ticket_name;?></td>
		<td class="priority_name text-center"><?=$priority_name;?></td>
		<td class="ticket_name text-center"><?=date('d/m/Y H:i:s',strtotime($item->datecreate));?></td>
		<td class="usercreate"><?=$item->usercreate;?></td>
		<td class="usercreate"><?=$item->customer_name;?></td>
		<td class="text-center"><?=$reply_result;?></td>
		<td class="text-center"><?=$reply_status;?></td>
		<td class="text-center">
			<?php if(isset($permission['edit']) && $item->reply_status == 1){?>
				<a id="<?=$id;?>" class="btn btn-info edititem btn-icon2" href="#" data-toggle="modal" data-target="#myModalFrom">
				<i class="fa fa-pencil" aria-hidden="true"></i>
				</a>
			<?php }?>
			<?php if(isset($permission['delete'])){?>
				<a id="<?=$id;?>" class="btn btn-danger deleteitem btn-icon2" href="#" data-toggle="modal" data-target="#myModal">
				<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			<?php }?>
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
