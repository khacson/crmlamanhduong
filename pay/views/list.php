
<?php 	$i = $start;
foreach ($datas as $key => $item){
	$ticket_date_expired = '';
	if($item->ticket_date_expired != '0000-00-00' && !empty($item->ticket_date_expired)){
		$ticket_date_expired = date(cfdate(),strtotime($item->ticket_date_expired));
	}
	$id = $item->id;
	?>
	<tr class="content edit" customerid="<?=$item->customerid;?>" id="<?=$item->id;?>">	
		<td class="text-center">
			<input id="<?=$item->id;?>" class="noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="customer_name"><?=$item->customer_name;?></td>
		<td class="ticket_code">
			<?=$item->ticket_code;?>
		</td>
		<td class="ticket_price text-right"><?=fmNumber($item->ticket_price);?></td>
		<td class="text-right"><?=fmNumber($item->da_thanh_toan);?></td>
		<td class="text-right"><?=fmNumber(($item->ticket_price) - ($item->da_thanh_toan));?></td>
		<td class="ticket_date_expired"><?=$ticket_date_expired;?></td>
		<td class="ticket_description_pay"><?=$item->ticket_description_pay?></td>
		<td></td>
	</tr>

<?php $i++;}?>
