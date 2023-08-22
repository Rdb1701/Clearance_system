<?php
include('../header.php');
?>
\
<h5 class="d-flex" style="margin-bottom: 15px;">
  <i class="bx" style="margin-right: 8px;"><h2>Reports</h2></i> 
  <div style="flex: 1;"></div>
</h5>

 <!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search"><br> -->
<div class="card radius-10">
	<div class="card-body">
		<div class="table-responsive">
      <form action="list.php" method="post">
        <table class="table align-middle mb-0" id="myTable">
          <thead class="table-light">
            <tr>
              <th class="text-center">ID Number</th>
              <th class="text-center">Name</th>
              <th class="text-center">Course</th>
              <th class="text-center">Sem</th>
              <th class="text-center">Date Generated</th>
              <th class="text-center">Date Cleared</th>
              <th class="text-center">Reference No.</th>
            </tr>
          </thead>
          <tbody>
      
          </tbody>
        </table>
      </form>
		</div>
	</div>
</div>


<?php
include('../footer.php');
?>

<script>

    $(document).ready(function(){
        
        var table = $('#myTable').DataTable({
            ajax: 'reports/reports.php', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                },
                {
                    data: [2],
                    "className": "text-center"
                },
                {
                    data: [3],
                    "className": "text-center"
                },
                {
                    data: [4],
                    "className": "text-center"
                },
                {
                    data: [5],
                    "className": "text-center"
                },
                {
                    data: [6],
                    "className": "text-center"
                }
            ]
        });

    })
</script>