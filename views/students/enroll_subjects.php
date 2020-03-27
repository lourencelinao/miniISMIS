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
        <title>Enroll</title>
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
                        <a class="nav-item nav-link active <?php echo ($user['user_type'] != "Student")? 'disabled': 'text-primary' ;?>" href="#">Students<span class="sr-only">(current)</span></a>      
                        
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo ($user['user_type'] != "Administrator")? 'disabled': 'text-primary' ;?>" href="#"  href="#" id="administratorDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administrator
                            </a>
                            <div class="dropdown-menu" aria-labelledby="administratorDropDown">
                            <a class="dropdown-item" href="./subject/subject.php">Subjects</a>
                            
                        </li>  -->        
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
                            </div>
                            <div class="card-body">
                                <h3>List of Subjects</h3>

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Subject Code</th>
                                        <th scope="col">Subject Name</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT DISTINCT subject_id, subject_code, subject_name FROM subjects ";
                                            $subject = mysqli_query($conn, $sql);
                                        ?>
                                        <?php if(mysqli_num_rows($subject) > 0) : ?> 
                                            <?php while($row = mysqli_fetch_assoc($subject)) :?> 
                                                <tr>
                                                    <th scope="row"><?php echo $row['subject_code']; ?></th>
                                                    <td><?php echo $row['subject_name'] ;?></td>
                                                    <td>                                                
                                                        <form action="./enroll_student.php" method='POST'>
                                                            <input type="hidden" value='<?php echo $row['subject_id'] ;?>' name='subject_id'>
                                                            <button type='submit' class='btn btn-primary btn-sm'>Enroll</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile ?>
                                        <?php endif ?> 

                                    </tbody>
                                </table>
                                <a type='submit' href='./students.php' class='btn btn-primary btn-sm'>Back</a>
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