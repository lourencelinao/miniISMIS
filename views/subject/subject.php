<?php
    
    $dbname = 'mini_ismis';
    $conn = mysqli_connect('localhost', 'root', '', $dbname);
    

    if(!$conn){
        die("Error DB");
    }
    
    $sql = "SELECT * from auth order by auth_id desc limit 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    $id = $user['person_id'];

    $sql = "SELECT * from users where username='$id' ";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    $sql = "SELECT * from person where person_id = '$id' ";
    $result = mysqli_query($conn, $sql);
    $person = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Subjects</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <style>
        .container-fluid {
            padding-right:0;
            padding-left:0;
            margin-right:auto;
            margin-left:auto
        }
    </style>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <a class="navbar-brand" href="#">
                    DCIS                  
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">                 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active <?php echo ($user['user_type'] != "Administrator")? 'disabled': '' ;?>" href="#"  href="#" id="administratorDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administrator<span class="sr-only">(current)</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="administratorDropDown">
                            <a class="dropdown-item" href="#">Subjects</a>
                            <!-- <a class="dropdown-item" href="./schedule.php">Schedules</a> -->
                        </li>          
                    </div>
                </div>

                <!-- right side -->
                <div class="my-2 my-lg-0">
                    <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $person['fname']; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="../login.php">Logout</a>
                    </div>
                    </div>
                </div>                
            </nav>
        </div>

        <!-- body content -->
        <div class="container-fluid">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-primary d-flex justify-content-between align-items-baseline">
                                <div>Subjects</div>
                                <div><a href='./addStudentToSubject.php' class='btn btn-primary btn-sm'>Add Student</a></div>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <a href='./addSubject.php' class='btn btn-primary'>Add Subject</a>                                                                  
                                </div>

                                <div class="container pt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Subject Code</th>
                                                <th scope="col">Subject Name</th>
                                                <th scope="col">Assigned Teacher</th>
                                                <th scope="col">Schedule</th>
                                                <th scope="col">Max Students</th>
                                                <th scope='col'></th>
                                                <th scope='col'></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--
                                                <th scope="row">1</th>
                                                <td>Data Structures</td>
                                                <td>Christine Pena</td>
                                                <td>7:30 - 10:30</td>
                                                <td><button class='btn btn-primary btn-sm'>Remove</button></td>
                                            </tr>
                                            -->
                                            <!--CODE FOR RETRIEVING SUBJECT INFO -->
                                            <?php
                                                $sql = "SELECT * FROM subjects";
                                                $subjects = mysqli_query($conn, $sql);
                                            ?>
                                            <?php if(mysqli_num_rows($subjects)) : ?>
                                                <?php while($row = mysqli_fetch_assoc($subjects)) : ?>
                                                    <?php
                                                        $subject_code = $row['subject_code'];
                                                        $subject_id = $row['subject_id'];
                                                        $sql = "SELECT * FROM assignedSubjects WHERE subject_id = '$subject_id' ";
                                                        $assignedSubject = mysqli_query($conn, $sql);
                                                        $assignedSubject = mysqli_fetch_assoc($assignedSubject);

                                                        //teacher name
                                                        $faculty_id = $assignedSubject['faculty_id'];
                                                        $sql = "SELECT * FROM person WHERE person_id='$faculty_id' ";
                                                        $result = mysqli_query($conn, $sql);
                                                        $faculty = mysqli_fetch_assoc($result);

                                                        $time_id = $assignedSubject['time_id'];
                                                        $sql = "SELECT * FROM time WHERE time_id='$time_id' ";
                                                        $time = mysqli_query($conn, $sql);
                                                        $time = mysqli_fetch_assoc($time);
                                                    ?>
                                                    <tr>
                                                        <th scope='row'><?php echo $row['subject_code'] ;?></th>
                                                        <td><?php echo $row['subject_name'] ;?></td>
                                                        <td><?php echo $faculty['fname'], ' ', $faculty['lname'] ;?></td>
                                                        <td><?php echo $time['days'], ' ', $time['time'] ;?></td>
                                                        <td><?php echo $row['max_students'] ;?></td>
                                                        <td>
                                                            <form action="./updateSubject.php" method='POST'>
                                                                <input type="hidden" value='<?php echo $row['subject_id'];?>' name='subject_id' >
                                                                <input type="hidden" value='<?php echo $faculty_id;?>' name='faculty_id' >
                                                                <button class='btn btn-primary btn-sm' type='submit' name='update'>Update</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="../../Controllers/subjectController.php" method='POSt'>
                                                                <input type="hidden" value='<?php echo $row['subject_id'];?>' name='subject_id' >
                                                                <button class='btn btn-primary btn-sm' type='submit' name='delete'>Delete</button>
                                                            </form>                                     
                                                        </td>
                                                    </tr>
                                                <?php endwhile ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html> 