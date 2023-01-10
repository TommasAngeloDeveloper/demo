<?php

namespace view;

class html
{
	public static function return($method_name, $data = null)
	{
		return self::$method_name($data);
	}
	private static function html($data = null)
	{
		// Если нажата кнопка авторизации, запускае метод проверки логина и пароля
		if (isset($_POST['authorization'])) {
			\admin\Controller::authorization($_POST['login'], $_POST['password']);
			redirect_page(true);
		} ?>


		<div class="ta_container">

			<section class="section-form">
				<div class="form-container">
					<div class="form-wrapper">



						<form class="form" method="POST">
							<div class="block-form_title">
								<div class="form_title-container">
									<div class="form_title-wrapper">
										<div class="form_title-text">
											Admin panel
										</div>
									</div>
								</div>
							</div>
							<div class="block-lable_up">
								<div class="lable_up-container">
									<div class="lable_up-wrapper">
										<div class="lable_up-text">
											Вход
										</div>
									</div>
								</div>
							</div>
							<div class="block-inputs">
								<div class="inputs-container">
									<div class="inputs-wrapper">

										<div class="block-input">
											<div class="input-container">
												<div class="input-wrapper">
													<input class="input" type="text" name="login" placeholder="логин" value="<?= $_SESSION['authorization']['login'] ?>">
												</div>
											</div>
										</div>
										<div class="block-input">
											<div class="input-container">
												<div class="input-wrapper">
													<input class="input" type="password" name="password" placeholder="пароль" value="<?= $_SESSION['authorization']['password'] ?>">
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

							<div class="block-buttons">
								<div class="buttons-container">
									<div class="buttons-wrapper">

										<div class="block-button">
											<div class="button-container">
												<div class="button-wrapper">
													<button class="button" type="submit" name="authorization">Войти</button>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</form>

					</div>
				</div>
			</section>

		</div>

<?php
	}
}
?>