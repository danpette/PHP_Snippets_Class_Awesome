error_reporting(E_ALL);
ini_set('display_errors', 1);

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();

$timeout = 5;  /* thirty seconds for timeout */
$link = mysqli_init( );
$link->options( MYSQLI_OPT_CONNECT_TIMEOUT, $timeout ) || die('mysqli_options croaked: ' . $link->error);
//To connect to a rds on amazone, go to EC2 --> Security Group --> Actions --> Edit Innbound Rule --> Select MySQL, Port 3306 and enter yuor ip X.X.X.X/0
$link->real_connect('xxxxx.xxxxxx.eu-west-1.rds.amazonaws.com',  'xxxx', 'xxxx', 'xxxx',3306) || die('mysqli_real_connect croaked: ' . $link->error);

$time_end = microtime_float();
$time = $time_end - $time_start;

echo "Connected in $time seconds\n";
