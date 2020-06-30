<?PHP
$AppName = 'sfht';
//$push_url = '67571.livepush.myqcloud.com';        
//$player_url = 'tx-player.nut5g.com';                  //阿里云播流域名
$push_url = 'new-push.nut5g.com';        
$player_url = 'new-player.nut5g.com'; 
$key = 'A7ZRC8agnN';  


//设置播放清晰度
//ld 流畅
//sd 标清
//hd 高清
//ud 超清
$live_definition = 'ld';

$time = time() + 2592000;

$username =  $_GET["username"];
$password =  $_GET["password"];
$mode = $_GET["mode"];

if(!$username || !$password){
    $r_info['code'] = 500;
    $r_info['msg'] = 'username or password is null';
    echo json_encode($r_info);

    exit();
}

$config_db = include '../data/conf/db.php';
$conn = new mysqli($config_db['DB_HOST'], $config_db['DB_USER'], $config_db['DB_PWD'], $config_db['DB_NAME']);

if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}
$authcode = 'rCt52pF2cnnKNB3Hkp';




$sql = "SELECT * FROM `".$config_db['DB_PREFIX']."users` WHERE user_login = '".$username."'";
$result = $conn->query($sql);

$pass="###".md5(md5($authcode.$password));
//echo $pass;

$row = $result->fetch_assoc();
//print_r($row);
if(isset($row['user_pass'])){
    if($row['user_pass'] === $pass){
        if($mode == 'stop_live'){
//            DELETE FROM 表名称 WHERE 列名称 = 值

            $sql = 'DELETE FROM '.$config_db['DB_PREFIX'].'users_live where uid = '.$row['id'];
            $result = $conn->query($sql);
//            echo $result;
            $r_info['code'] = 200;
            $r_info['msg'] = 'stop live ok';
            echo json_encode($r_info);
            exit();
        }

        $auth_key = '/'.$AppName.'/'.$row['id'].'-'.$time.'-0-0-'.$key;
//        echo $auth_key;

        $auth_key = md5($auth_key);

        $pushurl = 'rtmp://'.$push_url.'/'.$AppName.'/'.$row['id'].'?auth_key='.$time.'-0-0-'.$auth_key;

        $player_auth_key = '/'.$AppName.'/'.$row['id'].'.m3u8'.'-'.$time.'-0-0-'.$key;
        $player_auth_key = md5($player_auth_key);

        $playerurl = 'https://'.$player_url.'/'.$AppName.'/'.$row['id'].'.m3u8?auth_key='.$time.'-0-0-'.$player_auth_key;

        $sql = "select * from ".$config_db['DB_PREFIX']."users_live where uid = ".$row['id'].";";
        $result_live = $conn->query($sql);
        $row_live = $result_live->fetch_assoc();
        if($row_live){
            $sql = 'UPDATE '.$config_db['DB_PREFIX'].'users_live SET pull = '."'".$playerurl."'".' where uid = '."'".$row['id']."'";
            $update = $conn->query($sql);
//            echo $sql;
        }else{
            $sql = "INSERT INTO `cmf_users_live` (`uid`, `user_nicename`, `avatar`, `avatar_thumb`, `showid`, `islive`, `starttime`, `title`, `province`, `city`, `stream`, `thumb`, `pull`, `lng`, `lat`, `topicid`, `type`, `type_val`, `isvideo`, `wy_cid`, `goodnum`, `is_communicating`) VALUES
(".$row['id'].", '".$row['user_nicename']."', '".$row['avatar']."', '".$row['avatar_thumb']."', ".time().", 1, ".time().", '', '', '好像在火星', '".$row['uid'].'_'.time()."', '', '".$playerurl."', '0', '0', 0, 0, '', 1, NULL, '0', 0);
";

            $conn->query($sql);
//            echo $sql;


        }

        $r_info['pushurl'] = $pushurl;
        $r_info['player_url'] = $playerurl;
        $r_info['code'] = 200;
        echo json_encode($r_info);

    }else{
        $r_info['code'] = 500;
        $r_info['msg'] = 'password error';
        echo json_encode($r_info);
    }
}else{

    $r_info['code'] = 500;
    $r_info['msg'] = 'password error';
    echo json_encode($r_info);
}


?>