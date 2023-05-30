<?php

    $borrowed = $available = $members= $active = $pending = $deactive = 0;
    include('conn.php');

    //Borrowed books count
    $sql = 'SELECT * FROM book_issue_tbl';
    $stmt = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $borrowed++;
    }

    //Avaialable books count
    $sql = 'SELECT * FROM book_master_tbl';
    $stmt = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $available += $row['current_stock'];
    }

    //Total Members count
    $sql = 'SELECT * FROM member_master_tbl';
    $stmt = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $members++;
    }

    //Active Members count
    $sql = "SELECT * FROM [member_master_tbl] WHERE account_status='Active'";
    $stmt = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $active++;
    }

    //Pending Members count
    $sql = "SELECT * FROM [member_master_tbl] WHERE account_status='Pending'";
    $stmt = sqlsrv_query($conn, $sql);
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $pending++;
    }

    //Deactive Members count
    $deactive = $members - $active - $pending;

    //Data array for graph
    $data = array($active,$pending,$deactive);
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <?php include('templates/sidebar.php'); ?>
    <div class="content" id="content">
    <button class="toggleButton" id="toggleButton"></button>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 style="color: #009688; font-weight:bold;"><?php echo $borrowed; ?></h4>
                                <h5>Borrowed Books</h5>
                            </div>
                            <div class="col-md-5">
                                <img src="imgs/borrow-book.png" width="80" height="80" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 style="color: #009688"><?php echo $available; ?></label>
                                <h5>Available Books</h5>
                            </div>
                            <div class="col-md-5">
                                <img src="imgs/book-shelf.png" width="80" height="80" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 style="color: #009688"><?php echo $members; ?></h4>
                                <h5>Members</h5>
                            </div>
                            <div class="col-md-e">
                                <img src="imgs/members3.png" width="80" height="80" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Today Dues</h4>
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
                                    $date = date('Y-m-d', time());
                                    $sql="SELECT * FROM [book_issue_tbl] WHERE due_date = '$date'";
                                    $stmt = sqlsrv_query($conn, $sql);
                                ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="table-success">
                                            <th>Member ID</th>
                                            <th>Member Name</th>
                                            <th>Book ID</th>
                                            <th>Member Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)):
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['member_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['member_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['book_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['book_name']) ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Members Status</h4>
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
                                <center>
                                    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                    <script>
                                        var xValues = ["Active", "Pending", "Deactive"];
                                        <?php 
                                            $js_array = json_encode($data);
                                            echo "var yValues = ". $js_array . ";\n";
                                        ?>
                                        var barColors = [
                                          "#008450",
                                          "#EFB700",
                                          "#B81D13",
                                        ];

                                        new Chart("myChart", {
                                          type: "pie",
                                          data: {
                                            labels: xValues,
                                            datasets: [{
                                              backgroundColor: barColors,
                                              data: yValues
                                            }]
                                          },
                                        });
                                    </script>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Defaulter List</h4>
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
                                    $date = date('Y-m-d', time());
                                    $sql="SELECT * FROM [book_issue_tbl] WHERE due_date < '$date'";
                                    $stmt = sqlsrv_query($conn, $sql);
                                ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="table-success">
                                            <th>Member ID</th>
                                            <th>Member Name</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)):
                                        ?>
                                        <tr class='table-danger'>
                                            <td><?php echo htmlspecialchars($row['member_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['member_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['issue_date']) ?></td>
                                            <td><?php echo htmlspecialchars($row['due_date']) ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color: #eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color: #009688">Pending Members</h4>
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
                                    $sql="SELECT * FROM [member_master_tbl] WHERE account_status='Pending'";
                                    $stmt = sqlsrv_query($conn, $sql);
                                ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class='table-success'>
                                            <th>Member ID</th>
                                            <th>Full Name</th>
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)):
                                        ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['member_id']) ?></td>
                                            <td><?php echo htmlspecialchars($row['full_name']) ?></td>
                                            <td><?php echo htmlspecialchars($row['contact_no']) ?></td>
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