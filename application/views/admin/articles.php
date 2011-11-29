<h1><?php echo $pageTitle ?></h1>
<ul id="pages">
	<?php
	if(!empty($articles)){
		foreach($articles as $val){
	?>
	<li>
		<a href="<?php echo $editURL . $val['id'] ?>" style="padding-left: <?php echo 30 * $val['depth'] ?>px">
			<?php echo $val['title'] ?>
			<span><?php echo $val['title'] ?></span>
		</a>
	</li>
	<?php
		}
	}
	?>
</ul>
<br/>
<form action="<?php echo $addURL ?>" method="post">
	<input type="submit" name="add" value="Add"/>
	<?php if(isset($edit)){ ?>
	<input type="submit" name="edit" value="Edit main article"/>
	<?php } ?>
</form>