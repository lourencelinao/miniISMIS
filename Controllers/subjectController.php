<?php

$dbname = 'mini_ismis';
$conn = mysqli_connect('localhost', 'root', '', $dbname);


if(!$conn){
    die("Error DB");
}
//INSERTS 
if(isset($_POST["add"])){
    $id=$_POST["subject_code"];
    $sub=$_POST["subject_name"];
    $teacher=$_POST["subject_teacher"];
    $sched=$_POST["sheduler"];
    $max=$_POST["subject_max"];
    $check="SELECT * FROM subject_schedule WHERE faculty_id=$id AND time=$sched"; //IF ROWS EXISTS A SUBJECT IS OVERLAPPING
    if($result=mysqli_query($check,$conn)){
        if(mysqli_num_rows($result)>0){
            echo '<script type="text/javascript">
                        alert("Teacher or subject in conflict");
                            </script>';
        }
        else{
            $query="INSERT INTO subjects(subject_code,subject_name,faculty_id,max_students) VALUES($code,$sub,$teacher,$max)";
            $query2="INSERT INTO subject_schedule(subject_code,faculty_id,subject_name,time) VALUES($code,$teacher,$sub,$sched)";
            if(mysqli_query($conn, $query) && mysqli_query($conn,$query2)){
                header('Location: ../views/ismis.php'); 
            }
            else{
                echo '<script type="text/javascript">
                        alert("Error in creating subject!");
                            location="index.php";
                            </script>';
            }
        }
    }   
}

//DELETE 
if(isset($_POST['Remove'])){
    $id = $_POST['row_id']; //ID IS A HIDDEN INPUT TYPE IT HOLDS SUBJECT ID
    $sql = "delete from subjects where subject_id='$id'";
    if(mysqli_query($conn, $sql)){
        header('Refresh:0');
    }else{
        echo "Error";
    }
}
if(isset($_POST['update'])){
    $code=$_POST["subject_code"];
    $sub=$_POST["subject_name"];
    $teacher=$_POST["subject_teacher"];
    $sched=$_POST["sheduler"];
    $max=$_POST["subject_max"];
    $query="INSERT INTO subjects(subject_code,subject_name,faculty_id,max_students) VALUES($code,$sub,$teacher,$max)";
            $query2="INSERT INTO subject_schedule(subject_code,faculty_id,subject_name,time) VALUES($code,$teacher,$sub,$sched)";
            if(mysqli_query($conn, $query) && mysqli_query($conn,$query2)){
                header('Location: ../views/ismis.php'); 
            }
            else{
                echo '<script type="text/javascript">
                        alert("Error in updating subject!");
                            location="index.php";
                            </script>';
            }
}
if(isset($_POST['addStudent'])){
    $stud=$_POST['student_name'];//values are ids
    $sub=$_POST['subject_name'];
    $query1="INSERT INTO student_schedule(student_id,subjectSchedule_id) VALUES($stud,$sub)";
}

?>