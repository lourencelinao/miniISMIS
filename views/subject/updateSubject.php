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

    //id for where clause

    $subject_id = $_POST['subject_id'];
    $faculty_id = $_POST['faculty_id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Subject</title>
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
                            <a class="nav-link dropdown-toggle active text-primary" href="#"  href="#" id="administratorDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administrator<span class="sr-only">(current)</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="administratorDropDown">
                            <a class="dropdown-item" href="./subject.php">Subjects</a>
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
                            <div class="card-header text-primary">
                                Update Student
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <form action="../../Controllers/subjectController.php" method='POST'>

                                        <div class="form-group row">
                                            <label for="subject_code" class="col-md-4 col-form-label text-md-right">Subject Code</label>
                                            <div class="col-md-6">
                                                <?php
                                                    $sql = "SELECT * FROM subjects WHERE subject_id= '$subject_id' "; 
                                                    $result = mysqli_query($conn, $sql);
                                                    $subject = mysqli_fetch_assoc($result);
                                                ?>
                                                <input id="subject_id" type="text" value="<?php echo $subject['subject_code']; ?>" class="form-control" name="subject_code"> <!-- echo the original data inside the value -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="subject_name" class="col-md-4 col-form-label text-md-right">Subject Name</label>
                                            <div class="col-md-6">
                                                <input id="subject_name" type="text" value="<?php echo $subject['subject_name']; ?>" class="form-control" name="subject_name">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="subject_teacher" class="col-md-4 col-form-label text-md-right">Teacher</label>                   
                                            <div class="col-md-6">
                                                <select class='selectpicker form-control' placeholder="Choose a teacher" name="subject_teacher" id="subject_teacher">
                                                    <?php
                                                        $sql = "SELECT * FROM person WHERE person_type = 'Faculty' AND status = 'Active' ";
                                                        $result = mysqli_query($conn, $sql);   
                                                                                                       
                                                    ?>
                                                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                                                        <option value="<?php echo $row['person_id'];?>" <?php echo ($row['person_id'] == $faculty_id)? 'selected = "selected"': '' ; ?> >
                                                            <?php echo $row['fname'], ' ', $row['lname'] ; ?>
                                                        </option>
                                                    <?php endwhile?>
                                                </select>
                                            </div>
                                         </div>  
                                         
                                         <div class="form-group row">
                                            <label for="shedule" class="col-md-4 col-form-label text-md-right">Schedule</label>                   
                                            <div class="col-md-6">
                                                <select class='selectpicker form-control' placeholder="Choose a schedule" name="shedule" id="shedule">
                                                    <?php 
                                                        $sql = "SELECT * FROM time";
                                                        $time = mysqli_query($conn, $sql);  
                                                        
                                                        $sql = "SELECT * FROM subject_schedule WHERE subject_id = '$subject_id' ";
                                                        $result = mysqli_query($conn, $sql);
                                                        $subjectSchedule = mysqli_fetch_assoc($result);

                                                        $time_id = $subjectSchedule['time_id'];
                                                        $old; 
                                                    ?>
                                                    <?php while($row = mysqli_fetch_assoc($time)) : ?>
                                                        <option value="<?php echo $row['time_id'];?>" <?php echo ($row['time_id'] == $time_id)? 'selected = "selected"': '' ;?> <?php echo ($row['time_id'] == $time_id)? $old = $time_id: '' ;?>>
                                                            <?php echo $row['days'], ' ', $row['time'] ; ?>
                                                        </option>
                                                    <?php endwhile ?>
                                                </select>
                                            </div>
                                         </div>                 

                                         <div class="form-group row">
                                            <label for="subject_max" class="col-md-4 col-form-label text-md-right">Subject Maximum Students</label>
                                            <div class="col-md-6">
                                                <input id="subject_max" type="number" value="<?php echo $subject['max_students']; ?>" class="form-control" name="subject_max"> <!-- echo the original data inside the value -->
                                            </div>
                                        </div>

                                        <div class="form-group row">  
                                            <label for="add" class="col-md-4 col-form-label text-md-right"></label>                
                                            <div class="col-md-6">
                                                <a href='./subject.php' name='cancel' class='btn btn-primary '>Cancel</a>
                                                <!-- hidden input -->
                                                <!-- new --><input type="hidden" name='subject_id' value='<?php echo $subject['subject_id']; ?>'>
                                                <!-- old --><input type="hidden" name='time_id' value='<?php echo $old; ?>'>
                                                <button type='submit' name='update' class='btn btn-primary '>Update</button>                                            
                                            </div>
                                        </div>

                                    </form>
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