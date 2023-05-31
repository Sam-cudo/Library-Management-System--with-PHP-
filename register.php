<?php

    $errors = array('fullName' => '','dob' => '', 'memberId' => '', 'password' => '', 'conPassword' => '', 'contact' => '', 'terms' => '');
    $fullName = $dob = $contact = $memberId = $password = $conPassword = $state = $city = $pincode = $terms = '';

    if(isset($_POST['Submit']))
    {
        //Full Name validation
        if(empty($_POST['FullName']))
            $errors['fullName'] = "Full Name is required";
        else
            $fullName = htmlspecialchars($_POST['FullName']);

        //DOB validation
        if(empty($_POST['DOB']))
            $errors['dob'] = "Date of Birth is required";
        else
            $dob = htmlspecialchars($_POST['DOB']);

        //Contact Number validation
        if(empty($_POST['Contact']))
            $errors['contact'] = "Contact Number is required";
        else
            $contact = htmlspecialchars($_POST['Contact']);

        // Email/Member ID validation
        if(empty($_POST['MemberID']))
            $errors['memberId'] = "Email is required";
        else
        {
            $memberId = htmlspecialchars($_POST['MemberID']);
            if(!filter_var($memberId, FILTER_VALIDATE_EMAIL))
                $errors['memberId'] = "Please enter a valid Email";
        }    

        //Password Validation
        if(empty($_POST['Password']))
            $errors['password'] = "Password is required";
        else
            $password = htmlspecialchars($_POST['Password']);

        //Confirm Password Validation
        if(empty($_POST['ConPassword']))
            $errors['conPassword'] = "Confirm Password is required";
        else
        {
            $conPassword = htmlspecialchars($_POST['ConPassword']);
            if($_POST['Password'] !== $_POST['ConPassword'])
                $errors['conPassword'] = "Confirm Password and Password should match";
        }

        $state = htmlspecialchars($_POST['State']);
        $city = htmlspecialchars($_POST['City']);
        $pincode = htmlspecialchars($_POST['PinCode']);

        //Terms Validation
        if(empty($_POST['Terms']))
            $errors['terms'] = "Please read terms and coditions carefully and before accepting";


        //Function to check if member already exist
        function checkMember()
        {
            include('conn.php');
            global $memberId;
            $sql = "SELECT * FROM member_master_tbl WHERE member_id = '$memberId' ;";
            $stmt = sqlsrv_query($conn, $sql);
            if( $stmt === false ) 
                die( print_r( sqlsrv_errors(), true));
    
            $result = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
            
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            if(!empty($result))
                return true;
            else
                return false;
        }

        //Function to add new member
        function addMember()
        {
            include('conn.php');
            global $memberId, $password, $fullName, $dob, $contact, $state, $city, $pincode;
            $sql = "INSERT INTO member_master_tbl (member_id, password, account_status, full_name, dob, contact_no, state, city, pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $params = array($memberId, $password, "Pending", $fullName, $dob, $contact, $state, $city, $pincode);

            $stmt = sqlsrv_query( $conn, $sql, $params);
            if( $stmt === false )
            {                            
                sqlsrv_free_stmt($stmt);
                sqlsrv_close($conn);
                return false;
            }               
            else
            {
                sqlsrv_free_stmt($stmt);
                sqlsrv_close($conn);
                return true;                
            }
        }

        if(!array_filter($errors))
        {
            $alreadyExist = checkMember();
            if(!$alreadyExist)
            {
                $memberAdded = addMember();
                $showModal = "true";
                header('Refresh: 5; URL=userlogin.php');
            }

            $showModal = "true";
        }

    }
?>


<!DOCTYPE html>
<html>
    <?php include('templates/header.php') ?>

<!-- Already exsit Modal call -->
    <?php 
        if(@$alreadyExist && !empty($showModal))
        {
            $title = "Invalid Email!!!";
            $data = "A member with same Email already exist.";
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
	    	$("#Modal").modal("show");
	    });
    </script>
    <?php }?>

<!-- Registration succesfull Modal call -->
    <?php 
        if(@$memberAdded && !empty($showModal))
        {
            $title = "Sign Up Successfull!!!";
            $data = "You will be redirected to Login Page.";
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

    <div id="register" class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img src="imgs/generaluser.png" width="100" />
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Register</h4>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr />
                            </div>
                        </div>
                        <form action="register.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name *</label>
                                        <input class="form-control" type="text" name="FullName" placeholder="Enter Full Name" value="<?php echo $fullName; ?>"></input>
                                        <div style="color: red"><?php echo $errors['fullName']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth *</label>
                                        <input class="form-control" type="date" name="DOB" placeholder="Enter DOB" value="<?php echo $dob; ?>"></input>
                                        <div style="color: red"><?php echo $errors['dob']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Number *</label>
                                        <input class="form-control" type="text" name="Contact" placeholder="Enter phone number" value="<?php echo $contact; ?>"></input>
                                        <div style="color: red"><?php echo $errors['contact']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail ID *</label>
                                        <input class="form-control" type="email" name="MemberID" placeholder="E-mail address (will be your Member ID)" value="<?php echo $memberId; ?>"></input>
                                        <div style="color: red"><?php echo $errors['memberId']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input class="form-control" type="password" name="Password" placeholder="Enter your password" value="<?php echo $password; ?>"></input>
                                        <div style="color: red"><?php echo $errors['password']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <input class="form-control" type="password" name="ConPassword" placeholder="Enter your password again" value="<?php echo $conPassword; ?>"></input>
                                        <div style="color: red"><?php echo $errors['conPassword']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control" name="State">
                                            <option value="">Select state</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input class="form-control" type="text" name="City" placeholder="Enter city" value="<?php echo $city; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pin Code</label>
                                        <input class="form-control" type="number" name="PinCode" placeholder="Enter pincode" value="<?php echo $pincode; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="checkbox" name="Terms" value="accepted">
                                        <label for="Terms"> I agree to the Privacy Policy and Terms and Conditions of using E-Library.</label>
                                        <div style="color: red"><?php echo $errors['terms']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input style="background-color: #009688" class="btn btn-success btn-block" type="submit" name="Submit" value="Sign Up"></input>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input style="background-color: #ff5722" class="btn btn-danger btn-block" type="reset" name="Cancel" value="Cancel"></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('templates/footer.php') ?>
</html>



