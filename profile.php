<!DOCTYPE html>
<html>

    <?php include('templates/header.php') ?>

    <div>
        <!-- Modal -->
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
                                        <h4 class="modal-title" style="color: #009688"></h4>
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
                                        <h5 class="modal-data"></h5>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <form>
                    <br />
                    <div class="card">
                        <div class="card-body" style="background-color: #eeeeee">
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <img src="imgs/generaluser.png" width="100px" />
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <center>
                                        <h4 style="color: #009688">Your Profile</h4>
                                        <span>Account Status: </span>
                                        <label class="badge badge-pill badge-info">Pending</label>
                                    </center>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <hr />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Full Name</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="FullName" placeholder="Enter Full Name" value="<?php echo $fullName; ?>"></input>
                                        <div style="color: red"><?php echo $errors['fullName']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Date of Birth</label>
                                    <div class="form-group">
                                        <input class="form-control" type="date" name="DOB" placeholder="Enter DOB" value="<?php echo $dob; ?>"></input>
                                        <div style="color: red"><?php echo $errors['dob']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Contact Number</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="Contact" placeholder="Enter phone number" value="<?php echo $contact; ?>" readonly></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail ID</label>
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="MemberID" placeholder="E-mail address (will be your Member ID)" value="<?php echo $memberId; ?>" readonly></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Old Password</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="Password" placeholder="Enter your password" value="<?php echo $password; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>New Password</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="NewPassword" placeholder="Enter new password" value="<?php echo $newPassword; ?>"></input>
                                        <div style="color: red"><?php echo $errors['newPassword']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Confirm New Password</label>
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="ConPassword" placeholder="Enter your password again" value="<?php echo $conPassword; ?>"></input>
                                        <div style="color: red"><?php echo $errors['conPassword']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>State</label>
                                    <div class="form-group">
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
                                    <label>City</label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="City" placeholder="Enter city" value="<?php echo $city; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Pin Code</label>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="PinCode" placeholder="Enter pincode" value="<?php echo $pincode; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input style="background-color: #009688" class="btn btn-success btn-block" type="submit" name="Submit" value="Update"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <br />
                <div class="card">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img src="imgs/books1.png" width="100px" />
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Issued Books</h4>
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
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include('templates/footer.php') ?>
    
</html>