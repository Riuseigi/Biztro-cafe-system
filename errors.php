<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo '<script> alert("Wrong Username Or Password"); </script>'; ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
