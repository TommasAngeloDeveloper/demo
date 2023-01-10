<?php

if (defined('error_msg')) {
	$msg = error_msg;
	if (defined('error_details')) {
		$details = error_details;
	} else {
		$details = false;
	}
} else {
	$msg = 'Сайт на техническом обслуживании  &#128679;';
	$details = false;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG03NzcTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/JicnsQAAAD8AAAAAAAAAAAAAAJ9uQyP/dl1J/6ampgEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/xsjH/wAAAD+doaD/AAAAAAAAAD/JpIb/nG9N/25EI/92XUn/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/xsjH/7i7uv+rrq3/AAAAmwAAAAAAAAAAAAAAn8ijhf+cb03/bkQj/3ddSf8AAAAAAAAAAAAAAAAAAAA/xsjH/7i7uv+rrq3/AAAAWgAAAAAAAAAAAAAAAAAAAAAAAACfyKOF/5xvTf9vRCP/d11J/wAAAAAAAAA/xcjH/7i7uv+rrq3/AAAAPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJ/Io4X/m29N/3BFI/93XUn/xcjH/7i7uv+rrq3/AAAAPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAn8iihP+cb0z/cEUj/zIzM/+qrqz/AAAAPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAChyKKE//L08//S2tb/AAAAbgAAAAAAAAAAAAAAAAAAAJ8AAAA/AAAAAAAAAAAAAAAAAAAAnwAAAD+urq4BnaGg/42Ojf9HSEf/8/X0/9DY1P8AAAA/AAAAAAAAAABZWFP/NjQu/wAAAD8AAAAAAAAAQODh4P/S1NP/xcfG/7i6uf+7vr3/AAAAAAAAAJ/z9fT/z9fT/wAAAJMAAACfNjQu/3d2cv8AAACfjIyMB9/h4P/S1NP/naGg/7i6uf+qraz/AAAAAAAAAAAAAAAAAAAAn/T29f9ycWz/NjQu/3FwbP8AAAA/AAAAAAAAAJ/S1NP/AAAAPwAAAACrr63/ztDP/wAAAD8AAAAAAAAAAAAAAABxcGv/NjQu/3Jxbf8AAACfAAAAAAAAAAAAAAAAAAAAPwAAAAAAAACfzc/P/8fJyP8AAACfAAAAAAAAAAAAAAAANjQu/3Nxbf8AAACfAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACfzc/P/9LU0/8AAAA/AAAAAAAAAAAAAAA/Xl1Y/3Rybv8AAACfAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJ8AAAAAAAAAAAAAAAAAAACfIiEfvQAAAJ8AAAA/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//sAAI/1AACH4QAAg8cAAMGPAADgHwAA8D8AAPh7AADYOQAAwQAAAIODAAAzwwAA4ccAAMePAADuPwAA//8AAA==" rel="icon" type="image/x-icon" />
	<title>⛔ Error</title>
	<style>
		body {
			margin: 0;
		}

		.ta_container {

			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			width: 100%;
			height: 100vh;
		}

		.block-msg_error {
			background-color: rgb(220, 220, 220);
			width: 70rem;
			height: 25rem;
			border: solid 1px gray;
			border-radius: 1rem;
		}

		.msg_error-container {
			display: flex;
			width: 100%;
			height: 80%;
			justify-content: center;
		}

		.msg_error-wrapper {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			padding: 1rem;
			width: 100%;
		}

		.msg {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			font-size: 2.5rem;
			text-align: center;
			margin: auto;
		}

		.msg-text {
			font-weight: bold;
		}

		.msg-block {
			display: block;
			width: 100%;
			margin: auto;
		}

		.msg-block-text {
			display: block;
			width: 100%;
			text-align: center;
			font-weight: bold;
			font-size: 2.2rem;
		}

		.details {
			width: 100%;
			font-size: 2rem;
			height: 2rem;
		}

		.prefix {
			display: inline-block;
			width: 7rem;
			font-weight: bold;
			font-size: 1.4rem;
		}

		.text {
			font-weight: normal;
			font-size: 1.3rem;
		}

		.smile {
			display: inline-block;
			text-align: center;
			font-size: 2rem;
			margin: 1rem;
		}

		.box-comment {
			width: 100%;

		}

		.block-btns {
			height: 20%;
			margin-top: auto;
		}

		.btns-container {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
		}

		.btns-wrapper {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			width: 100%;
		}

		.block-btn {
			width: 50%;
			height: 20%;
		}

		.btn-wrapper {
			text-align: center;
			width: 100%;
		}

		.btn {
			width: 100%;
			font-weight: bolder;
			font-size: 1.3rem;
			display: inline-block;
			outline: none;
			color: black;
			cursor: pointer;
			text-decoration: none;
		}
	</style>
</head>

<body>
	<div class="ta_container">
		<div class="block-msg_error">
			<div class="msg_error-container">
				<div class="msg_error-wrapper">
					<div class="msg">
						<span class="msg-text"> Error</span>
						<div class="smile">☹️</div>
						<div class="msg-block">
							<span class="msg-block-text"><?= $msg ?></span>
						</div>
					</div>

					<?php
					if ($details && is_array($details)) {
						foreach ($details as $key => $result) { ?>
							<div class="details">
								<span class="prefix">
									<?= ucfirst($key) ?>
								</span>
								<span class="text"><?= $result ?></span>
							</div>
					<?php
						}
					}
					?>
				</div>

			</div>
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
</body>

</html>