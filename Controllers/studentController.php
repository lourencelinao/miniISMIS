<?php
    $dbname = 'mini_ismis';
    $conn = mysqli_connect('localhost', 'root', '', $dbname);

    if(!$conn){
        die("Error");
    }

    if(isset($_POST['enroll'])){
        $student_id = $_POST['student_id'];
        $subjectSchedule_id = $_POST['schedule'];
        $time_id = $_POST['time_id'];

        /*$sql = "SELECT * FROM subject_schedule WHERE subjectSchedule_id = '$subjectSchedule_id' ";
        $result = mysqli_query($conn, $sql);
        $subject_schedule = mysqli_fetch_assoc($result);

        $time_id = $subject_schedule['time_id'];*/

        $sql = "SELECT * FROM student_schedule WHERE student_id = '$student_id' AND time_id = '$time_id' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            echo '<script type="text/javascript">
                alert("Conflicting schedule!");
                    location="../views/students/enroll_subjects.php";
                    </script>';
        }else{
            $sql = "SELECT numberOfStudents, numberOfStudents, subject_id, time_id FROM subject_schedule WHERE subjectSchedule_id = '$subjectSchedule_id' ";
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
                                location="../views/students/enroll_subjects.php";
                                </script>';
            }else{
                $sql = "INSERT INTO student_schedule(student_id, subjectSchedule_id, time_id) values('$student_id', '$subjectSchedule_id', '$time_id') ";
                if(mysqli_query($conn, $sql)){
                    $sql = "UPDATE subject_schedule SET numberOfStudents = '$num' WHERE subjectSchedule_id = '$subjectSchedule_id' ";
                    if(mysqli_query($conn, $sql)){
                        header('Location: ../views/students/enroll_subjects.php');
                    }
                }else{
                    echo "Error";
                }
            }
        }
    }


    if(isset($_POST['remove'])){
        $subjectSchedule_id = $_POST['subjectSchedule_id'];
        $student_id = $_POST['student_id'];

        $sql = "DELETE FROM student_schedule WHERE subjectSchedule_id = '$subjectSchedule_id' AND student_id = '$student_id' ";
        if(mysqli_query($conn, $sql)){
            $sql = "SELECT numberOfStudents, numberOfStudents, subject_id, time_id FROM subject_schedule WHERE subjectSchedule_id = '$subjectSchedule_id' ";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();
            $num = $row[0] - 1;
            $sql = "UPDATE subject_schedule SET numberOfStudents = '$num' WHERE subjectSchedule_id = '$subjectSchedule_id' ";
            if(mysqli_query($conn, $sql)){
                header('Location: ../views/students/students.php');
            }else{
                echo "error";
            }
        }else{
            echo "error1";
        }
    }
?> 