<?php 

    $errors = array('issueDate' => '','returnDate' => '', 'memberId' => '', 'bookId' => '');
    $issueDate = $returnDate = $bookRow['book_name'] = $memberRow['full_name'] = '';
    include('conn.php');

//Fetching option values for Member ID dropdown    
    $sql = 'SELECT member_id FROM member_master_tbl';
    $stmt = sqlsrv_query($conn, $sql);
    $memberOptions = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $memberOptions[] = $row;
    }

//Fetching option values for Book ID dropdown    
    $sql = 'SELECT book_id FROM book_master_tbl';
    $stmt = sqlsrv_query($conn, $sql);
    $bookOptions = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $bookOptions[] = $row;
    }


    if (isset($_POST['Submit'])) {
        $selectedMember = $_POST["MemberID"];
        $selectedBook = $_POST["BookID"];
    
        // Validate the selected option
        if (empty($selectedOption)) {
            $errorMessage = "Please select an option.";
        } else {

        }
    }

//Fetch the Member Name whenever a Member ID is selected from dropdown
    if (isset($_GET['selectedMember'])) {
        $selectedMember = $_GET["selectedMember"];
        $sql = "SELECT full_name FROM member_master_tbl WHERE member_id = '$selectedMember' ;";
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt === false ) 
            die( print_r( sqlsrv_errors(), true));

            $memberRow = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
    }

//Fetch the Book Name whenever a Book ID is selected from dropdown    
    if (isset($_GET['selectedBook'])) {
        $selectedBook = $_GET["selectedBook"];
        $sql = "SELECT book_name FROM book_master_tbl WHERE book_id = '$selectedBook' ;";
        $stmt = sqlsrv_query($conn, $sql);
        if( $stmt === false ) 
            die( print_r( sqlsrv_errors(), true));

            $bookRow = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );       
    }


    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

?>




<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <script>
        $(document).ready(function() {

        //To retain the selected values After page refresh
            var storedMember = sessionStorage.getItem("selectedMember");
            var selectedMember = storedMember;
            if (storedMember) {
                document.getElementById("MemberID").value = storedMember;
            }

            var storedBook = sessionStorage.getItem("selectedBook");
            var selectedBook = storedBook;
            if (storedBook) {
                document.getElementById("BookID").value = storedBook;
            }

        //Send a get request to server whenever selected value changes of dropdowns
            $('#MemberID').change(function() {
                selectedMember = $(this).val();
                sessionStorage.setItem("selectedMember", selectedMember);
                url = "adminbookissue.php?selectedMember=" + encodeURIComponent(selectedMember) + "&selectedBook=" + encodeURIComponent(selectedBook);
                window.location.href = url;
            });

            $('#BookID').change(function() {
                selectedBook = $(this).val();
                sessionStorage.setItem("selectedBook", selectedBook);
                url = "adminbookissue.php?selectedMember=" + encodeURIComponent(selectedMember) + "&selectedBook=" + encodeURIComponent(selectedBook);
                window.location.href = url;
            });
        });
    </script>

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
                                        <select class="form-control" name="MemberID" id="MemberID">
                                            <option value="">Select Member ID</option>
                                            <?php foreach ($memberOptions as $option) : ?>
                                                <option value="<?php echo $option['member_id']; ?>"><?php echo $option['member_id']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book ID</label>
                                        <select class="form-control" name="BookID" id="BookID">
                                            <option value="">Select Book ID</option>
                                            <?php foreach ($bookOptions as $option) : ?>
                                                <option value="<?php echo $option['book_id']; ?>"><?php echo $option['book_id']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Member Name</label>
                                        <input class="form-control" type="text" name="MemberName" placeholder="Member Name" value="<?php echo $memberRow['full_name']; ?>" readonly></input>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Book Name</label>
                                        <input class="form-control" type="text" name="BookName" placeholder="Book Name" value="<?php echo $bookRow['book_name']; ?>" readonly></input>
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
                                <?php 
                                    include('conn.php');
                                    $sql = "SELECT * FROM book_issue_tbl;";
                                    $stmt = sqlsrv_query($conn, $sql);    
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="table-success">
                                            <th scope="col">Member ID</th>
                                            <th scope="col">Member Name</th>                                            
                                            <th scope="col">Book ID</th>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )): ?>
                                        <!-- Logic for deafulters (red color) -->
                                        <?php $date = date('Y-m-d', time());
                                            if($row['due_date'] > $date): ?>
                                                <tr>
                                            <?php endif; ?>
                                        <?php $date = date('Y-m-d', time());
                                            if($row['due_date'] < $date): ?>
                                                <tr class="table-danger">
                                        <?php endif; ?>
                                            <td><?php echo htmlspecialchars($row['member_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['member_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['book_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['book_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['issue_date']) ?></td>
                                            <td><?php echo htmlspecialchars($row['due_date']) ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <?php 
                                    sqlsrv_free_stmt($stmt);
                                    sqlsrv_close($conn);
                                ?>
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