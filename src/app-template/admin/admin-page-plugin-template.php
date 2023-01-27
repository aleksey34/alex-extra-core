<?php
/**
 * Page of admin menu for this plugin
 *
 * // можем использовать функцию get_admin_page_title(), чтобы динамически вывести "Настройки слайдера"
 */
?>
<div class="wrapper">
	<div class="wrap"><h2><?php echo  get_admin_page_title() ; ?></h2></div>;
	<p>
		На этой странице находятся настроки планина Alex-Extra-Core и они будут изментся по мере необходимости.
	</p>
	<div>
		<form   onclick="return false;">
			<table class="form-table" role="presentation">
				<tbody>
				<tr>
					<th scope="row"><label for="blogname">Название сайта</label></th>
					<td>
						<input name="blogname" type="text" id="blogname" value="Ferrara Artisan Workshop" class="regular-text">
						<p class="description" id="tagline-description1">Объясните в нескольких словах, о чём этот сайт.</p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="blogdescription">Краткое описание</label></th>
					<td>
						<input name="blogdescription" type="text" id="blogdescription" aria-describedby="tagline-description" value="Мастерская Ferrara Design" class="regular-text" placeholder="Ещё один сайт на WordPress">
						<p class="description" id="tagline-description">Объясните в нескольких словах, о чём этот сайт.</p>
					</td>
				</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить изменения">
			</p>
		</form>
	</div>
</div>