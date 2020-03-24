<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <div class="container">
                        <form action="../controllers/homeController.php" method='post'>
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="form-group row">
                                        <label for="id" class="col-md-4 col-form-label text-md-right">ID</label>
                                        <div class="col-md-6">
                                            <input id="id" type="text" placeholder="Enter ID" class="form-control" name="id"   autocomplete="id" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fname" class="col-md-4 col-form-label text-md-right">First Name</label>
                                        <div class="col-md-6">
                                            <input id="fname" type="text" placeholder="Enter First Name" class="form-control" name="fname">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mi" class="col-md-4 col-form-label text-md-right">Middle Initial</label>                   
                                        <div class="col-md-6">
                                            <input id="mi" type="text" placeholder="Enter Middle Initial" class="form-control" name="mi">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname" class="col-md-4 col-form-label text-md-right">Last Name</label>                   
                                        <div class="col-md-6">
                                            <input id="lname" type="text" placeholder="Enter Last Name" class="form-control" name="lname">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>                   
                                        <div class="col-md-6">
                                            <input id="email" type="email" placeholder="Enter Email" class="form-control" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contact" class="col-md-4 col-form-label text-md-right">Contact</label>                   
                                        <div class="col-md-6">
                                            <input id="contact" type="number" placeholder="Enter Contact Number" class="form-control" name="contact">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="birthdate" class="col-md-4 col-form-label text-md-right">Birthdate</label>                   
                                        <div class="col-md-6">
                                            <input id="birthdate" type="date"  class="form-control" name="birthdate">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>                   
                                        <div class="col-md-6">
                                            <input id="address" type="text" placeholder="Enter Address" class="form-control" name="address">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="type" class="col-md-4 col-form-label text-md-right">Type</label>                   
                                        <div class="col-md-6">
                                            <select class='selectpicker form-control' placeholder="Student or Faculty" name="type" id="type">
                                                <option value="Student">Student</option>
                                                <option value="Faculty">Faculty</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">  
                                    <label for="type" class="col-md-4 col-form-label text-md-right"></label>                
                                        <div class="col-md-6">
                                            <button type='submit' name='register' class='btn btn-primary btn-block'>Register</button>                                           
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>