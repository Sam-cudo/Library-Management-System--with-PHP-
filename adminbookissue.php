<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <?php include('templates/sidebar.php'); ?>
    <div class="content" id="content">
        <button class="toggleButton" id="toggleButton"></button>
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
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Book Issue</h4>
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img src="imgs/books.png" width="100" />
                                </center>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr />
                            </div>
                        </div>
                        <form action="adminbookissue.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Member ID</label>
                                        <select class="form-control" name="MemberID">
                                            <option value="">Select Member ID</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book ID</label>
                                        <select class="form-control" name="BookID">
                                            <option value="">Select Book ID</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Member Name</label>
                                        <input class="form-control" type="text" name="MemberName" placeholder="Member Name" value="<?php echo $memberName; ?>" readonly></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book Name</label>
                                        <input class="form-control" type="text" name="BookName" placeholder="Book Name" value="<?php echo $bookName; ?>" readonly></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Issue Date</label>
                                        <input class="form-control" type="date" name="IssueDate" value="<?php echo $issueDate; ?>"></input>
                                        <div style="color: red"><?php echo $errors['issueDate']; ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Return Date</label>
                                        <input class="form-control" type="date" name="ReturnDate" value="<?php echo $returnDate; ?>"></input>
                                        <div style="color: red"><?php echo $errors['returnDate']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input style="background-color: #009688" class="btn btn-success btn-block" type="submit" name="Issue" value="Issue"></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <input class="btn btn-info btn-block" type="submit" name="Return" value="Return"></input>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Issued Book</h4>
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
    </div>
    <?php include ('templates/footer.php'); ?>
</html>