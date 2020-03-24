<?php

    $dbname = 'mini_ismis';
    $conn = mysqli_connect('localhost', 'root', '', $dbname);

    if(!$conn){
        die("Error");
    }

    if(isset($_POST['login'])){
        login($conn);
    }else if(isset($_POST['register'])){
        register($conn);
    }

    function login($conn){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "select * from users where username='$username' AND password='$password' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $sql = "insert into auth(person_id) values('$username')";
            if(mysqli_query($conn, $sql)){
                header('Location: ../views/ismis.php'); 
            }                   
        }else{
            header('Location: ../views/login.php');
        }
    }

    function register($conn){
        $person_id = $_POST['id'];
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];   
        $type = $_POST['type'];

        $sql = "insert into person(person_id, fname, mi, lname, email, contact, birthdate, address, person_type)
        values('$person_id', '$fname', '$mi', '$lname', '$email', '$contact', '$birthdate', '$address', '$type') ";

        if(mysqli_query($conn, $sql)){
            $sql = "insert into users(username, user_type)values('$person_id', '$type')";
            if(mysqli_query($conn, $sql)){
                header('Location: ../views/login.php'); 
            }else{
                echo "error second";
            }
        }else{
            echo "error first";
        }
    }
?>