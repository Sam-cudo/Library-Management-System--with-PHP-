<?php

    $errors = array('adminId' => '', 'password' => '');
    $adminId = $password = '';

    if(isset($_POST['Submit']))
    {
        //Member ID validation
        if(empty($_POST['AdminID']))
            $errors['adminId'] = "Admin ID is required <br />";
        else
        {
            $adminId = htmlspecialchars($_POST['AdminID']);
            if(!filter_var($adminId, FILTER_VALIDATE_EMAIL))
            $errors['adminId'] = "Please enter a valid Member ID <br />";
        }    

        //Password Validation
        if(empty($_POST['Password']))
            $errors['password'] = "Password is required <br />";
        else
            $password = htmlspecialchars($_POST['Password']);

        //Validating user from database
        include('conn.php');
        $sql = "SELECT * FROM admin_login_tbl WHERE username = '$adminId' AND password = '$password';";
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt === false ) 
            die( print_r( sqlsrv_errors(), true));

        $result = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );

        if(!empty($result))
        {
            setcookie('role', 'admin', time() + 86400);
            setcookie('adminId', $result['username'], time() + 86400);
            header('Location: index.php');
        }
        else
            $showModal = "true";

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }
?>


<!DOCTYPE html>
<html>
    <?php include('templates/header.php') ?>

    <?php 
    if(!array_filter($errors) && !empty($showModal))
    {
        $title = "Invalid Credentials!!!";
        $data = "Please try again.";
    ?>

    <script type="text/javascript">
        $(document).ready(function(){
	    	$("#Modal").modal("show");
	    });
    </script>

    <?php }?>

<!-- Error Modal -->
    <div>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
            <div class="modal-dialog" style="background-color: #eeeeee">
                <div class="modal-content" style="background-color: #eeeeee">
                    <div class="modal-header">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <center>
                                        <h4 class="modal-title" style="color: #009688"><?php echo $title; ?></h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h5 class="modal-data"><?php echo $data; ?></h5>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img src="imgs/adminuser.png" width="150" />
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h3 style="color: #009688">Member Login</h3>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="adminlogin.php" method="POST">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="AdminID" placeholder="Admin ID" value="<?php echo $adminId; ?>"></input>
                                        <div style="color: red"><?php echo $errors['adminId']; ?></div>
                                    </div>
                                    <div class="form-group">
                                    <input class="form-control" type="password" name="Password" placeholder="Password" value="<?php echo $password; ?>"></input>
                                    <div style="color: red"><?php echo $errors['password']; ?></div>
                                    </div>
                                    <div class="form-group">
                                        <input style="background-color: #009688" class="btn btn-success btn-block" type="submit" name="Submit" value="Log-In"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('templates/footer.php') ?>
</html>



