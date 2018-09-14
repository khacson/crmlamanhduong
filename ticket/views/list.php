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
	$color = $item->color;
	$background = $item->background;
	$reply_result = '<a class="btn '.$background.' radius8" style="padding:0 3px;">'.$item->status_name .'</a>';
		
	$reply_datetime = '';
	if(!empty($item->reply_datetime)){
		$reply_datetime = date('d/m/Y H:i:s',strtotime($item->reply_datetime));
	}
	?>
	<tr style="color:#<?=$color;?>" class="edit" id="<?=$item->id;?>" >
		
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
		<td class="text-center"><?=$reply_datetime;?></td>
		<td class="text-center">
			<?php if(isset($permission['edit'])){?>
				<a id="<?=$id;?>" class="btn btn-info edititem btn-icon2" href="#" data-toggle="modal" data-target="#myModalFrom">
				<i class="fa fa-pencil" aria-hidden="true"></i>
				</a>
			<?php }?>
			<?php if(isset($permission['delete'])){?>
				<a id="<?=$id;?>" class="btn btn-danger deleteitem btn-icon2" href="#" data-toggle="modal" data-target="#myModal">
				<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			<?php }?>
			<?php if(isset($permission['feedback']) && $item->reply_result != 0){?>
				<a id="<?=$id;?>" title="Đánh giá" class="btn btn-info feedback btn-icon2" href="#" data-toggle="modal" data-target="#myModalFromFeedback">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
				</a>
			<?php }?>
		</td>
		
		<td></td>
	</tr>

<?php $i++;}?>
