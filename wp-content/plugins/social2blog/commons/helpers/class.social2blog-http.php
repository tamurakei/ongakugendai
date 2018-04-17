<?php
if (! defined ( 'ABSPATH' ))
	exit ();

/**
 * Helper per la gestione delle chiamate http
 * @author bauhausk
 *
 */
class Social2blog_Http {

	/**
	 * Richiesta httpPost per ottenere un response in json
	 *
	 * @param string $url
	 * @param array $fields
	 *        	= array(
	 *        	'lname' => urlencode($last_name),
	 *        	'fname' => urlencode($first_name)
	 *        	);
	 */
	public static function requestHttp($url, $fields = null) {

// 		$fields_string = null;
// 		// url-ify the data for the POST
// 		foreach ( $fields as $key => $value ) {
// 			$fields_string .= $key . '=' . $value . '&';
// 		}
// 		rtrim ( $fields_string, '&' );


		$ch = curl_init ();
//		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (XkollWpSocialPlugin) Gecko/20100101 Firefox/17.0' );

		curl_setopt ( $ch, CURLOPT_URL, $url );
// 		curl_setopt ( $ch, CURLOPT_POST, count ( $fields ) );
// 		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields_string );

		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 90 );
// 		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );

		$data = curl_exec($ch);

		if(curl_exec($ch) === false)
		{
		    Social2blog_Log::error(curl_error($ch));
		}

		curl_close($ch);

		return 	$data;

	}

}
