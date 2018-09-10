<?php

namespace System\Core;

class ErrorHandler extends \ErrorException
{
	
    public $line;
    public $message;
    public $file;
	public static function Exception($exception)
    {

        $errorMessage = 'Error '. $exception->message.' in '. $exception->file .' line: '. $exception->line;

        @error_log($errorMessage);

        if (PHP_SAPI == 'cli') exit($errorMessage);


        if (!$exception->file) goto ByPass;

        $fileString     = file_get_contents($exception->file);
        $arrLine        = explode("\n", $fileString);
        $getLine        = array_combine(range(1, count($arrLine)), array_values($arrLine));
        $code           = [];

        for ($i = ($exception->line - 5 < 1 ? 1 : $exception->line - 5); $i <= ($exception->line+ 5 > count($arrLine) ? count($arrLine) : $exception->line + 5 ); $i++) 
        {
            $html = '<span style="margin-right:10px;'. ($exception->line == $i ? 'color:#DD0000;' : '') .'">Line '.$i.':</span>';

            $html .=  $exception->line == $i ? '<span style="color:#DD0000">' . htmlentities($getLine[$i])."</span>" : htmlentities($getLine[$i])."";

            $code[] = $html;
        }

        ByPass:

        return (new \System\Core\View())
        ->Load(
            Config::get('ERROR_PAGE_500'),
            (object)[
                'message'   => $exception->message,
                'file'      => $exception->file,
                'line'      => $exception->line,
                'code'      => $code,
                'trace'     => $exception->getTraceAsString()
            ]
        );
    }

    public static function Error($errno, $message, $file, $line)
    {
        throw new \ErrorException($message, 0, 1, $file, $line);
    }
}