<?php
date_default_timezone_set('Asia/Hong_Kong');
define("FRONT_PAGE","front");
define("SECRET_GATE","thisisjimletmein");
define('UPLOADS_DIR',dirname($_SERVER['DOCUMENT_ROOT']).'/uploads/');

define('DEFAULT_AFID',1);

define ('CURRENCY','Php');
// Membership Payments
define('ULTIMATE_PRICE',6980);
define('PREMIER_PRICE',3480);
define('BASIC_PRICE',1480);

// Earnings
define('ULTIMATE_PA',500); // P50 per point, meaning 10 points
define('ULTIMATE_GPA',1500); // P300 pesos per GPA, meaning 5 points 
define('PREMIER_PA',250); // P50 per point, meaning 5 points
define('PREMIER_GPA',600); // 2 points
define('BASIC_PA',150); // 3 points
define('BASIC_GPA',300); // 1 point

define('PA_PV',10); // P50 pesos per PA points
define('GPA_PV',300); // P300 pesos per GPA Points

// ENCRYPTION used - in GENEOLOGY
define('SECRET_KEY','francis123');
define('SECRET_IV','francis123iv');

if (preg_match('/.v2/', $_SERVER['HTTP_HOST'])) {
    define( 'ENV', 'local' );
} 
else {
	define( 'ENV', 'live' );
}

switch (ENV) {
	case 'local':
		define("DBHOST","localhost");  

		// user 1
		define("DBUSER","root");
    	define("DBPASS","");    	

    	// user 2
    	define("DBUSER2","zxcv");
    	define("DBPASS2",""); 

    	// user 3
    	define("DBUSER3","weurio");
    	define("DBPASS3",""); 

    	// user 4
    	define("DBUSER4","");
    	define("DBPASS4",""); 

    	// user 5
    	define("DBUSER5","yui");
    	define("DBPASS5",""); 

    	define("DBNAME","inlightv2");
		define("SITE_URL","http://inlight.v2");
		break;
	default:
		define("DBHOST","localhost");  

		// user 1
		define("DBUSER","franciu5_ilm");
    	define("DBPASS","c%f.uBx&5G+[");	

    	// user 2
		define("DBUSER2","franciu5_inlight");
		define("DBPASS2",";Bk8MBLS2oH,");

    	// user 3
		define("DBUSER3","franciu5_ingen");
    	define("DBPASS3","K?AH[oeZt]{#");

    	// user 4
    	// user 5

    	define("DBNAME","inlightv2");
		define("SITE_URL","http://inlight.v2");
}