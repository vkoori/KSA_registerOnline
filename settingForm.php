<div class="wrap">
	<h1>KSA Register Online</h1>
	<form action="" method="post">
		<h2 class="title">تنظیمات پنل پیامکی</h2>
		<p>جهت اتصال افزونه و وب سرویس، لطفا اطلاعات پنل پیامکی خود را ثبت کنید.</p>
		<table class="form-table" role="presentation">
			<tbody>
				<?php foreach ($setting as $s): ?>
					<tr>
						<th scope="row">
							<label for="<?php echo $s->option_name; ?>"><?php echo str_replace('KSA_registerOnline_', '', $s->option_name); ?></label>
						</th>
						<td>
							<input name="<?php echo $s->option_name; ?>" type="text" id="<?php echo $s->option_name; ?>" value="<?php echo $s->option_value; ?>">
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<p class="submit"><input type="submit" class="button button-primary" value="ذخیره سازی"></p>
	</form>
</div>