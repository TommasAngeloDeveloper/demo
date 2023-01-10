<?php

namespace system\functions;

/****************************************************************************/
/* Работа с датой (данными) */
/****************************************************************************/
class Date
{
	/* Удаление старых временных юзеров */
	public static function old_date()
	{
		$rand = random_int(1, 100);
		if ($rand <= 10) {
			global $connect;
			$user_temp = "SELECT `id`,`time_old` FROM `site_users_temp`";
			$user_temp = $connect->query($user_temp);
			if ($user_temp) {
				if ($user_temp->num_rows > 0) {
					$date_now = date('d.m.Y');
					foreach ($user_temp as $result) {

						$id = 							$result['id'];
						$time_old = 					$result['time_old'];

						$time = $date_now - $time_old;
						$m = 60 * 60 * 24 * 30;							// 30 дней
						if ($time > $m) {
							$delet_userTemp = "DELETE FROM `site_users_temp` WHERE `id`='$id'";
							$delet_userTemp = $connect->query($delet_userTemp);
							if ($delet_userTemp) {
							} else {
							}
						}
					}
				}
			}
		}
	}
}
