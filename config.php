<?php
/*======== HOST =========================*/
$host = $_SERVER['SERVER_NAME'];          // gethostname();
$root = $_SERVER['DOCUMENT_ROOT'];
/*=======================================*/
$srv  = '';
$term = 'Spring_2013';
$tset = mktime(0, 0, 0, 1, 11, 2013);  // 11 AM, May-01, 2011  ::  MONTH | DAY | YEAR

switch ($host) {
    /*--------- LOCAL -----------------------*/
    case 'localhost':
    /*---------------------------------------*/
        error_reporting(E_ALL ^ E_DEPRECATED);
        $db_name  = 'its';
        $db_dsn   = 'mysql://root:csip@tcp(localhost:3306)/' . $db_name;
        $srv      = ''; // 'ITS'
        $CAS_path = '';
        break;
    /*--------- ITS.VIP.GATECH.EDU ----------*/
    case 'its.vip.gatech.edu':
    case 'itsdev2.vip.gatech.edu':
    case 'itsdev3.vip.gatech.edu':
    case 'itsdev4.vip.gatech.edu':
    case 'itsdev5.vip.gatech.edu':
        /*---------------------------------------*/
        $db_name   = 'its';
        $db_dsn    = 'mysql://root:csip@tcp(localhost:3306)/' . $db_name;
        $MDB2_path = '';
        $srv       = '/';
        break;
    /*---------------------------------------*/
    default:
}

define('INCLUDE_DIR', 'include/');
$files_dir = 'ITS_FILES';

/*======= OS TYPE =======================*/
if (PHP_OS == "WINNT") {
    $MDB2_path  = 'C:/xampp/php/pear/';
    $tex_path   = '/cgi-bin/mimetex.exe? ';    // TEX_PATH
    $files_path = '..' . $srv . '/ITS_FILES';  // RESOURCE_PATH (images etc.)
    $CAS_path   = '';
} else {
    switch ($host) {
        /*--------- LOCAL -----------------------*/
        case 'localhost':
        /*---------------------------------------*/
            $files_path = $srv . '/' . $files_dir;
            $files_path = $files_dir;
            break;
        /*--------- ITS.ECE.GATECH.EDU ----------*/
        case 'its.ece.gatech.edu':
        /*---------------------------------------*/  
            break;
        /*--------- ITS.VIP.GATECH.EDU ----------*/
        case 'its.vip.gatech.edu':
        case 'itsdev2.vip.gatech.edu':
        case 'itsdev3.vip.gatech.edu':
        case 'itsdev4.vip.gatech.edu':
        case 'itsdev5.vip.gatech.edu':
        case 'itsdev6.vip.gatech.edu':
        /*---------------------------------------*/
            $files_path = $files_dir;
        /*---------------------------------------*/
        default:
    }
    // PATHS
    $MDB2_path = ''; ///usr/share/php/';
    $tex_path  = '/cgi-bin/mathtex.cgi?\large ';
    $QTI_path  = $root.'/FILES/DATA/QTI';
     
    $dir = dirname($_SERVER['PHP_SELF']);
    preg_match('/ajax|admin|search|doc|ITS_FILES/', $dir, $ajax_match);
    //var_dump($ajax_match);//die('s');
    
    if (empty($ajax_match)) { // exclude /ajax dir	
        $MDB2_path = 'FILES/PEAR/';
        $MDB2_dir  = dir(getcwd() . '/' . $MDB2_path);

        if (empty($MDB2_dir->handle)) {
            die('<p>in ' . getcwd() . '/config.php:  <font color="red">MISSING <b>PEAR</b> folder</font>.<p>');
        }
        
        $CAS_path = 'FILES/CAS-1.1.1/';
        $CAS_dir  = dir(getcwd() . '/' . $CAS_path);
  
        if (empty($CAS_dir->handle)) {
            die('<p>in ' . getcwd() . '/config.php:  <font color="red">MISSING <b>CAS</b> folder</font>.<p>');
        }
    }
}
/*=======================================*/
// Set time zone: America/New_York
date_default_timezone_set('America/New_York');

$db_table_users      = 'users';
$db_table_user_state = 'stats_';
$db_table_user_cpt   = 'cpt_';
$db_table_question   = 'question';
$tb_name             = 'questions';
$tb_tags             = 'tags';
$tb_images			 = 'images';
$tb_question_diff    = 'questions_difficulty';

$tex_method 		 = 'mathtex';   // 'mathtex' | 'mathJax'

$question_dir      = "question";
$question_file_ext = 'html';
$answer_dir        = "answer";
$answer_file_ext   = 'html';
$BNT_dir           = "Debug";

global $db_dsn, $db_table_user_state, $db_table_user_cpt, $db_name, $tb_name, $tb_images, $tb_tags, $tb_question_diff, $files_path, $dir, $host, $CAS_path, $term, $tset,$tex_method,$tex_path;

/*--- httpd.conf --------------//
Alias /ITS_FILES/ "/var/www/ITS-RESOURCES/ITS_FILES/"
<Directory "/var/www/ITS-RESOURCES/ITS_FILES">
    Options Indexes MultiViews
    AllowOverride None
Order allow,deny
Allow from all
</Directory>
//-----------------------------*/
/*
echo '<table class="ITS_backtrace">';	
array_walk( debug_backtrace(), create_function( '$a,$b', 'print "<tr><td><font color=\"blue\">". basename( $a[\'file\'] ). "</b></font></td><td><font color=\"red\">{$a[\'line\']}</font></td><td><font color=\"green\">{$a[\'function\']}()</font></td><td>". dirname( $a[\'file\'] ). "/</td></tr>";' ) ); 	
echo '</table>';	
*/
/*
	echo '<pre>';
	print_r($data);
	echo '</pre>';
*/

/*
ALTER TABLE webct DROP COLUMN VIP_tags
RENAME TABLE webct TO questions
ALTER TABLE questions DROP image_id;
ALTER TABLE questions ADD images_id INT NOT NULL AFTER title;
* 
ALTER TABLE questions CHANGE images_id images_id INT DEFAULT NULL;
ALTER TABLE questions ADD FOREIGN KEY (`images_id`) REFERENCES `images` (`id`)
* 
ALTER TABLE questions CHANGE id questions_id INT NOT NULL;
SELECT * FROM KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'X' AND REFERENCED_COLUMN_NAME = 'X_id';
* 
CONSTRAINT `webct_mc_ibfk_1` FOREIGN KEY (`id`) REFERENCES `webct` (`id`) ON DELETE CASCADE
* 
mysqldump --single-transaction --skip-add-locks its -u root -p > GREG_Warmup.sql
mysqldump --single-transaction --skip-add-locks -t -u root -p its questions --where="id > 3469" > WQ_questions.sql
*/
?>
