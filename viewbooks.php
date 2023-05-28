<!DOCTYPE html>
<html>
    <?php include('templates/header.php') ?>

    <?php include('conn.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md">
                <br />
                <div class="card shadow">
                    <div class="card-body" style="background-color:#eeeeee">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h4 style="color:#009688">Book Inventory List</h4>
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
                                    $sql = "SELECT * FROM book_master_tbl;";
                                    $stmt = sqlsrv_query($conn, $sql);    
                                ?>
                                <table>
                                    <?php
                                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )):
                                            $str = htmlspecialchars($row['book_img_link']);
                                            $row['book_img_link'] = ltrim($str, $str[0]);
                                    ?>
                                    <tr>
                                        <div class="container-fluid">
                                            <td>
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4><?php echo htmlspecialchars($row['book_name']) ?></h4> 
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span>Author - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['author_name']) ?></h7>
                                                                <span> | Genre - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['genre']) ?></h7>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span>Language - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['language']) ?></h7>
                                                                <span> | Publisher - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['publisher_name']) ?></h7>
                                                                <span> | Publish Date - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['publish_date']) ?></h7>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span>Edition - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['edition']) ?></h7>
                                                                <span> | Pages - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['no_of_pages']) ?></h7>
                                                                <span> | Cost - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['book_cost']) ?></h7>
                                                                <span> | Actual Stock - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['actual_stock']) ?></h7>
                                                                <span> | Available - </span>
                                                                <h7 style="font-weight:bold"><?php echo htmlspecialchars($row['current_stock']) ?></h7>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <span style="font-weight:bold">Description - </span>
                                                            <h7><?php echo htmlspecialchars($row['book_description']) ?></h7>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <img src="<?php echo $row['book_img_link']  ?>" width="100" height="140">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <hr />
                                                    </div>
                                                </div>
                                            </td>
                                        </div>
                                    </tr>
                                    <?php endwhile; ?>
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

    <?php include('templates/footer.php') ?>
    
</html>