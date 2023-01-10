
function isMobile() {
	if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
		|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
		return true;
	}
	return false;
}

function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
		vars[key] = value;
	});
	return vars;
}

//console.log(isMobile());

/* Проверка селектора */
function checkSelector(selector) {
	if ($(selector).is(':checked')) {
		return true;
	} else {
		return false;
	}

}
/* Сбрасываем форму */
function resetForm(form) {
	$(form)[0].reset();
}

/* Проверка координатов блока относительно ширины браузера */
function check_CoordinatesBlock(block_relative, block) {
	//var document_size = $(document).width();
	var document_size = block_relative;
	//var document_size = document.documentElement.clientWidth;
	const shift_size = 0.02;
	var block_width = $(block).width();
	var coordinates_block = $(block).offset().left;
	var check_coordinats = document_size - (coordinates_block + block_width);

	if (coordinates_block < 0) {
		$(block).offset({ left: document_size * shift_size });
	} else if (check_coordinats < 0) {
		$(block).css('left', check_coordinats * 4);
		var reCoordinates = coordinates_block + check_coordinats - (document_size * shift_size)
		///$(block).offset({ left: reCoordinates });
	}
	//console.log(coordinates_block);
}

/* Селекторы */
function selectors(array_selector) {
	$(array_selector).each(function (a, selector) {
		var type_selector = $(selector).attr('data-btn_selector');
		var color_off = $(selector).attr('data-color_off');
		var color_on = $(selector).attr('data-color_on');

		if (type_selector == 'selector_1') {
			var background = $(selector).attr('data-btn_checked_bg');
			var input_checked = $(selector).find('[data-input_checked]');
			var selector_off = $(selector).find('[data-selector_off]');
			var selector_on = $(selector).find('[data-selector_on]');
			var selector_bull_off = $(selector).find('[data-selector_bull_off]');
			var selector_bull_on = $(selector).find('[data-selector_bull_on]');
			var wrapper_selector = $(selector).find('[data-checked-wrapper_selector]');
			var textShadow = '0vw 0vw 2vw ';
			var boxShadow = '0 0.1vw 0.1vw';

			$(wrapper_selector).css("background", "rgb(" + background + ")");
			if ($(input_checked).is(':checked')) {

				$(selector_off).css("font-weight", "normal");
				$(selector_off).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");

				$(selector_off).css("background", "rgba(" + background + ", 0.5) linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0))");
				if (selector_bull_off.length > 0) {
					selector_bull_off.css("display", "none");
					selector_bull_off.css("box-shadow", "none");
				} else {
					$(selector_off).css("color", "black");
					$(selector_off).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
				}

				$(selector_on).css("color", "rgb(50, 205, 50)");
				$(selector_on).css("font-weight", "bold");
				$(selector_on).css("box-shadow", "inset " + boxShadow + " 0 rgba(255, 255, 255, 0.5), 0 0.2vw 0.5vw 0 rgba(0, 0, 0, 0.5)");
				$(selector_on).css("text-shadow", "" + textShadow + "rgba(50, 205, 50");
				$(selector_on).css("background", "linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3))");
				if (selector_bull_on.length > 0) {
					selector_bull_on.css("display", "block");
					selector_bull_on.css("background", "rgb(" + color_on + ")");
					selector_bull_on.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_on + ",0.5)");
				} else {
					$(selector_on).css("color", "rgb(" + color_on + ")");
					$(selector_on).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");

				}
			} else {
				$(selector_on).css("font-weight", "normal");
				$(selector_on).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");
				$(selector_on).css("background", "rgba(" + background + ", 0.5) linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0))");
				if (selector_bull_on.length > 0) {
					selector_bull_on.css("display", "none");
					selector_bull_on.css("box-shadow", "none");
				} else {
					$(selector_on).css("color", "black");
					$(selector_on).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
				}

				$(selector_off).css("color", "rgb(255, 64, 64)");
				$(selector_off).css("font-weight", "bold");
				$(selector_off).css("box-shadow", "inset " + boxShadow + " rgba(255, 255, 255, 0.5), 0 0.2vw 0.5vw 0 rgba(0, 0, 0, 0.5)");
				$(selector_off).css("text-shadow", " " + textShadow + " rgb(255, 64, 64)");
				$(selector_off).css("background", "linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3))");
				if (selector_bull_off.length > 0) {
					selector_bull_off.css("display", "block");
					selector_bull_off.css("background", "rgb(" + color_off + ")");
					selector_bull_off.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_off + ",0.5)");
				} else {
					$(selector_off).css("color", "rgb(" + color_off + ")");
					$(selector_off).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
				}

			}
		} else if (type_selector == 'selector_2') {
			var background = $(selector).attr('data-btn_checked_bg');
			var input_checked = $(selector).find('[data-input_checked]');
			var selector_off = $(selector).find('[data-selector_off]');
			var selector_on = $(selector).find('[data-selector_on]');
			var selector_ = $(selector).find('[data-selector]');
			var selector_bull = $(selector).find('[data-selector_bull]');
			var wrapper_selector = $(selector).find('[data-checked-wrapper_selector]');
			var textShadow = '0vw 0vw 2vw ';
			var boxShadow = '0 0.1vw 0.1vw';

			$(wrapper_selector).css("background", "rgb(" + background + ")");
			if ($(input_checked).is(':checked')) {

				//$(selector_off).css("font-weight", "normal");
				$(selector_).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");
				$(selector_).css("background", "rgba(" + background + ", 0.5) linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0))");

				$(selector_).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");
				$(selector_).css("background", "rgba(" + background + ", 0.5) linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0))");

				if (selector_bull.length > 0) {
					selector_bull.css("background", "rgb(" + color_on + ")");
					selector_bull.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_on + ",0.3)");
				} else {
					$(selector_on).css("display", "flex");
					$(selector_off).css("display", "none");
					$(selector_).css("color", "rgb(" + color_on + ")");
					$(selector_).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
				}
			} else {
				$(selector_).css("box-shadow", "inset " + boxShadow + " rgba(255, 255, 255, 0.5), 0 0.2vw 0.5vw 0 rgba(0, 0, 0, 0.5)");
				$(selector_).css("background", "linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.3))");
				if (selector_bull.length > 0) {
					//selector_bull.css("background", "rgb(" + color_off + ")");
					selector_bull.css("background", "radial-gradient(rgba(" + color_off + ",1), rgba(" + color_off + ",0.7))");
					selector_bull.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_off + ",0.5)");
				} else {
					$(selector_on).css("display", "none");
					$(selector_off).css("display", "flex");
					$(selector_).css("color", "rgb(" + color_off + ")");
					$(selector_).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
				}

			}
		} else if (type_selector == 'selector_3') {
			var background = $(selector).attr('data-btn_checked_bg');
			var input_checked = $(selector).find('[data-input_checked]');
			var selector_off = $(selector).find('[data-selector_off]');
			var selector_on = $(selector).find('[data-selector_on]');
			var selector_bull_off = $(selector).find('[data-selector_bull_off]');
			var selector_bull_on = $(selector).find('[data-selector_bull_on]');
			var container_selector = $(selector).find('[data-checked-container_selector]');
			var selector_btn_container = $(selector).find('[data-selector_btn_container]');
			var selector_btn = $(selector).find('[data-selector_btn]');
			var select = $(selector).find('[data-select]');
			var textShadow = '0vw 0vw 2vw ';
			var boxShadow = '0 0.1vw 0.1vw';
			var color_off = $(selector).attr('data-color_off');
			var color_on = $(selector).attr('data-color_on');

			//$(selector_off).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");
			$(select).css("box-shadow", "" + boxShadow + " rgb(0 0 0 / 50%) inset, 0 1px 0 rgb(255 255 255 / 40%)");
			$(container_selector).css("background", "rgb(" + background + ")");
			$(selector_btn).css("box-shadow", "inset " + boxShadow + " 0 rgba(255, 255, 255, 0.5), 0 0.2vw 0.5vw 0 rgba(0, 0, 0, 0.5)");
			//$(selector_btn).css("background", "#ccc linear-gradient(#fcfff4 0%, #B0C4DE 40%, #B0C4DE 100%)");
			if (selector_bull_on.length > 0) {
				selector_bull_on.css("display", "block");
				selector_bull_on.css("background", "rgb(" + color_on + ")");
				selector_bull_on.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_on + ",0.5)");
			} else {
				$(selector_on).css("color", "rgb(" + color_on + ")");
				$(selector_on).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
			}
			if (selector_bull_off.length > 0) {
				selector_bull_off.css("display", "block");
				selector_bull_off.css("background", "rgb(" + color_off + ")");
				selector_bull_off.css("box-shadow", "0 0 0.5vw 0.2vw rgba(" + color_off + ",0.5)");
			} else {
				$(selector_off).css("color", "rgb(" + color_off + ")");
				$(selector_off).css("text-shadow", "" + textShadow + " rgba(0, 0, 0, 0.5)");
			}
			if ($(input_checked).is(':checked')) {
				$(selector_btn_container).css("right", "0%");
			} else {
				$(selector_btn_container).css("right", "50%");
			}
		}
	});

}
function testClick(block) {
	$(block).each(function (a, btn) {
		$(btn).mouseup(function (e) { // событие клика по веб-документу
			var ColorPicker = $(btn); // тут указываем ID элемента
			//console.log($(ColorPicker).find('[ColorPickerFront]'));
			if (!ColorPicker.is(e.target) // если клик был не по нашему блоку
				&& ColorPicker.has(e.target).length === 0) { // и не по его дочерним элементам
				console.log('click');
			}

		});
	})
}
/* Функция проверки клика вне блока */
function click_noBlock(click_block) {
	$(document).mouseup(function (e) { // событие клика по веб-документу
		var block = $(click_block); // тут указываем ID элемента
		//console.log($(ColorPicker).find('[ColorPickerFront]'));
		if (!block.is(e.target) // если клик был не по нашему блоку
			&& block.has(e.target).length === 0) { // и не по его дочерним элементам
			console.log(block);
			/*
						if (ColorPicker && ColorPicker.find('[ColorPickerFront]').attr('data-ColorPickerFront') != 'off') {
							var shecked = $(ColorPicker).find('[data-ColorPickerFront]').attr('data-ColorPickerFront');
			
							if (shecked == 'on') {
			
								$(this).find('[data-ColorPickerPalitere]').css('display', 'none');
								$(this).find('[data-ColorPickerFront]').attr('data-ColorPickerFront', 'off');
			
							}
			
						}
						*/
		}

	});
}
/* Функция добавления значений в  ColopPicker_inputs*/
function addVal_colorPicker(array_ColorPicker) {
	$(array_ColorPicker).each(function (a, ColorPicker) {

		var ColorPickerInput_hex = $(ColorPicker).find('[data-ColorPickerInput="hex"]');
		var val = $(ColorPickerInput_hex).val();
		console.log(val);
		if (val != '') {
			$(ColorPicker).find('[data-colorPreview]').css("background", ColorPickerInput_hex);
		}

	});
}

/* Функция проверки ColopPicker_inputs */
function checkValue_ColopPicker_inputs(array_ColorPicker) {

	$(array_ColorPicker).each(function (a, ColorPicker) {

		var ColorPickerInput_hex = $(ColorPicker).find('[data-ColorPickerInput="hex"]');
		var val = ColorPickerInput_hex.val();
		//console.log(val);
		if (val != '') {
			$(ColorPicker).find('[data-colorPreview]').css("background", ColorPickerInput_hex);
		}

	});

}


$(document).ready(function () {
	if (document.querySelectorAll('[data-ColorPicker]').length > 0) {

		var ColorPicker = document.querySelectorAll('[data-ColorPicker]');
		checkValue_ColopPicker_inputs(ColorPicker);
		/*
		var top = $(ColorPicker).offset().top;
		var left = $(ColorPicker).offset().left;
		var width = $(ColorPicker).width();
*/
		//console.log(width);
	};
	/*****************************************/
	/* Функция смены иконок в Color Picker */
	/*****************************************/
	function colorPicker_checkIMG(colorPicker) {
		var ColorPickerInput = $(colorPicker).find('[data-ColorPickerInput]');
		var container_imgColorPicker = $(colorPicker).find('[data-container_imgColorPicker]');
		var container_previewColorPicker = $(colorPicker).find('[data-container_previewColorPicker]');

		if (ColorPickerInput.val() == '') {
			container_imgColorPicker.css('display', 'inline-flex');
			container_previewColorPicker.css('display', 'none');
		} else {
			container_imgColorPicker.css('display', 'none');
			container_previewColorPicker.css('display', 'inline-block');
		}
	}
	/* Вызываем функцию смены иконки Color Picker */
	if ($(document).find('[data-ColorPicker]').length > 0) {
		colorPicker_checkIMG($(document).find('[data-ColorPicker]'));
	}


	/***********************************************************/
	/* Функция клика не по блоку */
	/***********************************************************/

	/*
		jQuery(function ($) {
			$(document).mouseup(function (e) { // событие клика по веб-документу
				var ColorPicker = $("[data-ColorPicker]"); // тут указываем ID элемента
				console.log(ColorPicker);
				
				$(array_selector).each(function (a, ColorPicker) {
				});
				
				if (ColorPicker && ColorPicker.find('[ColorPickerFront]').attr('data-ColorPickerFront') != 'off') {
					if (!ColorPicker.is(e.target) // если клик был не по нашему блоку
						&& ColorPicker.has(e.target).length === 0) { // и не по его дочерним элементам
						var shecked = $(this).find('[data-ColorPickerFront]').attr('data-ColorPickerFront');
						if (shecked == 'on') {
							$(this).find('[data-ColorPickerPalitere]').css('display', 'none');
							$(this).find('[data-ColorPickerFront]').attr('data-ColorPickerFront', 'off');
						}
	
					}
				}
	
			});
		});
	*/
	if ($(document).find('[data-clouse="msg"]')) {
		var atr = $(document).find('[data-clouse="msg"]');
		$(atr).on('click', atr, function () {
			$(this).closest("#msg").remove();
		});
	}

	const user_menu = document.querySelectorAll('[data-user_menu]');
	$(user_menu).on('click', function () {
		var src = $(this).attr('data-user_menu');
		if (src == 'off') {
			$(this).attr('data-user_menu', 'on');
			$("#menu").css("display", "block");
		} else {
			$(this).attr('data-user_menu', 'off');
			$("#menu").css("display", "none");

		}
	})

	/***************************************/
	/* Input Download */
	/***************************************/

	// Функция превью изображения

	function readURL(input) {
		var containerPreview = input.closest('[data-containerPreview]');
		if (containerPreview) {
			var PreviewImg = $(containerPreview).find('[data-PreviewImg]');
			if (PreviewImg) {
				var containerButtons = $(containerPreview).find('[data-containerButtons]');
				if (containerButtons) {
					containerButtons.css("display", "flex");
				}

				if (input.files && input.files[0]) {

					var reader = new FileReader();

					reader.onload = function (e) {
						$(PreviewImg).attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}

			}

		}

	}
	$('.download_file-input').change(function () {
		readURL(this);
	});
	/* функция смены текста */
	function uploadText(containerUpload, check) {
		var containerUpload_input = $(containerUpload).find('[data-containerUpload_input]');
		var containerUpload_text = $(containerUpload).find('[data-containerUpload_text]');
		var containerUpload_img = $(containerUpload).find('[data-containerUpload_img]');
		if (check == 'off') {
			$(containerUpload_text).text('Файл');
			$(containerUpload_text).css("font-weight", "bold");
			$(containerUpload_text).css("font-size", "1vw");
			if (containerUpload_img) {
				$(containerUpload_img).css("display", "flex");
			}

		} else {

			$(containerUpload_text).css("font-weight", "normal");
			$(containerUpload_text).css("font-size", "0.7vw");
			if (containerUpload_img) {
				$(containerUpload_img).css("display", "none");
			}
		}
	}

	if (document.querySelectorAll('[data-containerUpload]').length > 0) {
		var block_download = document.querySelectorAll('[data-containerUpload]');

		/* При клике на блок */
		$(block_download).on('click', function () {
			/* Ищем дочерний элемент по классу */
			var input_download = $(this).find('[data-containerUpload_input]');

			/* При выборе файла */
			$(input_download).on('change', function () {
				/* ? */
				var splittedFakePath = this.value.split('\\');
				/* Ищем родителя элемента по тегу */
				var containerUpload = $(this).closest('[data-containerUpload]');
				/* Ищем потомка по классу */
				var containerUpload_text = $(containerUpload).find('[data-containerUpload_text]');
				/* Вставляем имя загружаемого файла */
				$(containerUpload_text).text(splittedFakePath[splittedFakePath.length - 1]);

				var fileName = splittedFakePath[splittedFakePath.length - 1];

				if (fileName) {
					uploadText(containerUpload, '');
					$(containerUpload_text).text(fileName);
				} else {
					uploadText(containerUpload, 'off');
				}
				/*****************************************/

			});
		});
	}

	/***************************************/
	/* Input Checked  SELECTOR */
	/***************************************/

	if (document.querySelectorAll('[data-btn_selector]').length > 0) {
		var btn_selector = document.querySelectorAll('[data-btn_selector]');
		selectors(btn_selector);
		$(btn_selector).on('click', function () {
			var btn_checked = $(this);
			var input_checked = $(btn_checked).find('[data-input_checked]');
			if ($(input_checked).is(':checked')) {
				$(input_checked).prop('checked', false);
			} else {
				$(input_checked).prop('checked', true);
			}
			selectors(btn_checked);
		})
	}




	/* Функция Color Picker (Палитра) */
	if (document.querySelectorAll('[data-ColorPicker]').length > 0) {
		document.querySelectorAll('[data-ColorPicker]')
		$('[data-ColorPickerFront]').on('click', function () {

			var ColorPickerFront = $(this);
			var ColorPicker = ColorPickerFront.closest('[data-ColorPicker]');
			var ColorPickerPalitere = $(ColorPicker).find('[data-ColorPickerPalitere]');
			//var ColorPickerFront = ColorPicker.find('[data-ColorPickerFront]');
			var check = $(ColorPickerFront).attr('data-ColorPickerFront');




			if (check == 'off') {

				var block_document = $(document).width();
				var coordinates_block = $(ColorPickerFront).offset().left;
				var width_blockPalitere = $(ColorPickerPalitere).width();
				var width_blockBtnColorPicker = $(ColorPickerFront).width();
				var check = block_document - coordinates_block;

				ColorPickerFront.attr('data-ColorPickerFront', 'on');
				ColorPickerPalitere.css("display", "flex");
				if (coordinates_block - width_blockPalitere < 0) {
					var coord = width_blockBtnColorPicker;
					$(ColorPickerPalitere).css('left', coord);
				} else if (check < width_blockPalitere) {
					var coord = ((width_blockPalitere - width_blockBtnColorPicker) * -1);
					$(ColorPickerPalitere).css('left', coord);
				}
				var check_color = ColorPicker.find('[data-ta_colorPreview]').attr('data-ta_colorPreview');
				var save_color = ColorPicker.find('[data-ta_colorPreview]').css("background");
				if (check_color == '') {
					ColorPicker.find('[data-ta_colorPreview]').attr('data-ta_colorPreview', save_color);
					console.log(check_color);
				}
				//ColorPicker.find('[data-ta_colorPreview]').attr('data-ta_colorPreview', save_color);


				//check_CoordinatesBlock(block_relative, ColorPickerPalitere);
				//console.log(ColorPickerPalitere.position());
				/*
				var width = $(ColorPickerPalitere).width();
				if (coordinates_palitereLeft < 0) {
					$(ColorPickerPalitere).offset({ left: 5 });
				}
				var check_coordinats = document_size - (coordinates_palitereLeft + width);
				if (check_coordinats < 0) {
					$(ColorPickerPalitere).offset({ left: coordinates_palitereLeft + check_coordinats - (document_size * 0.02) });
				}
				console.log(check_coordinats);
				/* 
				if (document_size - coordinates_palitereLeft > width) {
					var palitere_reCoord = document_size - coordinates_palitereLeft - width;
					$(ColorPickerPalitere).offset({ left: coordinates_palitereLeft - (palitere_reCoord * 2) });
				}
				*/
				//console.log('width_doc=' + document_size, '; width_block=' + width, '; coord_block=' + coordinates_palitereLeft);
				//console.log(document_size - coordinates_palitereLeft)
			} else if (check == 'on') {
				ColorPickerPalitere.css("display", "none");
				ColorPickerFront.attr('data-ColorPickerFront', 'off');
			}
			click_noBlock(ColorPicker);
		})
		$('[data-ColorPickerColors]').on('click', function () {
			var color = $(this);


			var color_hex = color.find('[data-ColorPickerColor="hex"]').val();
			var color_rgb = color.find('[data-ColorPickerColor="rgb"]').val();
			var ColorPicker = color.closest('[data-ColorPicker]');
			var ColorPickerInput_hex = $(ColorPicker).find('[data-ColorPickerInput="hex"]');
			var ColorPickerInput_rgb = $(ColorPicker).find('[data-ColorPickerInput="rgb"]');
			var colorPreview = ColorPicker.find('[data-colorPreview]');
			var colorNone = ColorPicker.find('[data-colorNone]');
			var container_previewColorPicker = ColorPicker.find('[data-colocontainer_previewColorPickerrNone]');
			var container_imgColorPicker = ColorPicker.find('[data-container_imgColorPicker]');
			var valueColor = color.val();

			var btn_cancel = color.attr('data-ColorPickerColors');
			if (btn_cancel == 'return') {
				var default_color = ColorPicker.find('[data-ta_colorPreview]').attr('data-ta_colorPreview');
				ColorPicker.find('[data-ta_colorPreview]').css("background", default_color);
				ColorPickerInput_hex.val('');
				ColorPickerInput_rgb.val('');
			}
			ColorPickerInput_hex.val(color_hex);
			ColorPickerInput_rgb.val(color_rgb);
			if (color_hex == 'none') {
				colorNone.css("display", "inline-flex");
			} else {
				colorNone.css("display", "none");
			}
			colorPreview.css("background", color_hex);
			colorPicker_checkIMG(ColorPicker);
			click_noBlock(ColorPicker);
		})
		//click_noBlock(ColorPicker);
		/*
		click_noBlock(ColorPicker);
*/
	}

	/* Закрыть окно на весь экран */
	if (document.querySelectorAll('[data-fullScreen]').length > 0 && document.querySelectorAll('[data-fullScreenClose]').length > 0) {
		$('[data-fullScreenClose]').on('click', function () {
			var fullScreenClose = $(this);
			var fullScreen = $(fullScreenClose).closest('[data-fullScreen]');
			fullScreen.css('display', 'none')
			var form = $(fullScreen).attr('data-fullScreenForms');
			if (form != undefined) {
				resetForm(form);
			}
		});
	}
})

