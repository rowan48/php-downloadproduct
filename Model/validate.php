<?php
//session_start();
class validate{
    static function validate_data(){
if(isset($_POST['submit'])){
$email = ($_POST['email']);
//var_dump($email);
$password = ($_POST['password']);
$cPassword = ($_POST['confirm']);
$date = ($_POST['date']);
$cardNumber = ($_POST['creditCard']);
$date =($_POST['date']);




$isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
$isPwValid = preg_match("/[A-Z]/", $password)
&& preg_match("/[a-z]/", $password)
&& preg_match("/[0-9]/", $password)
&& strlen($password) > 8
&& strlen($password) < 16;
$isMatching = strcmp($cPassword, $password) == 0;
$isMatching = ($cPassword === $password);
$isValidcCard = preg_match("/^[0-9]{16}$/", $cardNumber);
$maxDate = date('Y-m-d', strtotime('+3 years'));
$isValidDate = $date < $maxDate;
$allValid=1;

//$allValid = $isEmailValid && $isMatching && $isPwValid && $isValidcCard && $isValidDate;

if ($allValid) {
    $user = new user($email, $password);
    //var_dump($user);
    
    //open session and save data to session
    //session_start();
    //$_SESSION["id"]=5;
    if (dbconnection::select_user($user))
    {   
        
        return 0; //user already exist

    }
    else{
        
        dbconnection::sign_up($user);
        $userid = dbconnection::select_userId($user);
        //var_dump($userid);
        $_SESSION["id"] = $userid;

//require_once ("View/login.php");

//require_once ("View/login.php");
//

//require database handling file
//require_once "../DBhandler.php";
return 1; //correct info

    }
    
} else {
    //require_once "unsuccessful.php";
     return -1; //invalid info
}

}
}
}
?>
