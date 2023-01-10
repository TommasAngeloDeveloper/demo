<?php

/****************************************************************************/
/* Отправка Почты */
/****************************************************************************/
class ta_Mail
{
	public static function confirm_mail($mail, $siteMail, $subject, $message)
	{

		$mail = $mail;																						// Кому отправить
		$subject = $subject;																				// Тема письма
		$headers  = "Content-type: text/html; charset=utf-8 \r\n";							// Тип и формат отправленного письма
		$headers .= "From: " . $siteMail . "";														// От кого отправлено
		$message = $message;																				// Сообщение письма;
		mail($mail, $subject, $message, $headers);
	}
}
