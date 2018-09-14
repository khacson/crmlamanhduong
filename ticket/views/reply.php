<div class="row">
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4">Trả lời: </label>
			<div class="col-md-8">
				<?=$finds->reply_description;?>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4">Người trả lời: </label>
			<div class="col-md-8">
				<?=$finds->reply_username;?>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-tra-loi');?>: </label>
			<div class="col-md-8">
				<?php if(!empty($item->reply_datetime)){?>
					<?=$finds->reply_datetime;?>
				<?php }?>
			</div>
		</div>
	</div>
</div>