/*
// ширина и высота всего экрана: монитора или мобильного дисплея
const screenWidth = window.screen.width
const screenHeight = window.screen.height
// ширина и высота активного экрана без панели инструментов операционной системы
const availableScreenWidth = window.screen.availWidth
const availableScreenHeight = window.screen.availHeight
//  ширина и высота текущего окна браузера, включая адресную строку, панель вкладок и другие панели браузера
const windowOuterWidth = window.outerWidth
const windowOuterHeight = window.outerHeight
// внутренний размер окна с полосой прокрутки
const windowInnerWidth_1 = window.innerWidth
const windowInnerHeight_1 = window.innerHeight
// внутренний размер окна без полос прокрутки
const windowInnerWidth_2 = document.documentElement.clientWidth
const windowInnerHeight_2 = document.documentElement.clientHeight
var font_size = screenWidth /
	$(document).ready(function () {

		//	console.log(screenWidth);
		//	Math.round(x)
	})
	*/
/*****************************************************************************/
/*  Создает новый блок */
/*****************************************************************************/
function add_element(block, new_block) {
	var block = document.querySelector('body');
	const add = block.insertAdjacentHTML('afterbegin', `` + new_block + ``)
	return add;
}