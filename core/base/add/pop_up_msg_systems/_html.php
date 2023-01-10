<?php

namespace base\add\pop_up_msg_systems;

class _html
{
	use \traits\BaseMethods;
	private static function html($data = null)
	{
		if (isset($_SESSION['msg'])) {
			if (!empty($_SESSION['msg']['false']) || !empty($_SESSION['msg']['warning']) || !empty($_SESSION['msg']['true'])) {

				$messages['msg'] = $_SESSION['msg']; ?>
				<section class="pop_up_msg_systems" data-fullScreen>
					<div class="pop_up_msg_systems-container">
						<div class="pop_up_msg_systems-wrapper">

							<div class="block-btn_close">
								<div class="btn_close-container">
									<div class="btn_close-wrapper">
										<div class="btn_close" data-fullScreenClose>+</div>
									</div>
								</div>
							</div>
							<div class="block-messages">
								<div class="messages-container">
									<div class="messages-wrapper">
										<?php
										if (isset($messages['msg']['false'])) {
											if (!is_array($messages['msg']['false']) && is_string($messages['msg']['false'])) {
												$messages['msg']['false'] = [$messages['msg']['false']];
											}
											foreach ($messages['msg']['false'] as $msg) {
												if (is_string($msg) && !empty(trim($msg))) {
										?>
													<div class="block-msg block-msg-red">
														<div class="msg-container">
															<div class="msg-wrapper">
																<div class="msg-text">
																	<?= $msg  ?>
																</div>
															</div>
														</div>
													</div>
												<?php
												}
											}
										}
										if (isset($messages['msg']['warning'])) {
											if (!is_array($messages['msg']['warning']) && is_string($messages['msg']['warning'])) {
												$messages['msg']['warning'] = [$messages['msg']['warning']];
											}
											foreach ($messages['msg']['warning'] as $msg) {
												if (is_string($msg) && !empty(trim($msg))) {
												?>
													<div class="block-msg block-msg-yellow">
														<div class="msg-container">
															<div class="msg-wrapper">
																<div class="msg-text">
																	<?= $msg  ?>
																</div>
															</div>
														</div>
													</div>
												<?php
												}
											}
										}
										if (isset($messages['msg']['true'])) {
											if (!is_array($messages['msg']['true']) && is_string($messages['msg']['true'])) {
												$messages['msg']['true'] = [$messages['msg']['true']];
											}
											foreach ($messages['msg']['true'] as $msg) {
												if (is_string($msg) && !empty(trim($msg))) {
												?>
													<div class="block-msg block-msg-green">
														<div class="msg-container">
															<div class="msg-wrapper">
																<div class="msg-text">
																	<?= $msg  ?>
																</div>
															</div>
														</div>
													</div>
										<?php
												}
											}
										}
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
<?php
				$_SESSION['msg']['true'] = [];
				$_SESSION['msg']['false'] = [];
				$_SESSION['msg']['warning'] = [];
				//	unset($_SESSION['msg']);
			}
		}
	}
}
