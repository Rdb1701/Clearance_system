<?php include('../header.php');


$query = '
SELECT
st.*, 
sar.access_name
FROM staff AS st
LEFT JOIN staff_access_right as sar ON st.access_right_id = sar.access_right_id WHERE staff_id ='.$_SESSION['staff']['staff_id'].'';

$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['access_name'];

    if ($Aa == 'admin') {
        ?> <script type = "text/javascript" > //then it will be redirected
            alert("Restricted Page! You will are not allowed to access");
        window.location = "../includes/user_logout2.php"; </script>
        <?php
    }
}

?>

<div class="row show-grid">
  <div class="col-md-4">
    <!-- students records -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">No. of Enrolled Students</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                <?php 
                $query = "SELECT COUNT(*) FROM students";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                       while ($row = mysqli_fetch_array($result)) {
                           echo "$row[0]";
                         }
                        ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-user-graduate"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <div class="col-md-4">
    <!-- Request record -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No. of Pending & Lackings</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                <?php 
                $query = "SELECT COUNT(DISTINCT student_id) FROM request_transaction WHERE staff_id = '".$_SESSION['staff']['staff_id']."'
                AND (status = '0' OR status = '2')";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                  echo "$row[0]";
                  } 
                        ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-spinner"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>


<div class="col-md-4">
    <!-- Approved record -->
    <div class="col-md-12 mb-3">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-0">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Approved Request</div>
              <div class="h6 mb-0 font-weight-bold text-gray-800 fw-bold">
                <?php 
                $query = "SELECT COUNT(DISTINCT student_id) FROM request_transaction WHERE staff_id = '".$_SESSION['staff']['staff_id']."'
                AND status = '1'";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while ($row = mysqli_fetch_array($result)) {
                  echo "$row[0]";
                  }       
                  ?> Record(s)
              </div>
            </div>
            <div class="col-auto">
              <h2 class="fa fa-circle-check"></h2>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>





</div>







<?php include('../footer.php') ?>