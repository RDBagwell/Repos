<?php
    ob_start();
    session_start();
    //Set array with POST vars in it.
	$login_array  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//Call and conect to the database
	require_once('../engine/engine_config.php');
	require_once('../engine/engine_mysql.php');
	$db = new DB;
	$db->init(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Checks to see if admin credentials are correct
	function checkCreds($login){
            global $db;
            $user_name = $login["user_name"];
            $password = $login["password"];
            $sql = "SELECT * FROM admin WHERE name ='".$user_name."'";
            $db->query($sql);
            $recods = $db->getRecords();
            $recod_count = count($recods);
            $hold_time = date('c', strtotime('-24 hour'));
            if($recods[0]["last_attempt"] <= $hold_time){
                $db->assign("login_attempts",0);
                $db->update("admin", "WHERE name ='".$user_name."'");
                $db->reset();
            }
            $passwordCrypt = crypt($password, '$1$bIo2Icz1$');
            if($recod_count > 0){
                if($recods[0]["name"]== $user_name && $recods[0]["active"] == 1){
                    if($recods[0]["password"] ==  $passwordCrypt && $recods[0]["name"] ==  $user_name){
                        $_SESSION["auth"] = "Hgy1FrO2Tp";
                        $db->assign_str("last_login",date("c"));
                        $db->update("admin", "WHERE name ='".$user_name."'");
                        $db->reset();
                        header("Location: /admin/index.php");
                    } else{
                        $error = "Username or password is incorrect.";
                        $login_attempts = $recods[0]["login_attempts"] + 1;
                        $db->assign("login_attempts",$login_attempts);
                        $db->assign_str("last_attempt",date("c"));
                        $db->update("admin", "WHERE name ='".$user_name."'");
                        $db->reset();
                        if($login_attempts > 4){
                            $db->assign("active",0);
                            $db->update("admin", "WHERE name ='".$user_name."'");
                            $db->reset();
                        }
                        return $error;
                    } 

                } else {
                  $error = "This account has been locked, do to too many failed log-in attempts.";
                  return $error;
                }              
            } else {
                $error = "Username or password is incorrect.";
                return $error;
            }

	}

	if(isset($login_array["user_name"]) || isset($login_array["password"])){
            $responce = checkCreds($login_array);
	}
	require_once('./html/login.html');
