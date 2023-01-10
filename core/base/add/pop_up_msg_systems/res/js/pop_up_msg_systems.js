
$(document).ready(function () {
	/* Закрыть окно на весь экран */
	if (document.querySelectorAll('[data-fullScreen]').length > 0 && document.querySelectorAll('[data-fullScreenClose]').length > 0) {
		$('[data-fullScreenClose]').on('click', function () {
			var fullScreenClose = $(this);
			var fullScreen = $(fullScreenClose).closest('[data-fullScreen]');
			fullScreen.remove();
			//	fullScreen.css('display', 'none')
		});
	}
})