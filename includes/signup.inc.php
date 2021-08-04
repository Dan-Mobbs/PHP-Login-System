<?php 

/**
 * 
 * Script to run when the user signs up on the website
 */

 // Checks to see wheather the user tried to access this page through the URL and 
 // if true redirects them back to signup.php.
if (isset( $_POST["submit"] )) {

    // Variables when the user fills out each section of the signup form.
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if ( emptyInputSignup( $name, $email, $username, $pwd, $pwdRepeat ) !== false ) {
        header( "location: ../sign-up.php?error=emptyinput" );
        exit();
    }
    
    if ( invalidUid( $username ) !== false ) {
        header( "location: ../sign-up.php?error=emptyuid" );
        exit();
    }
    
    if ( invalidEmail( $email ) !== false ) {
        header( "location: ../sign-up.php?error=emptyemail" );
        exit();
    }
     
    if ( pwdMatch( $pwd, $pwdRepeat ) !== false ) {
        header( "location: ../sign-up.php?error=pwderror" );
        exit();
    }
        
    if ( uidExists( $conn, $username ) !== false ) {
        header( "location: ../sign-up.php?error=usernametaken" );
        exit();
    }

    createUser( $conn, $name, $email, $username, $pwd );
            
}
else {
    //Code to run if the user tries to access this page directly.
    header( "location: ../sign-up.php" );
    exit();
}