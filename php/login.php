

<?php
session_start();
    include_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($name) && !empty($email) && !empty($password)){
        // email validation
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //check email from DB
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){  //checks email is valid
                echo "$email - email already exists";
           
                                    $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, name, email, password)
                                                        VALUES ( '{$name}',  '{$email}')");
                                    if($sql2) {
                                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                        if(mysqli_num_rows($sql3) > 0){
                                            $row = mysqli_fetch_assoc($sql3);
                                            $_SESSION['unique_id'] = $row['unique_id'];
                                            echo "success";
                                }
                            }else{
                                echo "something went wrong";
                            }               
                        }  
                    }
            }
        }else{
           echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>