<div id="login-wrapper">
	<form action="" method="post">
		<fieldset>
			<legend>login</legend>
			<?php if(isset($error)){ ?>
				<p class="error"><?php echo $error ?></p>
			<?php } ?>
			<div>
				<label for="username">username</label>
				<input type="text" name="username" id="username"/>
			</div>
			<div>
				<label for="password">password</label>
				<input type="password" name="password" id="password"/>
			</div>
			<?php if(isset($register)){ ?>
			<div>
				<label for="password_confirm">confirm password</label>
				<input type="password" name="password_confirm" id="password_confirm"/>
			</div>
			<div>
				<label for="email">email</label>
				<input type="text" name="email" id="email"/>
			</div>
			<?php } ?>
			<div>
				<input type="submit" name="login" value="login"/>
			</div>
		</fieldset>
	</form>
</div>
