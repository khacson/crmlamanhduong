
<?php 	$i = $start;
foreach ($datas as $key => $item){
	$expirationdate = '';
	if($item->expirationdate != '0000-00-00' && !empty($item->expirationdate)){
		$expirationdate = date(cfdate(),strtotime($item->expirationdate));
	}
	$id = $item->id;
	?>
	<tr class="content edit" supplierid="<?=$item->supplierid;?>" id="<?=$item->id;?>" 
	
	>
		
		<td class="text-center">
			<input id="<?=$item->id;?>" class="noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="supplier_name"><?=$item->supplier_name;?></td>
		<td class="pnk">
			<a id="<?=$item->orderid;?>" href="#" class="itemView fright" data-toggle="modal" data-target="#myModalFromCN">
				<?=$item->pnk;?> <i class="fa fa-question-circle-o" aria-hidden="true"></i>
			</a>
		</td>
		<td class="price text-right"><?=fmNumber($item->price);?></td>
		<td class="amount_debt text-right"><?=fmNumber($item->amount_debt);?></td>
		<td class="text-right"><?=fmNumber($item->da_thanh_toan);?></td>
		<td class="text-right"><?=fmNumber(($item->amount_debt) - ($item->da_thanh_toan));?></td>
		<td class="expirationdate"><?=$expirationdate;?></td>
		<td class="description"><?=$item->description?></td>
		<td class="text-left">
			<a id="<?=$item->orderid;?>" class="btn btn-info itemView" href="#" data-toggle="modal" data-target="#myModalFromCN">
				<i class="fa fa-eye" aria-hidden="true"></i>
			</a>
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
