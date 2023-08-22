<?php
include('../header.php');
include('approved/approved.php');
?>
<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h2>Approved</h2>
    </i>
    <div style="flex: 1;"></div>
    <hr>

</h5>
<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table align-middle mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">ID Number</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Year Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($approved) {
                            foreach ($approved as $app) {
                        ?>
                                <td class="text-center"><?php echo $app['username']; ?></td>
                                <td class="text-center"><?php echo $app['fname']; ?> <?php echo $app['lname']; ?></td>
                                <td class="text-center"><?php echo $app['course_name']; ?></td>
                                <td class="text-center"><?php echo $app['year_level']; ?></td>

                            <?php
                            }
                        } else {
                            ?>

                            <tr class="text-center">
                                <td class="text-start text-danger" colspan="11">No Record Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include('../footer.php');
?>