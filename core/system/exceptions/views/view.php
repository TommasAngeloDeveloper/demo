			<?php
			class main_Exception
			{
				public static function main($css, $msg = false, $details = false)
				{
					if ($msg) {
						$msg = $msg . ' &#128679;';
					} else {
						$msg = 'Страница временно не доступна &#128679;';
					}


			?>
					<link href="/<?= $css['css_min'] ?>" rel="stylesheet" type="text/css">

					<section class="section_exceptions">

						<div class="block-msg_error">
							<div class="msg_error-container">
								<div class="msg_error-wrapper">

									<div class="block-title">
										<div class="title-container">
											<div class="title-wrapper">

												<div class="block-text">
													<div class="text-container">
														<div class="text-wrapper">
															<div class="text">Warning</div>
															<div class="smile">⚠</div>
														</div>
													</div>
												</div>
												<div class="block-msg">
													<div class="msg-container">
														<div class="msg-wrapper">
															<div class="msg"><?= $msg ?></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<?php
									if ($details && is_array($details)) { ?>
										<div class="block-details">
											<div class="details-container">
												<div class="details-wrapper">

													<?php
													foreach ($details as $key => $result) { ?>

														<div class="detail">
															<span class="prefix">
																<?= ucfirst($key) ?>:
															</span>
															<span class="text" title="<?= $result ?>"><?= $result ?></span>
														</div>

													<?php
													} ?>
												</div>
											</div>
										</div>
									<?php
									}
									?>
									<div class="block-btns">
										<div class="btns-container">
											<div class="btns-wrapper">

												<div class="block-btn">
													<div class="btn-container">
														<div class="btn-wrapper">
															<a class="btn" href="/" title="Перейти на главную страницу">На главную</a>
														</div>
													</div>
												</div>
												<div class="block-btn">
													<div class="btn-container">
														<div class="btn-wrapper">
															<a class="btn" href="javascript:history.go(-1)" title="Вернуться на предыдущую страницу">Назад</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</section>
			<?php
				}
			}
