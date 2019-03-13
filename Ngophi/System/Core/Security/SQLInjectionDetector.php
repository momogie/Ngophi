<?php

namespace System\Core\Security;
/**
 * simpleSQLinjectionDetect Class
 * @link      https://github.com/bs4creations/simpleSQLinjectionDetect 
 * @version   1.1
 */
class SQLInjectionDetector
{
   
    static function Run()
    {
        $a = new SQLInjectionDetector;
        $a->detect();
    }

    protected $_method  = array();
    protected $_suspect = null; 

    public $_options = array(
                            'log'    => true,
                            'unset'  => false,
                            'exit'   => false,
                            'errMsg' => 'Not allowed',
                        );

    public function detect()
    {
        self::setMethod();

        if(!empty($this->_method))
        {
            $result = self::parseQuery();

            if ($result)
            {
                if ($this->_options['log']) {
                    self::logQuery();
                }

                if ($this->_options['unset']){
                    unset($_GET, $_POST);
                }

                if ($this->_options['exit']){
                    exit($this->_options['errMsg']);
                }
            }
        }
    }

    private function setMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->_method = $_GET;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->_method = $_POST;
        }
    }

    private function parseQuery()
    {
        $operators = array(
            'select * ',
            'select ',
            'union all ',
            'union ',
            ' all ',
            ' where ',
            ' and 1 ',
            ' and ',
            ' or ',
            ' 1=1 ',
            ' 2=2 ',
            '-- ',
        );

        foreach($this->_method as $key => $val)
        {
            $k = urldecode(strtolower($key));
            $v = urldecode(strtolower($val));

            foreach($operators as $operator)
            {
                if (preg_match("/".$operator."/i", $k)) {
                    $this->_suspect = "operator: '".$operator."', key: '".$k."'";
                    return true;
                }
                if (preg_match("/".$operator."/i", $v)) {
                    $this->_suspect = "operator: '".$operator."', val: '".$v."'";
                    return true;
                }
            }
        }
    }

    private function logQuery()
    {
        

        if (!file_exists(STORAGE_PATH . 'Logs/SqlInjection/'  . date('Y-m-d'))) {
            mkdir(STORAGE_PATH . 'Logs/SqlInjection/' . date('Y-m-d'), 0777, true);
        }
        $file = STORAGE_PATH . 'Logs/SqlInjection/'  . date('Y-m-d'). DIRECTORY_SEPARATOR . 'JAM ' . date('H i s') . '.txt';
        
        $text = "\n¤----------------------------[". date("Y-m-d H:i:s") . "]------------------------------------¤\n";
        $text .= "Remote Addr.\t : [" . $_SERVER['REMOTE_ADDR'] .  "]\n" ;
        $text .= "Request Uri\t\t : " . $_SERVER['REQUEST_URI'] .  "\n" ;
        $text .= 'Suspect: ['.$this->_suspect.'] ' .  "\n" ;
        

        $text .= "Data\t\t\t : \n" . 'GET => ' . var_export($_GET, true) . "\nPOST => " . var_export($_POST, true). "\nPOST => " . var_export($_SERVER, true) ;
        $text .= "\n¤----------------------------[". date("Y-m-d H:i:s") . "]------------------------------------¤\n\n";
        @file_put_contents($file, $text . PHP_EOL, FILE_APPEND);
    }
    
}

/**
 * XD Ran Control Panel
 *
 * Do not edit or add to this file if you wish to upgrade site to newer
 * versions in the future. If you wish to customize site for your
 * needs please refer to dutch_x@ymail.com for more information.
 *
 *(
 * @copyright  Copyright (c) 2011 XD Web (dutch_X@ymail.com)
 *
 */
// error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
// if (eregi("webset.php", $_SERVER['SCRIPT_NAME'])) { die (include('404.php')); }
// include ('App/includes.php');
// include ('ksantiddos.php');
// $EnD = mssql_fetch_array(mssql_query("SELECT * FROM $dfsql[db1].dbo.enable_disable"));
// $set = mssql_query("SELECT * FROM $dfsql[db1].dbo.Settings");
// while($i=mssql_fetch_array($set)) {
// $folder = "$i[Folder]"; /* folder name always insert ( / ) example /siege if there is no folder just blank */
// $host['ip'] = "";
// $host['user'] = "$i[UserName]";
// $host['pass'] = "$i[Pass]";
// $host['sec'] = "$i[Clog]";
// $dfconfig['web_title'] = "$i[Web_title]";
// $web_t ="$i[Web_t]";
// $dfconfig['max_rb'] = "$i[max_rb]";
// $points_name ="$i[Points_name]";
// $dfconfig['gt_m'] = "$i[gt_m]"; //GAME TIME how minutes per points //
// $dfconfig['gt_p'] = "$i[gt_p]"; //GAME TIME points per minutes

// $dfconfig['g_g'] = "$i[g_g]"; //GOLD TO POINTS how minutes per points//
// $dfconfig['g_p'] = "$i[g_p]"; //GOLD TO POINTS points per minutes

// $dfconfig['rstats_gold'] = "$i[rstats_gold]";
// // change skull gold
// $dfconfig['cschool_gold'] = "$i[cschool_points]";
// // change skull gold
// $dfconfig['cschool_points'] = "$i[cschool_points]";


// // change name gold
// $dfconfig['cname_gold'] = "$i[cname_gold]";

// // itemshop
// $dfconfig['shop_per_page'] = "$i[shop_per_page]";

// $serviceNum1 = "$i[serviceNum1]";
// $serviceNum2 = "$i[serviceNum2]";
// //Reborn Settings
// // 1st Reborn
// $rb_reward = "$i[rb_reward]";
// $rb1_g[lvl] = "$i[rb1_g_lvl]"; // level for rb
// $rb1_g[m] = "$i[rb1_g_m]";	// max for rb
// $rb1_g[gold] = "$i[rb1_g_gold]"; // gold for rb
// // 2 Reborn
// $rb2_g[lvl] = "$i[rb2_g_lvl]"; // level for rb
// $rb2_g[m] = "$i[rb2_g_m]";	// max for rb
// $rb2_g[gold] = "$i[rb2_g_gold]"; // gold for rb
// // 3 Reborn
// $rb3_g[lvl] = "$i[rb3_g_lvl]"; // level for rb
// $rb3_g[m] = "$i[rb3_g_m]";	// max for rb
// $rb3_g[gold] = "$i[rb3_g_gold]"; // gold for rb
// // 4 Reborn
// $rb4_g[lvl] = "$i[rb4_g_lvl]"; // level for rb
// $rb4_g[m] = "$i[rb4_g_m]";	// max for rb
// $rb4_g[gold] = "$i[rb4_g_gold]"; // gold for rb
// // 5 Reborn
// $rb5_g[lvl] = "$i[rb5_g_lvl]"; // level for rb
// $rb5_g[m] = "$i[rb5_g_m]";	// max for rb
// $rb5_g[gold] = "$i[rb5_g_gold]"; // gold for rb


// $rb[limitmax] = "$i[rb_limitmax]"; 
// $rb[fame] = "$dfconfig[max_rb]"; 


// $link_g = "$i[link_g]";
// $link_f = "$i[link_f]";
// $video = "images/video";
// $cfg['footer'] = "$i[footer]";

// // Votes
// $vPoints = "MQ=="; // How many points per vote
// $vname1 = "$i[vname1]"; // Vote name
// $v1 = "$i[v1]"; // Vote Links
// $vname2 = "$i[vname2]";
// $v2 = "$i[v2]";




// //Intro 0 Disable 1 Enable
// $intro = "$i[intro]";
// $introurl = "$i[introurl]";




// $clear_gold = "$i[clear_gold]";
// $rbc_lvl = "$i[rbtorbpoints]";
// $announcement = "$i[Announce_text]";



// }




// $cset = mssql_query("SELECT * FROM $dfsql[db1].dbo.Convertion");
// while($c=mssql_fetch_array($cset)) {
	
// $vtp = $c[vtp];
// $gtv = $c[gtv];
// $ptv = $c[ptv];
// $rtp = $c[rtp];
// $rtr = $c[rtr];
// $ptr = $c[ptb];	
// $ptv2 = $c[ptv2];
// $ptr2 = $c[ptr2];

// $rtp_lvl = "$c[rtp_lvl]";
// $rtp_gold = "$c[rtp_gold]";
// $rtp_rb = "$c[rtp_rb]";
// $rtp_stats = "$c[rtp_stats]";
// $rtr_lvl = "$c[rtr_lvl]";
// $rtr_gold = "$c[rtr_gold]";
// $rtr_rb = "$c[rtr_rb]";
// $rtr_stats = "$c[rtr_stats]";

// $ptg = "$c[ptg]";
// $ptg1 = "$c[ptg1]";	
// }



// function anti_injection($sql) {
//    $sql = preg_replace(sql_regcase("/(from|DROP|SELECT|UPDATE|DELETE|WHERE|select|update|distinct|having|truncate|replace|like|insert|group by|desc|order by|delete|where|;|,|'|<|>|\\|=|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
//    $sql = trim($sql);
//    $sql = strip_tags($sql);
//    $sql = addslashes($sql);
//    return $sql;
// }





// if ($_SESSION["admin"]==NULL)
// {
// $ip = $_SERVER['REMOTE_ADDR']; 
// $time = date("l dS of F Y h:i:s A"); 
// $script = $_SERVER[PATH_TRANSLATED]; 
// $fp = fopen ("[WEB]SQL_Injection.txt", "a+"); 
// $sql_inject_1 = array(";","'","%",'"'); #Whoth need replace 
// $sql_inject_2 = array("", "","","&quot;"); #To wont replace 
// $GET_KEY = array_keys($_GET); #array keys from $_GET 
// $POST_KEY = array_keys($_POST); #array keys from $_POST 
// $COOKIE_KEY = array_keys($_COOKIE); #array keys from $_COOKIE 
// /*begin clear $_GET */ 
// for($i=0;$i<count($GET_KEY);$i++) 
// { 
// $real_get[$i] = $_GET[$GET_KEY[$i]]; 
// $_GET[$GET_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_GET[$GET_KEY[$i]])); 
// if($real_get[$i] != $_GET[$GET_KEY[$i]]) 
// { 
// fwrite ($fp, "IP: $ip\r\n"); 
// fwrite ($fp, "Method: GET\r\n"); 
// fwrite ($fp, "Value: $real_get[$i]\r\n"); 
// fwrite ($fp, "Script: $script\r\n"); 
// fwrite ($fp, "Time: $time\r\n"); 
// fwrite ($fp, "==================================\r\n"); 
// } 
// } 
// /*end clear $_GET */ 
// /*begin clear $_POST */ 
// for($i=0;$i<count($POST_KEY);$i++) 
// { 
// $real_post[$i] = $_POST[$POST_KEY[$i]]; 
// $_POST[$POST_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_POST[$POST_KEY[$i]])); 
// if($real_post[$i] != $_POST[$POST_KEY[$i]]) 
// { 
// fwrite ($fp, "IP: $ip\r\n"); 
// fwrite ($fp, "Method: POST\r\n"); 
// fwrite ($fp, "Value: $real_post[$i]\r\n"); 
// fwrite ($fp, "Script: $script\r\n"); 
// fwrite ($fp, "Time: $time\r\n"); 
// fwrite ($fp, "==================================\r\n"); 
// } 
// } 
// /*end clear $_POST */ 
// /*begin clear $_COOKIE */ 
// for($i=0;$i<count($COOKIE_KEY);$i++) 
// { 
// $real_cookie[$i] = $_COOKIE[$COOKIE_KEY[$i]]; 
// $_COOKIE[$COOKIE_KEY[$i]] = str_replace($sql_inject_1, $sql_inject_2, HtmlSpecialChars($_COOKIE[$COOKIE_KEY[$i]])); 
// if($real_cookie[$i] != $_COOKIE[$COOKIE_KEY[$i]]) 
// { 
// fwrite ($fp, "IP: $ip\r\n"); 
// fwrite ($fp, "Method: COOKIE\r\n"); 
// fwrite ($fp, "Value: $real_cookie[$i]\r\n"); 
// fwrite ($fp, "Script: $script\r\n"); 
// fwrite ($fp, "Time: $time\r\n"); 
// fwrite ($fp, "==================================\r\n"); 
// } 
// } 

// /*end clear $_COOKIE */ 
// fclose ($fp);  
// }


