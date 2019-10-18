<?php
if(isset($_POST['signup-submit']))
{
    require "dbh.inc.php";

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat))
    {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.php?error=invalidemails&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidusername&uid=".$username."&mail=".$email);
        exit();
    }
    else if ($password !== $passwordRepeat)
    {
        header("Location: ../signup.php?error=passworderror&uid=".$username."&mail=".$email);
        exit();
    }
    else
    {   
        $sql = "SELECT * FROM users WHERE uidUsers=?;";
        
        if(!$stmt = mysqli_stmt_init($conn))
        {
            header("Location: ../signup.php?error=errorstmt");
            exit();
        }
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            
            header("Location: ../signup.php?error=errorsql");
            exit();
        }
        else
        {   

            mysqli_stmt_bind_param($stmt, "ss", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);
             if ($resultCheck > 0)
             {
                 header("Location: ../signup.php?error=usernametaken".$username);
                 exit();
             }
            else
            {
                $sql = "INSERT INTO users (uidUsers, email, pwdUsers) VALUES (?, ?, ?)";
                if(!$stmt = mysqli_stmt_init($conn))
                {
                    header("Location: ../signup.php?error=errorstmt");
                    exit();
                }
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    
                    header("Location: ../signup.php?error=errorsql");
                    exit();
                }
                else
                {
                    $Hashedpwd = password_hash($password, PASSWORD_DEFAULT);

                    if(!mysqli_stmt_bind_param($stmt, "sss", $username, $email, $Hashedpwd))
                    {
                        header("Location: ../signup.php?error=bind");
                        exit();
                    }
                    if(!mysqli_stmt_execute($stmt))
                    {
                        header("Location: ../signup.php?error=exec");
                        exit();
                    }
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
{
    header("Location: ../signup.php");
            exit();
}