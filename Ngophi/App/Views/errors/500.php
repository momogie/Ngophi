
<div style="background:#eaf6ff;margin:0px;padding:10px;border-radius:3px;border:solid 1px #90cafb">
<h1 style=" border-bottom:1px solid #dadada;clear:both; color:#666;font:24px Georgia,'Times New Roman',Times,serif;margin:5px 0 0 -4px; padding:5px;">Opps! Runtime Error.</h1>

<p style="font-size: 18px;color: darkred;font-style: italic;margin: 20px auto;"><?php echo $message; ?></p>
<?php if ( error_reporting() ):?>
<?php if( $file ): ?>
<p style="font-size:12px;"><strong> Source Error : </strong></p>
<pre style="color:#333;font:14px Consolas,Courier New,Verdana; background:#cee9ff;border:1px solid #7fbcef;margin:14px 0;padding:10px;border-radius:2px; overflow: auto;word-wrap: normal;white-space: pre;tab-size: 30px;">
<?php 
foreach($code as $v)
{
    echo preg_replace('~[\r\n]+~', '', $v) . '<br />' ;
}
?>
</pre>
<?php endif; ?>
<p style="font-size:12px;"><strong>Source File </strong> : <?php echo $file; ?> <strong> Line : </strong> <?php echo $line; ?></p>
<p style="font-size:12px;"><strong>Stack Trace : </strong></p>
<?php if ($trace): ?>
<pre style="color:#333;font:14px Consolas,Courier New,Verdana; background:#cee9ff;border:1px solid #7fbcef;margin:14px 0;padding:10px;border-radius:2px; overflow: auto;word-wrap: normal;white-space: pre;">
<?php echo str_replace(['<pre>', '</pre>'], '',$trace) ?>
</pre>
<?php endif; ?>
<?php endif; ?>
<div style="text-align: left; margin-top: 1.8em; border-top: 1px solid #dadada; padding-top: 1em; font-size: 0.7em;">
  <strong>Version Information : </strong>  Ngophi PHP Framework Alpha Version
</div>
</div>