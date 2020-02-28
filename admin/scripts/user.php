<?php



function createUser($fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();

    //TODO: build the proper SQL query with the information above 
    //execute it to create a user in tbl_user
    $createquery = 'INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email)
    VALUES (:fname, :username, :password, :email)';
    $executeCreate = $pdo->prepare($createquery);
    $create_user_result = $executeCreate->execute(
        array(
            ':fname'=>$fname,
            ':username'=> $username,
            ':password'=> $password,
            ':email'=> $email
        )

        );
    //TODO based on execution result, if everything goes through redirect to the index.php
    //otherwise return an error message
       if($create_user_result){
        redirect_to('./index.php');
       }else{
           return 'Something went wrong, please try again';
       }

        
    
    
 
}