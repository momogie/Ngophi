<?php ob_clean();?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $this->viewdata->message; ?></title>
<style type="text/css">
html
{
    background:rgba(0,0,0,0.05);
}
body
{
    background-color:#FFF;
    color:#333;
    font-family:"Lucida Grande",Verdana,Arial,sans-serif;
    margin:1em auto;
    width:70%;
    padding:1em 2em;
    border-radius:1px;
    border:1px solid rgba(0,0,0,0.2);
}
h1
{
    border-bottom:1px solid #dadada;
    clear:both;
    color:#666;
    font:24px Georgia,"Times New Roman",Times,serif;
    margin:5px 0 0 -4px; padding:5px;
}
p,li,dd,dt,td
{
    padding-bottom:2px;
    font-size:12px;
    line-height:17px;
}
h3{
    font-size:14px;
}
ul,ol,dl
{
    padding:5px 5px 5px 22px; 
}
pre {
    font:14px Consolas,Courier New,Verdana;
    background:#ffffce;
    border:1px solid #D0D0D0;
    display:block;
    margin:14px 0;
    padding:10px;
    border-radius:2px;
    overflow: auto;
    word-wrap: normal;
    white-space: pre;
}
</style>
</head>
<body>
<div>
<h1>Opps! Runtime Error.</h1>
<p style="font-size: 18px;color: darkred;font-style: italic;"><?php echo $this->viewdata->message; ?></p>
<?php if ( error_reporting() ):?>
<?php if( $this->viewdata->file ): ?>
<p><strong>Source Error :</strong></p>
<pre>
<?php 
foreach($this->viewdata->code as $code)
{
         echo $code;
}?>
</pre>
<?php endif; ?>
<p><strong>Source File</strong>:<?php echo $this->viewdata->file; ?> <strong>Line:</strong> <?php echo $this->viewdata->line; ?></p>
<p><strong>Stack Trace :</strong></p>
<?php if ($this->viewdata->trace): ?>
<pre>
<?php echo str_replace(['<pre>', '</pre>'], '',$this->viewdata->trace) ?>
</pre>
<?php endif; ?>
</div>
<?php endif; ?>
<div style="text-align: left; margin-top: 1.8em; border-top: 1px solid #dadada; padding-top: 1em; font-size: 0.7em;">
  <strong>Version Information : </strong>  Ngophi PHP Framework Alpha Version
</div>
</body>
</html>