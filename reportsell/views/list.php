
<?php 	$i = $start;
foreach ($datas as $key => $item) { 	
	$id = $item->id;
	?>
	<tr class="edit" id="<?=$item->id;?>" >
		
		<td style="text-align: center;">
			<a id="<?=$id;?>" class="btn btn-info edititem btn-icon2" href="#" data-toggle="modal" data-target="#myModalFrom">
			<i class="fa fa-eye" aria-hidden="true"></i>
			</a>
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="car_number"><?=$item->car_number;?></td>
		<td class="car_cavet_name"><?=$item->car_cavet_name;?></td>
		<td class="customer_name"><?=$item->customer_name;?></td>
		<td class="customer_phone"><?=$item->customer_phone;?></td>
		<td class="presenter_name"><?=$item->presenter_name;?></td>
		<td class="presenter_phone"><?=$item->presenter_phone;?></td>
		<td><?=$item->manufacturer_name;?></td>
		<td><?=$item->typecar_name;?></td>
		<td><?=$item->vehicleload_name;?></td>
		<td class="text-center">
			<?php if(!empty($item->car_images)){
				$arr_car_images = explode(';',$item->car_images);
				foreach($arr_car_images as $key=>$val){
					if(empty($val)){
						continue;
					}
				?>
				<img id="<?=$val;?>"  class="viewImgs" width="50" height="40" src="<?=base_url();?>files/goods/<?=$val;?>">
			<?php }}?>
		</td>
		<td class="box_serial"><?=$item->box_serial;?></td>
		<td class="box_web"><?=$item->box_web;?></td>
		<td class="box_username"><?=$item->box_username;?></td>
		<td class="box_password"><?=$item->box_password;?></td>
		<td class="text-center">
			<?php 
				if(!empty($item->box_guarantee)){
					echo  date(cfdate(),strtotime($item->box_guarantee));;
				}
			?>
		</td>
		<td class="box_description"><?=$item->box_description;?></td>
		<td><?=$item->registrationstation_name;?></td>
		<td class="text-center">
			<?php 
				if(!empty($item->registrationstation_date)){
					echo  date(cfdate(),strtotime($item->registrationstation_date));;
				}
			?>
		</td>
		<td class="text-center">
			<?php 
				if(!empty($item->registrationstation_expires)){
					echo  date(cfdate(),strtotime($item->registrationstation_expires));;
				}
			?>
		</td>
		<td class="text-center">
			<?php if(!empty($item->box_images)){
				$arr_box_images = explode(';',$item->box_images);
				foreach($arr_box_images as $key=>$val){
					if(empty($val)){
						continue;
					}
				?>
				<img id="<?=$val;?>"  class="viewImgs" width="50" height="40" src="<?=base_url();?>files/goods/<?=$val;?>">
			<?php }}?>
		</td>
		<td><?=$item->insurance_name;?></td>
		<td class="text-center">
			<?php 
				if(!empty($item->insurance_expires)){
					echo  date(cfdate(),strtotime($item->insurance_expires));;
				}
			?>
		</td>
		<td class="text-right"><?=number_format($item->pay_total);?></td>
		<td class="text-right"><?=number_format($item->pay_advance);?></td>
		<td class="text-center"></td>
		<td></td>
	</tr>

<?php $i++;}?>
