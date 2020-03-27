<?php

$dbname = 'mini_ismis';
$conn = mysqli_connect('localhost', 'root', '', $dbname);


if(!$conn){
    die("Error DB");
}
//INSERTS 
if(isset($_POST["add"])){
    $subject_code = $_POST["subject_code"];
    $subject_name = $_POST["subject_name"];
    $teacher_id = $_POST["subject_teacher"];
    $schedule_id = $_POST["shedule"];
    $max = $_POST["subject_max"];
 
    $sql = "SELECT * FROM assignedSubjects WHERE faculty_id = '$teacher_id' AND time_id = '$schedule_id' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">
                alert("Faculty teacher conflicting schedule!");
                    location="../views/subject/addSubject.php";
                    </script>';
    }else{
        $query = "INSERT INTO subjects(subject_code, subject_name, max_students) VALUES('$subject_code', '$subject_name',$max)";
        if(mysqli_query($conn, $query)){
            $sql = "SELECT * FROM subjects ORDER BY subject_id DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $subject_id = mysqli_fetch_assoc($result);
            $subject_id = $subject_id['subject_id'];
            $query2 = "INSERT INTO subject_schedule(subject_id ,faculty_id, time_id, numberOfStudents) VALUES('$subject_id', '$teacher_id', '$schedule_id', 0)";
            $query3 = "INSERT INTO assignedSubjects(faculty_id, subject_id, time_id) values('$teacher_id', '$subject_id', '$schedule_id') ";
            if(mysqli_query($conn, $query2) && mysqli_query($conn, $query3)){
                header('Location: ../views/subject/subject.php'); 
            }
        
        }
        else{
            echo '<script type="text/javascript">
                    alert("Error in creating subject!");
                        location="../views/subject/addSubject.php";
                        </script>';
        }
    }
}

//DELETE 
if(isset($_POST['delete'])){
    $subject_id = $_POST['subject_id']; //ID IS A HIDDEN INPUT TYPE IT HOLDS SUBJECT ID
    $sql1 = "delete from subject_schedule where subject_id = '$subject_id' ";
    $sql2 = "delete from assignedSubjects where subject_id = '$subject_id' ";
    $sql3 = "delete from subjects where subject_id='$subject_id'";
    if(mysqli_query($conn, $sql1)){
        if(mysqli_query($conn, $sql2)){
            if(mysqli_query($conn, $sql3)){
                header('Location: ../views/subject/subject.php');
            }
        }
    }else{
        echo "Error";
    }
}
if(isset($_POST['update'])){
    $subject_id = $_POST['subject_id'];
    $subject_code = $_POST["subject_code"];
    $subject_name = $_POST["subject_name"];
    $teacher_id = $_POST["subject_teacher"];
    $schedule_id = $_POST["shedule"];
    $max = $_POST["subject_max"];

    $old = $_POST['time_id'];

    $sql = "SELECT * FROM assignedSubjects WHERE faculty_id = '$teacher_id' AND time_id = '$schedule_id' ";
    $result = mysqli_query($conn, $sql);
    $time = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0 && $time['time_id'] != $old){
        echo '<script type="text/javascript">
                alert("Faculty teacher conflicting schedule!");
                    location="../views/subject/subject.php";
                    </script>';
    }else{
        $query = "UPDATE assignedSubjects SET faculty_id = '$teacher_id', time_id = '$schedule_id' WHERE subject_id = '$subject_id' ";
        if(mysqli_query($conn, $query)){
            $query2 = "UPDATE subject_schedule SET faculty_id = '$teacher_id', time_id = '$schedule_id' WHERE subject_id = '$subject_id' ";
            $query3 = "UPDATE subjects SET subject_code = '$subject_code', subject_name = '$subject_name' , max_students = '$max' WHERE subject_id = '$subject_id' ";
            if(mysqli_query($conn, $query2) && mysqli_query($conn, $query3)){
                header('Location: ../views/subject/subject.php'); 
            }else{
                echo "error";
            }
        
        }
        else{
            echo '<script type="text/javascript">
                    alert("Error in updating subject!");
                        location="../views/subject/subject.php";
                        </script>';
        }
    }

}
if(isset($_POST['addStudent'])){
    $student_id = $_POST['student_id'];//values are ids
    $subjectSchedule = $_POST['subjectSchedule'];

    $sql = "SELECT * FROM student_schedule WHERE student_id = '$student_id' AND subjectSchedule_id = '$subjectSchedule' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<script type="text/javascript">
                        alert("Conflicting schedules!");
                            location="../views/subject/addStudentToSubject.php";
                            </script>';
    }else{
        $sql = "SELECT numberOfStudents, numberOfStudents, subject_id, time_id FROM subject_schedule WHERE subjectSchedule_id = '$subjectSchedule' ";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $num = $row[0] + 1;

        $subject_id = $row[2];
        $sql = "SELECT * FROM subjects WHERE subject_id = '$subject_id' ";
        $result = mysqli_query($conn, $sql);
        $subject = mysqli_fetch_assoc($result);

        if($num > $subject['max_students']){
            echo '<script type="text/javascript">
                        alert("Class is already full!!");
                            location="../views/subject/addStudentToSubject.php";
                            </script>';
        }else{
            $time_id = $row[3];
            $sql = "INSERT INTO student_schedule(student_id,subjectSchedule_id, time_id) VALUES($student_id, $subjectSchedule, '$time_id')";
            if(mysqli_query($conn, $sql)){
                $sql = "UPDATE subject_schedule SET numberOfStudents = '$num' WHERE subjectSchedule_id = '$subjectSchedule'";
                if(mysqli_query($conn, $sql)){
                    header('Location: ../views/subject/subject.php');
                }else{
                    echo "error update";
                }
            }else{
                echo "error insert";
            }
        }
    }
}

?>