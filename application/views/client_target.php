<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="page-wrapper chiller-theme toggled">
        <?php include('header.php'); ?>
        <main class="page-content">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12 col-md-12 content" style="min-height:780px;">
                        <?php include('page_head.php') ?>
                        <div class="row mt-5 ml-2">
                            <div class="col-md-10 activity">Add Agent Target:</div>
                        </div>
                        <br><br>

                        <div class="row activity-row">
                            <div class="col-md-12 custom_style">
                                <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size:15px;text-decoration:none;">
                                    <li class="nav-item">
                                        <a class="nav-link tablink active" data-toggle="tab" onclick="openPage('task', this, 'white')" data-tab-index="0" id="">Task</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tablink" data-toggle="tab" data-tab-index="1" onclick="openPage('sub_task_section', this, 'white')" id="sub_task_tab">Sub-Task</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link tablink" data-toggle="tab" data-tab-index="1" onclick="openPage('target_section', this, 'white')" id="target_section_tab">Target Setup</a>
                                    </li>
                                </ul>

                                <div class="tabcontent" id="task" style="text-decoration:none;">
                                    <form id="task_insert_form" method="POST">
                                        <div class="row mt-5">
                                            <div class='col-md-3 ml-3'>
                                                <label for="">Select Task Type:</label>
                                                <select name="task_type" id="task_type" class='form-control mt-2' disabled>
                                                    <option value="Productive">Productive</option>
                                                    <option value="Non-Productive" disabled="disabled">Non-Productive</option>
                                                </select>
                                            </div>

                                            <div class='col-md-3'>
                                                <label for="">Add Task</label>
                                                <input type="text" class='form-control' id="task_val" name="task_val" required autocomplete="off">
                                            </div>

                                            <div class='col-md-2' style="margin-top:40px;">
                                                <button class='btn btn-success'><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row emp-table">
                                        <div class="col-md-12 table-responsive">
                                            <div class="row">
                                                <table class='table table-striped' border="1">
                                                    <thead>
                                                        <tr>
                                                            <th>Task Type</th>
                                                            <th>Task</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="task_table">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabcontent" id="sub_task_section" style="display: none;">
                                    <form id="subtask_insert_form" method="POST">
                                        <div class="row mt-5">
                                            <div class="col-md-3">
                                                <label for="">Select Task:</label>
                                                <select name="subtask_task" id="subtask_task" class='form-control'>
                                                    <!--  <option value="voice">Voice</option>
                                                <option value="non_voice">Non-Voice</option>
                                                <option value="training">Training</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Add Sub-Task:</label>
                                                <input type="text" class='form-control mt-1' name="sub_task_val" id="sub_task_val" autocomplete="off">
                                            </div>

                                            <div class="col-md-3" style="margin-top: 40px;">
                                                <button class='btn btn-success'><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row emp-table">
                                        <div class="col-md-12 table-responsive">
                                            <div class="row">
                                                <table class='table table-striped' border="1">
                                                    <thead>
                                                        <tr>
                                                            <th>Task</th>
                                                            <th>Sub-Task</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="sub_task_table">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tabcontent" id="target_section" style="display: none;">
                                    <form id="target_form" method='POST'>
                                        <div class="row mt-5">
                                            <div class="col-md-2">
                                                <label for="">Select Client:</label>
                                                <select name="client_drop" id="client_drop" class='form-control'>
                                                    <!-- <option value="sjhealth">SJ Health</option>
                                                <option value="sandstone">Sandstone</option>
                                                <option value="primal_billing">Primal Billing</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Select Task:</label>
                                                <select name="target_task_tab" id="target_task_tab" class='form-control'>
                                                    <!-- <option value="voice">Voice</option>
                                                <option value="non_voice">Non-Voice</option>
                                                <option value="training">Training</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Select Sub-Task:</label>
                                                <select name="target_subtask" id="target_subtask" class='form-control'>
                                                    <!-- <option value="call_hard">Call-Hard</option>
                                                <option value="call_moderate">Call-Moderate</option>
                                                <option value="call_easy">Call-Easy</option> -->
                                                </select>
                                            </div>

                                            <div class='col-md-2 p-0'>
                                                <label for="">Select Agent:</label>
                                                <select name="multiple_agent" id="multiple_agent" multiple required style="width:205px;">
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="">Target/Hour:</label>
                                                <input type="text" class='form-control m-0' id="target_val" name="target_val" required autocomplete="off">
                                            </div>

                                            <div class="col-md-1" style="margin-top: 28px;">
                                                <button class='btn btn-success'> Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- <div class="row emp-table">
                                        <div class="col-md-12 table-responsive">
                                            <div class="row"> -->
                                    <table class='display' id="target_setup_table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>Client</th>
                                                <th>Task</th>
                                                <th>Sub-Task</th> -->
                                                <th>Agent Id</th>
                                                <th>Agent Name</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>
                                                <!-- <th>Target</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($target_data as $key => $value) { ?>
                                                <tr>
                                                    <!-- <td><?php echo $value->client; ?></td>
                                                    <td><?php echo $value->task; ?></td>
                                                    <td><?php echo $value->sub_task; ?></td> -->
                                                    <td><?php echo $value->agent_id; ?></td>
                                                    <td><?php echo $value->agent_name; ?></td>
                                                    <td><?php echo $value->created_by; ?></td>
                                                    <td><?php echo ($value->updated_by == '' ? '-' : $value->updated_by); ?></td>
                                                    <!-- <td><?php echo $value->target_value; ?></td> -->
                                                    <td>
                                                        <button class='btn btn-primary' onClick='edit_target("<?php echo $value->agent_id; ?>")'><i class=' fa fa-info-circle'></i> View</button>
                                                        <button class='btn btn-danger' onClick="delete_target(<?php echo $value->id; ?>)"> <i class='fa fa-trash'></i> Delete</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- </div>
                                    </div>
                                </div> -->

                                <!-- <div class="row emp-table">
                            <table>
                                <thead>
                                    <tr style='text-align:center;'>
                                        <th>Task</th>
                                        <th>Sub-Task</th>
                                        <th>Target Per Hour</th>
                                        <th><button class="btn btn-success">Add Task</button></th>
                                    </tr>
                                </thead>
                                <tbody id="client_target">
                                </tbody>
                            </table>
                        </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-pencil-alt'></i> Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="task_modal_form" method="POST">
                        <div class=row>
                            <div class="col-md-4">
                                <select name="task_type_popup" id="task_type_popup" class='form-control'>
                                    <option value="Productive">Productive</option>
                                    <option value="Non-Productive" disabled>Non-Productive</option>
                                </select>
                                <!-- <input type="text" name="task_type_popup" id="task_type_popup"> -->
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="task_popup" id="task_popup" class='form-control mt-0' required>
                                <input type="hidden" name="task_edit_id" id="task_edit_id">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="sub_task_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"><i class='fa fa-pencil-alt'></i> Edit Sub-Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sub_task_modal_form" method="POST">
                        <div class=row>
                            <div class="col-md-4">
                                <select name="sub_task_type_popup" id="sub_task_type_popup" class='form-control'>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="sub_task_popup" id="sub_task_popup" class='form-control mt-0' required>
                                <input type="hidden" name="sub_task_edit_id" id="sub_task_edit_id">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Big modal  -->
    <div class="modal fade" id="task_main_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2"><i class='fa fa-pencil-alt'></i> Edit Target Value</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="target_modal_form">
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='pb-3'>
                                    <select id="client_field" class='form-control col-md-2 offset-md-10'>
                                    </select>
                                    <input type="hidden" id="agent_emp_id">
                                </div>
                                <table class='table table-striped' border="1">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Client</th>
                                            <th>Task</th>
                                            <th>Sub-Task</th>
                                            <th>Target</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal_target_tbl"></tbody>
                                </table>
                                <div class='row justify-content-md-center'>
                                    <button class='btn btn-success justify-content-center' type="submit"><i class='fa fa-check'></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script>

    $('#client_field').change(() => {
        var agent_id = $('#agent_emp_id').val();
        edit_target(agent_id, param = 'yes');
    });

    $('#target_modal_form').submit((e) => {
        var base_url = $('#base_url').val();
        var data = $("#target_modal_form").serialize();
        e.preventDefault();
        $.ajax({
            url: base_url + 'Client/target_form_data',
            method: 'POST',
            data: data,
            success: function(res) {
                if (res) {
                    Swal.fire(
                        'Updated!',
                        'Target Value has been Updated.',
                        'success'
                    );

                    location.reload();
                    localStorage.setItem('value', 'yes');
                }
            },
            failed: function(err) {
                console.log(err)
            }
        });
    });

    function edit_target(agent_id, param = '') {
        var base_url = $('#base_url').val();
        var client_id = $('#client_field').val();

        $.ajax({
            url: base_url + 'Client/get_view_target_data',
            method: 'POST',
            data: {
                agent_id: agent_id,
                client_id: client_id,
            },
            success: function(res) {
                var tbody = [];
                var data = JSON.parse(res);
                var i = 1;
                if (data.length > 0) {
                    data.forEach(val => {
                        tbody += `<tr>
                        <td>${i++}</td>
                        <td>${val.client}</td>
                        <td>${val.task}</td>
                        <td>${val.sub_task}</td>
                        <td><input type="text" name="target_field_${val.id}" value="${val.target_value}"></td>
                    </tr>`;
                    });
                } else {
                    tbody += `<tr><td colspan='5'><h5 style='text-align:center;'>No Task or Subtask assigned for ${$('#client_field option:selected').text()}!</h5></td></tr>`;
                }
                $('#modal_target_tbl').html(tbody);
                $('#agent_emp_id').val(agent_id);
                if (param == '') {
                    $('#task_main_modal').modal('toggle');
                }
            },
            failed: function(err) {
                console.log(err);
            }
        });
    }


    $(document).ready(function() {
        $('#target_setup_table').DataTable();
        var ans = localStorage.getItem('value');
        if (ans) {
            $('#target_section_tab').click();
            localStorage.removeItem('value');
        }
    });

    $('#task_modal_form').submit((e) => {
        var base_url = $('#base_url').val();
        var task_edit_id = $('#task_edit_id').val();
        var task_popup = $('#task_popup').val();

        e.preventDefault();
        $.ajax({
            url: base_url + 'Client/task_modal_submit',
            method: 'POST',
            data: {
                task_edit_id: task_edit_id,
                task_popup: task_popup
            },
            success: function(res) {
                generate_task_table();
                $('#task_modal').modal('toggle');
                Swal.fire(
                    'Updated!',
                    'Data has been Updated.',
                    'success'
                );
                localStorage.setItem('value', 'yes');
                location.reload();
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });


    $('#sub_task_modal_form').submit((e) => {
        var base_url = $('#base_url').val();
        var sub_task_edit_id = $('#sub_task_edit_id').val();
        var sub_task_popup = $('#sub_task_popup').val();

        e.preventDefault();
        $.ajax({
            url: base_url + 'Client/sub_task_modal_submit',
            method: 'POST',
            data: {
                sub_task_edit_id: sub_task_edit_id,
                sub_task_popup: sub_task_popup
            },
            success: function(res) {
                generate_subtask_table();
                $('#sub_task_modal').modal('toggle');
                Swal.fire(
                    'Updated!',
                    'Sub-Task has been Updated.',
                    'success'
                );
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });

    function delete_target(target_id) {
        var base_url = $('#base_url').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'Client/delete_target_data',
                    method: 'POST',
                    data: {
                        target_id: target_id
                    },
                    success: function(res) {
                        if (res) {
                          localStorage.setItem("value",'yes');
                            Swal.fire(
                                'Deleted!',
                                'Data has been deleted.',
                                'success'
                            )
                            location.reload();
                        }
                    },
                    failed: function() {
                        console.log(err)
                    }
                });
            }
        });
    }

    $('#defaultOpen_task').click(() => {
        generate_task_table();
    })

    function generate_task_table() {
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Client/generate_task_table',
            method: 'GET',
            success: function(res) {
                var data = JSON.parse(res);
                var tbody = [];
                data.forEach(val => {
                    tbody += `<tr>`;
                    tbody += `<td>${val.task_type}</td>
                        <td>${val.task}</td>
                        <td><button class='btn btn-primary' onClick='edit_task("${val.id}" ,"${val.task}")'><i class='fa fa-pencil-alt'></i> Edit</button>
                        <button class='btn btn-danger' onClick='delete_task("${val.id}" ,"${val.task}")'><i class='fa fa-trash'></i> Delete</button></td>
                        </tr>`;
                });
                $('#task_table').html(tbody);
            },
            failed: function(err) {
                console.log(err);
            }
        });
    }

    function generate_subtask_table() {
        var base_url = $('#base_url').val();
        var subtask_task = $('#subtask_task').val();
        var sub_task_val = $('#sub_task_val').val();

        $.ajax({
            url: base_url + 'Client/generate_subtask_table',
            method: 'POST',
            data: {
                subtask_task: subtask_task,
                sub_task_val: sub_task_val
            },
            success: function(res) {
                var data = JSON.parse(res);
                var tbody = [];
                data.forEach(val => {
                    tbody += `<tr>`;
                    tbody += `<td>${val.task}</td>
                        <td>${val.sub_task}</td>
                        <td><button class='btn btn-primary' onClick='edit_sub_task("${val.id}", "${val.task}","${val.sub_task}")'><i class='fa fa-pencil-alt'></i> Edit</button>
                        <button class='btn btn-danger' onClick='delete_sub_task("${val.id}" ,"${val.sub_task}")'><i class='fa fa-trash'></i> Delete</button></td>
                        </tr>`;
                });
                $('#sub_task_table').html(tbody);
            },
            failed: function(err) {
                console.log(err)
            }
        });
    }


    function edit_task(id, task) {
        var base_url = $('#base_url').val();
        $('#task_modal').modal('toggle');
        $('#task_popup').val(task);
        $('#task_edit_id').val(id);
        /* $.ajax({
            url: base_url + 'Client/edit_task_data',
            method: 'POST',
            data: {
                task_id: id,
                task: task
            },
            success: function(res) {
                console.log(res);
                var data = JSON.parse(res);
                $('#task_modal').modal('toggle');
                $('#task_popup').val(data.task);
                $('#task_edit_id').val(data.id);
            },
            failed: function(err) {
                console.log(err);
            }
        }); */
    }


    function edit_sub_task(id, task, subtask) {
        var base_url = $('#base_url').val();
        $('#sub_task_modal').modal('toggle');
        $('#sub_task_type_popup').html(`<option>${task}</option>`);
        $('#sub_task_popup').val(subtask);
        $('#sub_task_edit_id').val(id);

        /* $.ajax({
            url: base_url + 'Client/edit_sub_task_data',
            method: 'POST',
            data: {
                task_id: id,
                subtask: subtask
            },
            success: function(res) {
                console.log(res);
                $('#sub_task_modal').modal('toggle');
                var data = JSON.parse(res);
                $('#task_popup').val(data.task);
                $('#sub_task_edit_id').val(data.subtask);
            },
            failed: function(err) {
                console.log(err);
            }
        }); */
    }

    function delete_task(task_id, task) {
        var base_url = $('#base_url').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'Client/delete_task',
                    method: 'POST',
                    data: {
                        task_id: task_id
                    },
                    success: function(res) {
                        Swal.fire(
                            'Deleted!',
                            task + 'has been deleted.',
                            'success'
                        )
                        generate_task_table();
                    },
                    failed: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    }

    function delete_sub_task(sub_task_id, task) {
        var base_url = $('#base_url').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'Client/delete_sub_task',
                    method: 'POST',
                    data: {
                        sub_task_id: sub_task_id
                    },
                    success: function(res) {
                        Swal.fire(
                            'Deleted!',
                            task + ' has been deleted.',
                            'success'
                        )
                        generate_subtask_table();
                    },
                    failed: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    }


    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";

        elmnt.style.backgroundColor = color;
    }

    $(document).ready(() => {
        generate_task_table();
        $('#multiple_agent').select2({
            width: "205px",
        });
    });

    // First tab task form submit
    $('#task_insert_form').submit((e) => {
        e.preventDefault();
        var base_url = $('#base_url').val();
        var task_type = $('#task_type').val();
        var task_val = $('#task_val').val();
        var department = "<?php echo $_SESSION['department']; ?>";

        $.ajax({
            url: base_url + 'Client/insert_task',
            method: 'POST',
            data: {
                task_val: task_val,
                task_type: task_type,
                department: department
            },
            success: function(res) {
                if (res) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Inserted successfully!',
                        timer: 1000
                    })
                    $('#task_val').val('');
                    generate_task_table();
                }
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });
    // First tab task form submit

    $('#sub_task_tab').click(() => {
        get_sub_task();
        generate_subtask_table();
    });

    function get_sub_task(param = '') {
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + "Client/get_task_data",
            method: 'POST',
            data: {
                department: "<?php echo $_SESSION['department']; ?>",
            },
            success: function(res) {
                var data = JSON.parse(res);
                var option = [];
                data.forEach(val => {
                    option += `<option value='${val.id}'>${val.task}</option>`;
                })
                $('#subtask_task').html(option);
                if (param) {
                    $('#target_task_tab').html(option);
                    get_sub_task_val();
                }
            },
            failed: function(err) {
                console.log(err)
            }
        });
    }

    // Second sub tab task form submit start
    $('#subtask_insert_form').submit((e) => {
        e.preventDefault();
        var base_url = $('#base_url').val();
        var subtask_task = $('#subtask_task').val();
        var sub_task_val = $('#sub_task_val').val();

        $.ajax({
            url: base_url + 'Client/insert_subtask_data',
            method: 'POST',
            data: {
                'subtask_task': subtask_task,
                'sub_task_val': sub_task_val,
            },
            success: function(res) {
                if (res) $('#sub_task_val').val('');
                Swal.fire({
                    icon: 'success',
                    title: 'Inserted successfully!',
                })
                generate_subtask_table();
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });
    // Second sub tab task form submit end

    // Third tab task click start
    $('#target_section_tab').click(() => {
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Client/get_client_data',
            method: 'GET',
            success: function(res) {
                var data = JSON.parse(res);
                var option = [];
                data.forEach(val => {
                    option += `<option value='${val.id}'>${val.client}</option>`;
                });
                $('#client_drop').html(option);
                $('#client_field').html(option);
                get_sub_task('target_page');
                get_agents_for_user();
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });
    // Third tab task click end

    function get_agents_for_user() {
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Client/get_agents_for_user',
            method: 'GET',
            success: function(res) {
                var data = JSON.parse(res);
                $('#multiple_agent').select2({
                    width: 205,
                    data: data
                });
            },
            failed: function(err) {
                console.log(err)
            }
        });
    }


    $('#target_task_tab').change(() => {
        get_sub_task_val();
    });

    function get_sub_task_val() {
        var base_url = $('#base_url').val();
        var target_task_tab = $('#target_task_tab').val();
        $.ajax({
            url: base_url + 'Client/get_sub_task_val',
            method: 'POST',
            data: {
                target_task_tab: target_task_tab
            },
            success: function(res) {
                var data = JSON.parse(res);
                var option = [];
                data.forEach(val => {
                    option += `<option value='${val.id}'>${val.sub_task}</option>`;
                });
                $('#target_subtask').html(option);
            },
            failed: function(err) {
                console.log(err);
            }
        });
    }

    $('#target_form').submit((e) => {
        e.preventDefault();
        var client_drop = $('#client_drop').val();
        var target_task_tab = $('#target_task_tab').val();
        var target_subtask = $('#target_subtask').val();
        var multiple_agent = $('#multiple_agent').val();
        var target_val = $('#target_val').val();
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Client/insert_target_details',
            method: 'POST',
            data: {
                client_drop: client_drop,
                target_task_tab: target_task_tab,
                target_subtask: target_subtask,
                multiple_agent: multiple_agent,
                target_val: target_val
            },
            success: function(res) {
                if (res) {
                    $('#target_val').val('');
                    $('#multiple_agent').val('').trigger('change');
                    // $('#target_section_tab').click();
                    Swal.fire({
                        icon: 'success',
                        title: 'Form submitted successfully!',
                        timer: 1000
                    });
                    localStorage.setItem('value', 'yes');
                    location.reload();
                }
            },
            failed: function(err) {
                console.log(err);
            }
        });
    });
</script>

<style>
    .custom_style {
        font-weight: 500;
        color: #353b44;
        font-size: 14px;
        font-family: 'Montserrat', sans-serif;
    }

    div#target_setup_table_wrapper {
        width: 100%;
    }
</style>
