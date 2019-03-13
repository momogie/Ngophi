<?php
namespace System\Core;
class Security
{

	/**
	* NOT DONE
	*/
	public static function clean_str($val ='')
    {
		return str_replace("'", "''", trim(strip_tags($val)));
	}

	/**
	* CSRF Anti cross site attack
	* use this after tag <form >
	* Example : <form action='<?php SELF_ACTION;?>' method='post'><?php Security::AntiForgeryToken();?></form>
	* don't forget to validate AntiForgeryToken in controller
	* use Security::ValidateAntiForgery(); in controller
	*/
	public static function AntiForgeryToken($pageid)
	{
        Session::set('csrf_token_'. $pageid, md5(md5(uniqid(rand(), true)).Config::HASH_KEYS));

        echo '<input type="hidden" value="'. Session::get('csrf_token_'. $pageid) .'" name="__RequestToken" />';
	}
	/**
	* Validation CSRF AntiForgeryToken
	* validate generated token in client side and server side
	*/
	public static function ValidateAntiForgery($pageid)
	{   
		if(Session::get('csrf_token_'.$pageid) != Request::post('__RequestToken') || empty(Request::post('__RequestToken'))){			
			ErrorHandler::ErrorCSRF();
			exit();
		}
	}
	/**
     * The XSS filter: This simply removes "code" from any data, used to prevent Cross-Site Scripting Attacks.
     *
     * A very simple introduction: Let's say an attackers changes its username from "John" to these lines:
     * "<script>var http = new XMLHttpRequest(); http.open('POST', 'example.com/my_account/delete.php', true);</script>"
     * This means, every user's browser would render "John" anymore, instead interpreting this JavaScript code, calling
     * the delete.php, in this case inside the project, in worse scenarios something like performing a bank transaction
     * or sending your cookie data (containing your remember-me-token) to somebody else.
     *
     * What is XSS ?
     * @see http://phpsecurity.readthedocs.org/en/latest/Cross-Site-Scripting-%28XSS%29.html
     *
     * FYI: htmlspecialchars() does this (from PHP docs):
     *
     * '&' (ampersand) becomes '&amp;'
     * '"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set.
     * "'" (single quote) becomes '&#039;' (or &apos;) only when ENT_QUOTES is set.
     * '<' (less than) becomes '&lt;'
     * '>' (greater than) becomes '&gt;'
     *
     * @see http://www.php.net/manual/en/function.htmlspecialchars.php
     *
     * @param  $value The value to be filtered
     * @return mixed    
     */
	public static function XSSFilter(&$value)
    {
        if (is_string($value)) {

            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        } else if (is_array($value) || is_object($value)) {
            
            foreach ($value as &$val) {
                self::XSSFilter($val);
            }
        }

        return $value;
    }
    
    public static function UniqueID()
    {
        return base64_encode( md5(base64_encode(uniqid() . date("Y-m-d H:i:s") . mt_rand())));
    }
}