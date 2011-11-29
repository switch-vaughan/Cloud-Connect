<h1><?php echo $pageTitle ?> &rsaquo; <?php if(isset($save)){ ?>Add<?php }else{ ?>Edit<?php } ?></h1>
<?php if(isset($error) && !empty($error)){ ?>
	<p class="error"><?php echo $error ?></p>
<?php } ?>
<?php if(isset($message) && !empty($message)){ ?>
	<p class="message"><?php echo $message ?></p>
<?php } ?>
<?php if(isset($error) || empty($error)){ ?>
<form action="" method="post">
	<?php if(isset($title)){ ?>
	<div>
		<fieldset>
			<legend class="title-label">Title</legend>
				<input id="title" maxlength="255" name="title"<?php if(isset($title['readonly']) && $title['readonly']){ ?> readonly="readonly"<?php } ?> title="title" type="text" value="<?php echo $title['val'] ?>"/>
		</fieldset>
	</div>
	<?php } ?>
	<?php if(isset($slug)){ ?>
	<div>
		<fieldset>
			<legend class="slug-label">Slug</legend>
				<input id="slug" maxlength="255" name="slug" readonly="readonly" title="slug" type="text" value="<?php echo $slug['val'] ?>"/>
				<?php if(!$slug['readonly']){ ?><input<?php if(isset($slugAuto)){ ?> checked="checked"<?php } ?> id="slug_auto" name="slug_auto" type="checkbox"/><span>Auto create</span><?php } ?>
		</fieldset>
	</div>
	<?php } ?>
	<?php if(isset($copy)){ ?>
	<div>
		<fieldset>
			<legend class="copy-label">Copy</legend>
				<textarea cols="60" id="copy" name="copy"<?php if(isset($copy['readonly']) && $copy['readonly']){ ?> readonly="readonly"<?php } ?> rows="10" title="copy"><?php echo $copy['val'] ?></textarea>
		</fieldset>
	</div>
	<?php } ?>
	<?php if(isset($articles) && !empty($articles)){ ?>
	<div>
		<fieldset>
			<legend class="linkedto-label">Parent</legend>
				<select>
					<?php foreach($articles as $val){ ?>
					<option><?php echo $val['title'] ?></option>
					<?php } ?>
				</select>
		</fieldset>
	</div>
	<?php } ?>
	<div>
		<?php if(isset($save)){ ?>
		<input name="save" type="submit" value="save"/>
		<?php } ?>
		<?php if(isset($update)){ ?>
		<input name="update" type="submit" value="update"/>
		<?php } ?>
		<?php if(isset($deletable) && $deletable){ ?>
		<input name="delete" type="submit" value="delete"/>
		<?php } ?>
		<input name="back" type="submit" value="back"/>
	</div>
	<?php if(isset($id)){ ?>
	<input id="id" type="hidden" value="<?php echo $id ?>"/>
	<?php } ?>
</form>
<?php } ?>