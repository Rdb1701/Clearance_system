<?php
include('../header.php');
?>


<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Faculties</h1>
    </i>
    <div style="flex: 1;"></div>

</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form>
                <table class="table align-middle mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Item Position</th>
                        </tr>
                    </thead>
                    <tbody>
                            <!-- DATATABLE -->

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
     $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'faculties/faculties.php', // API endpoint to fetch data
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
                }
            ]
        });

    })
</script>