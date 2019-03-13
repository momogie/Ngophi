<?php
namespace System\Core\Exception;
use System\Core\Config;
use System\Core\View;
class RuntimeException extends \ErrorException
{
   
    public $line;
    public $message;
    public $file;

    /* ===================================================================================== */

	public static function Exception($exception)
    {

        $errorMessage = 'Error '. $exception->getMessage() .' in '. $exception->getFile() .' line: '. $exception->getLine();

        @error_log($errorMessage);

        if (PHP_SAPI == 'cli')
        {
            exit($errorMessage);
        }

        $code           = [];

        if (!$exception->getFile())
        {
            goto ByPass;
        }

        $fileString     = file_get_contents($exception->getFile());
        $arrLine        = explode("\n", $fileString);
        $getLine        = array_combine(range(1, count($arrLine)), array_values($arrLine));

        for ($i = ($exception->getLine() - 5 < 1 ? 1 : $exception->getLine() - 5); $i <= ($exception->getLine() + 5 > count($arrLine) ? count($arrLine) : $exception->getLine() + 5 ); $i++) 
        {
            $html = '<span style="margin-right:10px;'. ($exception->getLine() == $i ? 'color:#DD0000;' : '') .'">Line '.$i.':</span>';

            $html .=  $exception->getLine() == $i ? '<span style="color:#DD0000">' . htmlentities($getLine[$i]) . '</span>' : htmlentities($getLine[$i]);

            $code[] = $html;
        }

        ByPass:

        self::ErrorLogger($exception);
        if(!Config::get('DEBUG')) 
        {
            return;
        }

        return (new View(Config::get('ERROR_PAGE_500'),
        [
            'message'   => $exception->getMessage(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'code'      => $code,
            'trace'     => $exception->getTraceAsString()
        ]))
        ->Render();
    }

    /* ===================================================================================== */

    public static function Error() //$errno, $message, $file, $line
    {
        if(error_get_last())
        {
            $error = error_get_last();

            self::Exception(new \ErrorException($error['message'], $error['type'], 0, $error['file'], $error['line']));
        }
    }
    
    /* ===================================================================================== */

    public static function ErrorLogger(&$exception)
    {

        if (!file_exists(STORAGE_PATH . 'Logs/Errors/'  . date('Y-m-d'))) {
            mkdir(STORAGE_PATH . 'Logs/Errors/' . date('Y-m-d'), 0777, true);
        }
        $file = STORAGE_PATH . 'Logs/Errors/'  . date('Y-m-d'). DIRECTORY_SEPARATOR . 'JAM ' .date('H') . '.txt';

        $text = "\n¤----------------------------[". date("Y-m-d H:i:s") . "]------------------------------------¤\n";
        $text .= "Remote Addr.\t : [" . $_SERVER['REMOTE_ADDR'] .  "]\n" ;
        $text .= "Request Uri\t\t : " . $_SERVER['REQUEST_URI'] .  "\n" ;
        $text .= "Message\t\t\t : " . $exception->getMessage() . "\n" ;
        $text .= "File\t\t\t : " . $exception->getFile() . "\n" ;
        $text .= "Line\t\t\t : " . $exception->getLine() . "\n" ;
        $text .= "Stack Trace\t\t : \n" . $exception->getTraceAsString() ;
        $text .= "Data\t\t\t : \n" . 'GET => ' . var_export($_GET, true) . "\nPOST => " . var_export($_POST, true) ;
        $text .= "\n¤----------------------------[". date("Y-m-d H:i:s") . "]------------------------------------¤\n\n";

        file_put_contents($file,$text,FILE_APPEND | LOCK_EX);

    }
}