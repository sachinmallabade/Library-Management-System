<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Function to Login
function login($con, $param)
{
    extract($param);

    $sql = "select * from users where email = '$email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);

        $hash = $user['password'];

        if (password_verify($password, $hash)) {
            $outcome = array('status' => true, 'user' => $user);
        } else {
            $outcome = array('status' => false);
        }
    } else {
        $outcome = array('status' => false);
    }
    return $outcome;
}

// function to Forgot Password
function forgotPassword($con, $param)
{
    extract($param);

    $sql = "select * from users where email = '$email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];

        // Generate OTP
        $otp = rand(1111, 9999);
        $msg = "Your otp to reset password is <b>$otp</b>";

        // send reset password email

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sachinmallabade04@gmail.com';                     //SMTP username
            $mail->Password   = 'utqn prww rsyz kdxt';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('sachinmallabade04@gmail.com', 'Reset Password Mail');
            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forgot password request';
            $mail->Body    = $msg;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $result = $mail->send();
            if ($result) {
                $sql = "INSERT INTO reset_password (user_id , reset_code)
                    VALUES ($user_id,'$otp')";
                $con->query($sql);
                $outcome = array('status' => true);
            } else {
                $outcome = array('status' => false);
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else{
        $outcome = array('status' => false);
    }
    return $outcome;
}
       
// function to reset password from login section
function resetPassword($con, $param)
{
    extract($param);

    $sql = "SELECT * FROM reset_password WHERE reset_code = '$reset_code'";
    $result = $con->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $code = $result->fetch_assoc();

        if ($password == $confirm_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $user_id = $code['user_id'];
            // Update Password
            $sql_update = "UPDATE users SET password = '$hash' WHERE id = $user_id";
            if ($con->query($sql_update) === TRUE) {
                $outcome = array('status' => true, 'message' => "The password has been changed");
            } else {
                $outcome = array('status' => false, 'message' => "Error updating password: " . $con->error);
            }

            $sql = "DELETE FROM reset_password WHERE id = ".$code['id'];
            $con->query($sql);
        } else {
            $outcome = array('status' => false, 'message' => "Confirm Password doesn't match");
        }
    } else {
        $outcome = array('status' => false, 'message' => "Invalid Reset Code");
    }
    return $outcome;
}


// Function to change password
function changePassword($conn, $param)
{
    extract($param);
    $hash = $_SESSION['user']['password'];
    if (password_verify($current_pass, $hash)) {
        if ($new_pass == $conf_pass) {
            $hash = password_hash($new_pass, PASSWORD_DEFAULT);

            // Update password
            $sql = "UPDATE users SET password = '$hash' where id = " . $_SESSION['user']['id'];
            $conn->query($sql);
            $result = array('status' => true, "message" => "Password has been changed successfully");
        } else {
            $result = array('status' => false, "message" => "Confirm password doesn't match");
        }
    } else {

        $result = array('status' => false, "message" => "Invalid current password");
    }




    return $result;
}

// function to update Profile

function updateProfile($conn, $param)
{
    extract($param);
    $user_id = $_SESSION['user']['id'];
    $sql = "UPDATE users SET 
        name = '$name',
        email = '$email',
        phone_no = '$phone_no'
        WHERE id = $user_id ";
     $conn->query($sql);

     // update session user data
     $_SESSION['user']['name'] = $name;
     $_SESSION['user']['email'] = $email;
     $_SESSION['user']['phone_no'] = $phone_no;

    $result = array('status' => true, "message" => "Profile Updated");
    return $result;
}