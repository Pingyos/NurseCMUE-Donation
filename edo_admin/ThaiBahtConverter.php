<?php 
class ThaiBahtConverter
{
	protected static $numbers = ['', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];

	protected static $digits = ['สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];

	protected static $one_at_oneth = 'เอ็ด';

	protected static $two_at_tenth = 'ยี่';

	public static function convert($amount)
	{
		$number = floatval(str_replace(',', '', $amount));
		$number = number_format($number, 2, '.', '');

		if ((int) $number == 0) return 'ศูนย์บาท';

		// find stang portion
		if (($dot = strpos($number, '.')) > 0) {
			$stang = substr($number, $dot + 1);
			$stang = ((int) $stang > 0) ? $stang : '';

			$number = substr($number, 0, $dot);
		} else {
			$stang = '';
		}

		// pad string to multiple of 6
		$number = str_pad($number, ceil(strlen($number) / 6) * 6, ' ', STR_PAD_LEFT);

		$chunks = str_split($number, 6);

		$text = '';

		while (!empty($chunks)) {
			$segment = array_pop($chunks);
			$text = static::convertSegment($segment) . $text;
			if (!empty($chunks)) {
				$text = 'ล้าน' . $text;
			}
		}

		return $text . 'บาท' . (empty($stang) ? '' : (static::convertSegment($stang) . 'สตางค์'));
	}

	protected static function convertSegment($segment)
	{
		$segment = trim($segment);
		$length = strlen($segment);
		$last_digit = $length - 1;

		if ($length == 1) return static::$numbers[(int)$segment];

		$text = '';

		for ($nth = $last_digit; $nth >= 0; $nth--) {
			// any zero in any digit
			if ($segment[$nth] == '0') continue;

			// oneth digit
			if ($nth === $last_digit) {
				$digit = '';
				$number = ($segment[$nth] == '1' and $segment[$nth - 1] != '0')
					? static::$one_at_oneth
					: static::$numbers[(int)$segment[$nth]];
			}

			// tenth digit
			elseif ($nth === $last_digit - 1) {
				$digit = static::$digits[$last_digit - $nth - 1];

				if ($segment[$nth] === '1') {
					$number = '';
				} elseif ($segment[$nth] === '2') {
					$number = static::$two_at_tenth;
				} else {
					$number = static::$numbers[(int)$segment[$nth]];
				}
			}

			// other digits
			else {
				$number  = static::$numbers[(int)$segment[$nth]];
				$digit = static::$digits[$last_digit - $nth - 1];
			}

			$text = ($number . $digit) . $text;
		}

		return $text;
	}
}
