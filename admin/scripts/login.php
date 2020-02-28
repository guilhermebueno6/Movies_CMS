<?php
function login($username, $password, $ip){
    // return sprintf('You are trying usename=> %s, password=%s', $username, $password);
    $pdo = Database::getInstance()->getConnection();

    $check_exist_query = 'SELECT COUNT(*) FROM `tbl_user` WHERE user_name =:username';
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username'=>$username
        )
        );

//check if matches the user db

    if($user_set->fetchColumn()>0){

        $check_match_query = 'SELECT * from `tbl_user` WHERE user_name =:username';
        $check_match_query .=' AND user_pass=:password';
        $user_match = $pdo->prepare($check_match_query);
        $user_match->execute(
            array(
                ':username'=>$username,
                ':password'=>$password
            )
            );


        while($founduser = $user_match->fetch(PDO::FETCH_ASSOC)){
            $id = $founduser['user_id'];

            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $founduser['user_fname'];

            //TODO: update the user table amd set the user_ip column to be $ip
            $update = 'UPDATE tbl_user SET user_ip =:ip WHERE user_id =:id';
            
            $user_update = $pdo->prepare($update);
            $user_update->execute(
                array(
                    ':ip'=>$ip,
                    ':id'=>$id
                )
                );
                // echo $update;
                // exit;
            //UPDATE tbl_user SET user_ip = '.$ip.' WHERE user_name = '.$username.'
            
        }
           if(isset($id)){
                redirect_to('index.php');
        }else{
            return 'Wrong Password!';
        }
    }else{
        return 'User does not exist!';
    }

}

function confirm_logged_in(){
    if(!isset($_SESSION['user_id'])){
        redirect_to('admin_login.php');
    }
}

function logout(){
    session_destroy();
    redirect_to('admin_login.php');
}