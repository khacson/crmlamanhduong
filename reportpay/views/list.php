
<?php 	$i = $start;
foreach ($datas as $key => $item){
	$datepo = '';
	if($item->datepo != '0000-00-00' && !empty($item->datepo)){
		$datepo = date(cfdate(),strtotime($item->datepo));
	}
	$id = $item->id;
	?>
	<tr class="content edit" customerid="<?=$item->customerid;?>" id="<?=$item->id;?>">	
		<td class="text-center">
			<input id="<?=$item->id;?>" class="noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="customer_name"><?=$item->customer_name;?></td>
		<td class="ticket_code"><?=$item->ticket_code;?></td>
		<td class="ticket_name"><?=$item->ticket_name;?></td>
		<td class="amount text-right"><?=fmNumber($item->amount);?></td>
		<td class="datepo text-center"><?=$datepo;?></td>
		<td class="usercreate"><?=$item->usercreate;?></td>
		<td class="ticket_description_pay"><?=$item->notes;?></td>
		<td></td>
	</tr>

<?php $i++;}?>
