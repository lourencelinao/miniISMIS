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

    $query="SELECT s.*,u.subjectSchedule_id,u.time,CONCAT(p.fname,'',p.lname)as name,p.person_id 
    FROM subject s, subject_schedule u, person p WHERE s.subject_id=u.subject_id AND s.faculty_id=p.person_id ";
    $result1= mysqli_query($conn,$query);

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
                                            <th scope="col">Subject ID</th>
                                            <th scope="col">Subject Name</th>
                                            <th scope="col">Assigned Teacher</th>
                                            <th scope="col">Schedule</th>
                                            <th scope="col">Max Students</th>
                                            <th scope='col'></th>
                                            <th scope='col'></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Data Structures</td>
                                                <td>Christine Pena</td>
                                                <td>7:30 - 10:30 TTH</td>
                                                <td>30</td>
                                                <td><a href='./updateSubject.php' class='btn btn-primary btn-sm'>Update</a> </td>
                                                <td><a href='#' class='btn btn-primary btn-sm'>Remove</a></td>                                              
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Information Management II</td>
                                                <td>Glenn Pepito</td>
                                                <td>7:30 - 10:30 TTH</td>
                                                <td>30</td>
                                                <td><a href='./updateSubject.php' class='btn btn-primary btn-sm'>Update</a> </td>
                                                <td><a href='#' class='btn btn-primary btn-sm'>Remove</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Web Development II</td>
                                                <td>Keenan Mendiola</td>
                                                <td>7:30 - 10:30 TTH</td>
                                                <td>30</td>
                                                <td><a href='./updateSubject.php' class='btn btn-primary btn-sm'>Update</a> </td>
                                                <td><a href='#' class='btn btn-primary btn-sm'>Remove</a></td>
                                            </tr>
                                            <?php if($result1):?>
                                            <?php if(mysqli_num_rows($result1) > 0) : ?> // replace $dummy with the result of query
                                            <?php while($row = mysqli_fetch_assoc($result1)) :?> // replace $dummy with the result of query
                                                <tr>
                                                    <th scope="row"><?echo $row['subject_code']?></th>
                                                    <td><?echo $row['subject_name']?></td>
                                                    <td><?echo $row['name']?></td>
                                                    <td><?echo $row['time']?></td>
                                                    <td><?echo $row['max_students']?></td>
                                                    <td><a href='./updateSubject.php' class='btn btn-primary btn-sm'>Update</a></td>
                                                        <form action="../Controllers/subjectController.php" method='POST'>
                                                            <input type="hidden" name='row_id' value='<?echo $row['subject_id']?>'> // echo subject id inside value
                                                            <button type='submit' name='remove' class='btn btn-primary btn-sm'>Enroll</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile ?>
                                        <?php endif ?> 
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