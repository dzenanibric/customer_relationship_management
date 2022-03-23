<?php

function randomPassword(){
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //niz u string
}

$plain_password = randomPassword();

function getPassword(){
    global $plain_password;
    escape($plain_password);
    return $plain_password;
}

function setAdminData(){
    $username = "admin_team";
    $password = password_hash(getPassword(), PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin(username, password)";
    $sql .= "VALUES('$username', '$password')";

    confirm(query($sql));
}

function clean($string){
    return htmlentities($string);
}

function redirect($location){
    header("location: {$location}");
    exit();
}

function setMessage($message){
    if(!empty($message)){
        $_SESSION['message'] = $message;
    }
    else{
        $message = "";
    }
}

function displayMessage(){
    if(isset($_SESSION['message'])){
        echo "<div class = 'alert'>" . $_SESSION['message'] . "<br></div>";
        unset($_SESSION['message']);
    }
}

function validateAdminLogin(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = clean(escape($_POST['username']));
        $password = clean(escape($_POST['password']));

        $query = "SELECT * FROM admin ORDER BY id DESC LIMIT 1";
        $result = query($query);

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();

            if(password_verify($password, $data['password'])){
                if($username == $data['username']){
                    $_SESSION['username'] = $username;
                    redirect('index.php');
                }
                else{
                    setMessage('Username is incorrect');
                }
            }
            else{
                setMessage('Password is incorrect!');
            }
        }
        else{
            setMessage('Ups... Problem with database');
        }
    }
}

function emailExistsCheck($email){
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = query($query);

    if($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}

function addUser(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $first_name = clean(escape($_POST['first_name']));
        $last_name = clean(escape($_POST['last_name']));
        $email = clean(escape($_POST['email']));
        $password = clean(escape($_POST['password']));
        $confirm_password = clean(escape($_POST['confirm_password']));

        if($password < 8){
            setMessage("Password must be a minimum of 8 characters!");
        }
        else{
            if(!emailExistsCheck($email)){
                if($password == $confirm_password){
                    filter_var($first_name, FILTER_SANITIZE_STRING);
                    filter_var($last_name, FILTER_SANITIZE_STRING);
                    filter_var($email, FILTER_SANITIZE_EMAIL);
                    filter_var($password, FILTER_SANITIZE_STRING);
                    filter_var($confirm_password, FILTER_SANITIZE_STRING);

                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users(first_name, last_name, email, password)";
                    $sql .="VALUES('$first_name', '$last_name', '$email', '$password')";

                    confirm(query($sql));

                    echo "<div class='green_alert'> User successfully added! </div>"; 
                }
                else{
                    setMessage("Passwords do not match");
                }
            }
            else{
                setMessage("A user with this email already exists!");
            }
        }
    }
}

function validateUserLogin(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = clean(escape($_POST['email']));
        $password = clean(escape($_POST['password']));

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = query($query);

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();

            if(password_verify($password, $data['password'])){
                if($email == $data['email']){
                    $_SESSION['email'] = $email;
                    redirect('index.php');
                }
                else{
                    setMessage('Email is incorrect');
                }
            }
            else{
                setMessage('Password is incorrect!');
            }
        }
        else{
            setMessage('Ups... Problem with database');
        }
    }
}

function getUser($id = null){
    if($id>0){
        $queryID = "SELECT * FROM users WHERE id = '$id'";
        $resultID = query($queryID);
        if($resultID->num_rows > 0){
            return $resultID->fetch_assoc();
        }
        else{
            echo "User not found!";
        }
    }
    else{
        $query = "SELECT * FROM users WHERE email ='" . $_SESSION['email'] . "'";
        $result = query($query);
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else{
            echo "User not found!";
        }
    }
}

function submitComplaint(){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $content = clean(escape($_POST['write_complaints']));
        $user = getUser();
        $user_id = $user['id'];

        filter_var($content, FILTER_SANITIZE_STRING);
        
        $sql = "INSERT INTO complaints(user_id, content)";
        $sql .= "VALUES('$user_id', '$content')";

        confirm(query($sql));

        echo "<div class='green_alert'> Your complaint has been successfully received! </div>";
    }
}

function listComplaints(){
    $query = "SELECT * FROM complaints ORDER BY created_time DESC";
    $result = query($query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user = getUser($row['user_id']);

            echo "<div class='complaint_box'>
                <h1>" . $user['first_name'] . " " . $user['last_name'] ."</h1><hr>" . $row['content'] . "<br><hr>
                <h1><i>" . $row['created_time'] . "</i></h1>
                </div>";
        }
    }
    else{
        echo "<div class='alert'>You have no new complaints received!</div>";
    }
}

function deleteLastRow(){
    $query = "SELECT * FROM complaints ORDER BY created_time DESC LIMIT 1";
    $result = query($query);

    if($result->num_rows > 0){
        $data = $result->fetch_assoc();

        $sql = "DELETE FROM complaints WHERE id ='" . $data['id'] . "'";

        query($sql);
    }
    else{

    }
}

function sendToCategory($category){
    $query = "SELECT * FROM complaints ORDER BY created_time DESC LIMIT 1";
    $result = query($query);

    if($result->num_rows > 0){
        $data = $result->fetch_assoc();

        $user_id = $data['user_id'];
        $content = $data['content'];
        $created_time = $data['created_time'];

        $sql = "INSERT INTO $category(user_id, content, created_time)";
        $sql .= "VALUES('$user_id','$content','$created_time')";

        query($sql);

        deleteLastRow();
    }
}

function showCategory($category){
    $query = "SELECT * FROM  $category ORDER BY created_time DESC";

    $result = query($query);

    if($result->num_rows > 0){
        while($data = $result->fetch_assoc()){
           $user = getUser($data['user_id']);

           echo "<div class='category_item'>
                <h1>" . $user['first_name'] . " " . $user['last_name'] ."</h1><hr>" . $data['content'] . "<br><hr>
                <h1><i>" . $data['created_time'] . "</i></h1>
                </div>";
        }
    }
    else{
        echo "<div class='alert'>No results!</div>";
    }
}

function checkAccess($type, $check){
    if($check == true){
        if(isset($_SESSION[$type])){

        }
        else{
            redirect('index.php');
        }
    }
    else{
        if(!isset($_SESSION[$type])){

        }
        else{
            redirect('index.php');
        }
    }
}

function getNumberOf($table, $what){
    $query = "SELECT * FROM $table";
    $result = query($query);
    
    if($result->num_rows > 0){
        return "<div class='stats_block'>" . $what . " : " . $result->num_rows . "<br></div";
        return $result->num_rows;
    }
    else{
        return "<div class='stats_block'>" . $what . " : " . $result->num_rows . "<br></div";
    }
}

function getBiggestCategory(){
    $cat_one = getNumberOf('category_one', ' ');
    $cat__two = getNumberOf('category_two', ' ');

    if($cat_one > $cat__two){
        echo "<div class='stats_block'>The biggest category: Category 1</div>";
    }
    else if($cat_one == $cat__two){
        echo "<div class='stats_block'>The biggest category: they are all the same</div>";
    }
    else{
        echo "<div class='stats_block'>The biggest category: Category 2</div>";
    }
}

function deleteComplaint(){
    $sql = "DELETE FROM complaints ORDER BY created_time DESC LIMIT 1";

    query($sql);
}

function resetCrm(){
    $sql = "DELETE FROM complaints";
    if(query($sql)){
        $sql = "DELETE FROM users";
        if(query($sql)){
            $sql = "DELETE FROM category_one";
            if(query($sql)){
                $sql = "DELETE FROM category_two";
                query($sql);
            }
        }
    }
}

function printAllUsers(){
    $query = "SELECT * FROM users";

    $result = query($query);
    if($result->num_rows > 0){
        while($users = $result->fetch_assoc()){
            echo "<div id='users_row'>" . $users['id'] . " -- " .  $users['first_name'] . " -- " . $users['last_name'] . " -- " . $users['email'] . "<br><hr></div>";
        }
    }
}
?>