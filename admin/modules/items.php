<?php
include('../header.php');
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Items</h1>
    </i>
    <div style="flex: 1;"></div>
    <button class="btn btn-sm btn-rasied btn-primary " data-bs-toggle="modal" data-bs-target="#list_add_modal"><i class="bx bx-plus"></i>Add Item</button>
</h5>
<!-- <input type="text" name="search" id="search" class="form-control" placeholder="Search"><br> -->
<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">item</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
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
include('modals/modal_item.php');
?>

<script>

    //INACTIVE
function item_inactive(item_id){
  $('#inactive_id').val(item_id);
  $('#inactive_modal').modal('show');
}

    //ACTIVE
    function item_active(item_id){
  $('#active_id').val(item_id);
  $('#active_modal').modal('show');
}
    //EDIT COURSE
    function edit_item(item_id) {
        $.ajax({
            url: 'items/item_edit.php',
            type: 'POST',
            data: {
                item_id: item_id
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_edit').prop("disabled", true);
            }
        }).done(function(res) {

            $("#edit_item_id").val(res.item_id);
            $("#edit_item").val(res.item);
            $('#list_edit_modal').modal('show');

        })

    }

    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'items/items.php', // API endpoint to fetch data
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
                }
            ]
        });

        // ADD ITEM
        $('#form_insert').submit(function(e) {
            e.preventDefault();

            let item = $('#add_item').val();


            $.ajax({
                url: 'items/item_add.php',
                type: 'POST',
                data: {
                    item: item

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Added');

                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#list_add_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })

        })

        //Udpate
        $('#form_update').submit(function(e) {
            e.preventDefault();

            let item = $('#edit_item').val();
            let item_id = $('#edit_item_id').val();


            $.ajax({
                url: 'items/item_update.php',
                type: 'POST',
                data: {
                    item: item,
                    item_id: item_id
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Updated');

                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#list_edit_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })

        })


        //INACTIVE ITEM

        $('#inactive_form').submit(function(e) {
            e.preventDefault();

            let inactive_id = $('#inactive_id').val();

            $.ajax({
                url: 'items/item_inactive.php',
                type: 'POST',
                data: {
                    item_id: inactive_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Deactivated');

                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#inactive_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })
        })



         //ACTIVE ITEM

         $('#active_form').submit(function(e) {
            e.preventDefault();

            let active_id = $('#active_id').val();

            $.ajax({
                url: 'items/item_active.php',
                type: 'POST',
                data: {
                    item_id: active_id

                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                    alert('Successfully Activated');

                    var currentPageIndex = table.page.info().page;
                    table.ajax.reload(function() {
                        table.page(currentPageIndex).draw(false);
                    }, false);
                    $('#active_modal').modal('hide');

                } else {
                    alert(res.res_message);
                }

            }).fail(function() {
                console.log('fail')
            })
        })





        //DOCUMENT READy
    })
</script>