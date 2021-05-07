<style>
  .modal-body>input>label {
    font-family: 'Montserrat', sans-serif;
    font-size: 12px;
  }
  .form-group > .select2-container {
    width: 100% !important;
  }
</style>

<body>
  <?php error_reporting('E_ALL'); ?>
  <div class="page-wrapper chiller-theme toggled">

    <?php include('header.php'); ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
    <main class="page-content">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-12 col-md-12 content" style="min-height:780px;">
            <?php include('page_head.php');
            $datateam = getDatacount($agent_data);
            ?>

            <div class="row activity-row">
              <div class="col-md-10 activity">Agent List</div>
              <div style="float: right;">
                <button class="btn btn-primary" onclick="openmodal()" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Add Agent</button>
              </div>
            </div>
            <div class="row activity-row">
              <div class="col-md-2 activity">
                <div class="card card-body shadow-lg h-1 bg-white rounded">
                  <span style="white-space: nowrap;">Total Employee</span>
                  <h2 style="text-align:center"><?php echo sizeof($agent_data); ?></h2>
                </div>
              </div>
              <div class="col-md-2 activity">
                <div class="card card-body shadow-lg  bg-white rounded">
                  Voice Team
                  <h2 style="text-align:center"> <?php print_r($datateam['Voiceteamcount']); ?></h2>
                </div>
              </div>
              <div class="col-md-2 activity">
                <div class="card card-body shadow-lg  bg-white rounded">
                  Data Team
                  <h2 style="text-align:center"> <?php print_r($datateam['Datateamcount']); ?></h2>
                </div>
              </div>

              <div class="col-md-2 activity">
                <div class="card card-body shadow-lg  bg-white rounded"><span style="white-space: nowrap;">Management</span>
                  <h2 style="text-align:center"> <?php print_r($datateam['Managementcount']); ?></h2>
                </div>
              </div>
              <div class="col-md-3 activity">
                <table class="table table-bordered shadow-lg  bg-white">
                  <tr>
                    <td>HR <h4 style="float:right"><?php print_r($datateam['hrcount']); ?></h4>
                    </td>
                    <td>Business Dev <h4 style="float:right"><?php print_r($datateam['Bsdeveopl']); ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>Software <h4 style="float:right"><?php print_r($datateam['softwarecount']); ?></h4>
                    </td>
                    <td>IT <h4 style="float:right"><?php print_r($datateam['Itcount']); ?></h4>
                    </td>
                  </tr>
                </table>
              </div>

            </div>
            <div class="row emp-table">
              <div class="col-md-12 table-responsive">
                <table class="table" id="tabledata">
                  <thead>
                    <tr>
                      <th scope="col">Emp ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Username</th>
                      <th scope="col">Role</th>
                      <th scope="col">Dept</th>
                      <th scope="col">Client</th>
                      <?php if ($_SESSION['emp_id'] != 'M416') { ?>
                        <th scope="col">Action</th>
                      <?php } ?>
                  </thead>
                  <tbody>
                    <?php if ($agent_data != '') { ?>

                      <?php foreach ($agent_data as $agentdata) { ?>
                        <tr>
                          <th scope="row"><span class="emp-id"><?php echo $agentdata->emp_id; ?></span></th>
                          <td><?php echo ucfirst($agentdata->name); ?></td>
                          <td><?php echo ucfirst($agentdata->username); ?></span></td>
                          <td><?php echo ucfirst($agentdata->role); ?></span></td>
                          <td><?php echo ucfirst($agentdata->department); ?></span></td>
                          <td><?php echo ucfirst($agentdata->client); ?></span></td>
                          <?php if ($_SESSION['emp_id'] != 'M416') { ?>
                            <td style="white-space: nowrap;">
                              <span class="btn btn-primary btn-sm" style="cursor:pointer"><a onclick=" editagent(`<?php echo $agentdata->user_id; ?>`,`<?php echo $agentdata->emp_id; ?>`,`<?php echo $agentdata->name; ?>`,`<?php echo $agentdata->username; ?>`,`<?php echo $agentdata->role; ?>`,`<?php echo $agentdata->department; ?>`,`<?php echo $agentdata->sub_department; ?>`,`<?php echo $agentdata->checkin; ?>`,`<?php echo $agentdata->checkout; ?>`,`<?php echo $agentdata->client; ?>`,`<?php echo $agentdata->doj; ?>`)">Edit</a></span>
                              <?php if ($userdata['role'] == 'admin' || ($userdata['role'] == 'supervisor' && $userdata['department'] == 'HR')) { ?>
                                <span class="btn btn-danger btn-sm" style="cursor:pointer"><a onclick="Deactivate(`<?php echo $agentdata->emp_id; ?>`)">Deactivate</a></span>
                              <?php } ?>
                              <!-- <span class="emp-break-out"><a href="<?php echo base_url() ?>adduser/deleteuser/<?php echo $agentdata->id; ?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>   -->
                            </td>
                          <?php } ?>
                        </tr>



                        <!-- Modal -->


                      <?php } ?>

                      <?php foreach ($agent_data_deactive as $a_deactuv) { ?>
                        <tr style="background:#ead5dc">
                          <th scope="row"><span class="emp-id"><?php echo $a_deactuv->emp_id; ?></span></th>
                          <td><?php echo ucfirst($a_deactuv->name); ?></td>
                          <td><?php echo ucfirst($a_deactuv->username); ?></span></td>
                          <td><?php echo ucfirst($a_deactuv->role); ?></span></td>
                          <td><?php echo ucfirst($a_deactuv->department); ?></span></td>
                          <td><?php echo ucfirst($a_deactuv->client); ?></span></td>
                          <td>
                            <span class="btn btn-primary btn-sm"><a data-toggle="modal" data-target="#edit_Modal_<?php echo $a_deactuv->id; ?>">Edit</a></span>
                            <?php if ($userdata['role'] == 'admin' || ($userdata['role'] == 'supervisor' && $userdata['department'] == 'HR')) { ?>
                              <span style="cursor:pointer" class="btn btn-success btn-sm"><a onclick="Activate(`<?php echo $a_deactuv->emp_id; ?>`)">Activate</a></span>
                            <?php } ?>
                            <!-- <span class="emp-break-out"><a href="<?php echo base_url() ?>adduser/deleteuser/<?php echo $a_deactuv->id; ?>" onClick="return doconfirm();" style="color:red;">Delete</a></span>   -->
                          </td>

                        </tr>
                      <?php } ?>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="padding-top:1px;" class="modal fade" id="edit_Modal" role="dialog">
        <div class="modal-dialog modal-lg">
          <!--Update Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="mons modal-title"><i class="fa fa-pencil-alt"> Update Agent</i> </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body mons">
              <form method="post" action="<?php echo base_url(); ?>adduser/updateuser">
                <div class="row">
                  <!-- First column -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Employee ID:</label>
                      <input class="col-md-12 col-xs-12 form-control" type="hidden" id="userid_edit" name="userid" placeholder="Emp ID" required="" readonly>
                      <input class="col-md-12 col-xs-12 form-control" type="text" id="emp_id_edit" name="emp_id" placeholder="Emp ID" required="" value="<?php echo $agentdata->emp_id; ?>" readonly>
                    </div>
                    <br>

                    <div class="form-group">
                      <label for="">Role:</label>
                      <select class="form-control" name="role" id="role_edit" required="">
                        <option value="">--Select--</option>
                        <option value="agent" <?php if ($agentdata->role == "agent") echo 'selected="selected"'; ?>>Agent</option>
                        <option value="supervisor" <?php if ($agentdata->role == "supervisor") echo 'selected="selected"'; ?>>Supervisor</option>
                      </select>
                    </div>
                    <br>

                    <div class="form-group">
                      <label for="">In-Time:</label>
                      <input type="time" class="form-control" id="checkintimingupdate" name="checkintimingupdate" value="<?php echo $agentdata->checkin; ?>">
                    </div>
                    <br>
                  </div>
                  <!-- Second column -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Employee Name:</label>
                      <input class="col-md-12 col-xs-12 form-control" type="text" id="name_edit" name="name" placeholder="Name" required="" value="<?php echo $agentdata->name; ?>">
                    </div>
                    <br>

                    <?php
                    $sql = $this->db->query("SELECT * FROM department");
                    $dep = $sql->result();
                    ?>

                    <div class="form-group">
                      <label for="">Department:</label>
                      <select class="form-control" name="department" id="departmentupdate" required="" onchange="fixtimingupdate(this.value)">
                        <option value="">--Select--</option>
                        <?php for ($i = 0; $i < count($dep); $i++) { ?>
                          <option value="<?php echo $dep[$i]->department; ?>" <?php if ($dep[$i]->department == $agentdata->department) echo 'selected="selected"'; ?>><?php echo $dep[$i]->department ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <br>

                    <div class="form-group">
                      <label for="">Out-Time:</label>
                      <input type="time" class="form-control" id="checkouttimingupdate" name="checkouttimingupdate" value="<?php echo $agentdata->checkout; ?>">
                    </div>
                    <br>

                    <!-- <div class="form-group">
                      <label for="">Password:</label>
                      <input class="col-md-12 col-xs-12 form-control" type="password" name="password" placeholder="Password" required="">
                    </div>
                  -->
                  </div>

                  <!-- Third column -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">DOJ:</label>
                      <input class="col-md-12 col-xs-12 form-control" type="date" id="doj_edit" name="doj" required="" value="<?php echo $agentdata->doj; ?>">
                    </div>

                    <div class="form-group" id="subdt_viewupdate">
                      <br>
                      <label for="">Sub-Department:</label>
                      <select name="subdepartment" class="form-control" id="subdepartmentupdate">
                        <option value="">--Select--</option>
                        <?php for ($i = 0; $i < count($dep); $i++) {
                          if ($dep[$i]->department != 'MANAGEMENT' && $dep[$i]->department != 'ADMIN') {
                        ?>
                            <option value="<?php echo $dep[$i]->department; ?>"><?php echo $dep[$i]->department ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                    <br>

                    <div class="form-group">
                      <label for="">Username:</label>
                      <input class="col-md-12 col-xs-12 form-control" type="text" id="username_edit" name="username" placeholder="UserName" required="required" value="<?php echo $agentdata->username; ?>" readonly>
                    </div>
                    <br>
                    <div class="form-group" id="reportingPerson">
                      <label for="">Reporting Person:</label>
                      <select data-placeholder="Choose Reporting Person..." name="reportingPerson[]" id="getManagers_edit" multiple class="form-control">
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group ml-3 mr-1">
                    <label for="">Client:</label>
                    <?php
                    $client = explode(',', $agentdata->client);
                    $clisql = $this->db->query("SELECT * FROM client");
                    $client_data = $clisql->result();
                    ?>
                    <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple name="client[]" id="updatemultclient" required="">
                      <!-- <?php foreach ($client_data as $cli) { ?>
                          <option value="<?php echo trim($cli->client); ?>" <?php if (in_array($cli->client, $client) == 1) echo 'selected="selected"'; ?>><?php echo $cli->client ?></option>
                        <?php } ?> -->
                    </select>
                  </div>
                </div>
                <div class="text-center"><br>
                  <button type="submit" class="btn btn-success" name="fupdate"><i class="fa fa-check"> Update</i></button>
                </div>
              </form>
              <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php

    function getDatacount($obj)
    {
      $datacount = 0;
      $voicecount = 0;
      $managementcount = 0;
      $BScount = 0;
      $hrcount = 0;
      $softwarecount = 0;
      $itcount = 0;
      foreach ($obj as $a) {
        if ($a->department == 'DATA') {
          $datacount++;
        } else if ($a->department == 'VOICE') {
          $voicecount++;
        } else if ($a->department == 'MANAGEMENT') {
          $managementcount++;
        } else if ($a->department == 'BUSINESS DEVELOPMENT') {
          $BScount++;
        } else if ($a->department == 'HR') {
          $hrcount++;
        } else if ($a->department == 'SOFTWARE') {
          $softwarecount++;
        } else if ($a->department == 'IT') {
          $itcount++;
        } else {
        }
      }
      return array("Datateamcount" => $datacount, "Voiceteamcount" => $voicecount, "Managementcount" => $managementcount, "Bsdeveopl" => $BScount, "hrcount" => $hrcount, "softwarecount" => $softwarecount, "Itcount" => $itcount);
    }

    ?>

  </div>
  <script>
    function editagent(id, emp_id, name, userid, role, department, subdepartment, intime, outtime, client, doj) {
      $('#edit_Modal').modal('show');
      $('#userid_edit').val(id);
      $('#emp_id_edit').val(emp_id);
      $('#name_edit').val(name);
      $('#username_edit').val(userid);
      $('#role_edit').val(role);
      $('#departmentupdate').val(department);
      if (department == 'MANAGEMENT') {
        $('#subdt_viewupdate').show();
        $('#subdepartmentupdate').val(subdepartment);
      } else {
        $('#subdt_viewupdate').hide();
      }

      $('#checkintimingupdate').val(intime);
      $('#checkouttimingupdate').val(outtime);

      getAllClients(client);
      $('#doj_edit').val(doj);
      if (role == 'supervisor' && department == 'MANAGEMENT') {
        $('#reportingPerson').hide();
        /* $('#reportingPerson').css('opacity', '0');
        $('#reportingPerson').css('pointer-events', 'none'); */
      } else {
        $('#reportingPerson').show();
        getReportingPerson(emp_id);
        /* $('#reportingPerson').css('opacity', '1');
        $('#reportingPerson').css('pointer-events', 'all'); */
      }
    }

    function getAllClients(client) {
      var base_url = $('#base_url').val();
      $.ajax({
        url: base_url + 'Client/getAllClients',
        method: 'GET',
        success: function(res) {
          var data = JSON.parse(res);
          var opt = [];
          $.each(data, function(i, e) {
            var assignedClients = client.split(",");
            var allClient = e.client;
            if (assignedClients.includes(allClient)) {
              opt += `<option value='${allClient}' selected='selected'>${allClient}</option>`;
            } else {
              opt += `<option value='${allClient}'>${allClient}</option>`;
            }
            $("#updatemultclient").html(opt);
          });
        },
        failed: function(err) {
          console.log(err);
        }
      });
    }

    function getReportingPerson(emp_id) {
      var base_url = $('#base_url').val();
      $.ajax({
        url: base_url + 'Client/getReportingPerson',
        method: 'POST',
        data: {
          emp_id: emp_id
        },
        success: function(res) {
          var data = JSON.parse(res);
          var assigned_managers = data.assigned_managers;
          var all_managers = data.all_managers;

          var managers_id = assigned_managers.map(item => item['manager_id']);

          var managerOpt = [];
          all_managers.forEach(res => {
            if (managers_id.includes(res.emp_id)) {
              managerOpt += `<option value='${res.emp_id}/${res.name}' selected='selected'>${res.emp_id}/${res.name}</option>`;
            } else {
              managerOpt += `<option value='${res.emp_id}/${res.name}'>${res.emp_id}/${res.name}</option>`;
            }
          });
          $('#getManagers_edit').html(managerOpt);
        },
        failed: function(err) {
          console.log(err);
        }
      });
    }

    function doconfirm() {
      let del = confirm("Are you sure to delete permanently?");
      if (del != true) {
        return false;
      }
    }

    $('#tabledata').DataTable({
      dom: 'Bfrtip',
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      buttons: [
        'pageLength',
        {
          extend: 'excel',
          title: 'Agent Report',
        },
        {
          extend: 'pdf',
          title: 'Agent Report',
        },
        {
          extend: 'print',
          title: 'Agent Report',
        }
      ],
    });

    var $rows = $('#tabledata tr');
    $('#search').keyup(function() {
      var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
      $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
      }).hide();
    });
  </script>
  <!-- Modal -->
  <div style="padding-top:1px;" class="modal fade" id="agentadd">
    <div class="modal-dialog modal-lg">
      <!-- Add Modal content-->
      <div class="modal-content content">
        <div class="modal-header">
          <h4 class="mons modal-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Agent</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body mons">
          <form method="post" action="<?php echo base_url(); ?>adduser/adduser">
            <div class="row">
              <!-- First column -->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Employee ID:</label>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="userid_add" name="userid" placeholder="Employee ID" required="">
                </div>
                <br>

                <div class="form-group">
                  <label for="">Role:</label>
                  <select class="form-control" name="role" required="">
                    <option value="">--Select--</option>
                    <option value="agent">Agent</option>
                    <option value="supervisor">Supervisor</option>
                  </select>
                </div>
                <br>

                <div class="form-group">
                  <label for="">In-Time:</label>
                  <input type="time" class="form-control" id="checkintiming" name="checkintiming">
                </div>
                <br>

                <div class="form-group">
                  <label for="">Username:</label>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="username_add" name="username" placeholder="UserName" required="required">
                </div>
              </div>
              <!-- Second column -->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Employee Name:</label>
                  <input class="col-md-12 col-xs-12 form-control" type="text" name="name" placeholder="Name" required="">
                </div>
                <br>

                <div class="form-group">
                  <label for="">Department:</label>
                  <select class="form-control" name="department" id="department" required="" onchange="fixtiming()">
                    <option value="">--Select--</option>
                    <?php for ($i = 0; $i < count($dep); $i++) { ?>
                      <option value="<?php echo $dep[$i]->department; ?>"><?php echo $dep[$i]->department ?></option>
                    <?php } ?>
                  </select>
                </div>
                <br>

                <div class="form-group">
                  <label for="">Out-Time:</label>
                  <input type="time" class="form-control" id="checkouttiming" name="checkouttiming">
                </div>
                <br>

                <div class="form-group">
                  <label for="">Password:</label>
                  <input class="col-md-12 col-xs-12 form-control" type="password" name="password" placeholder="Password" required="">
                </div>
              </div>
              <!-- Third column -->
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">DOJ:</label>
                  <input class="col-md-12 col-xs-12 form-control" type="date" name="doj" required="">
                </div>

                <div class="form-group" id="subdt_view">
                  <br>
                  <label for="">Sub-Department:</label>
                  <select name="subdepartment" class="form-control" id="subdepartment">
                    <option value="">--Select--</option>
                    <?php for ($i = 0; $i < count($dep); $i++) {
                      if ($dep[$i]->department != 'MANAGEMENT' && $dep[$i]->department != 'ADMIN') {
                    ?>
                        <option value="<?php echo $dep[$i]->department; ?>"><?php echo $dep[$i]->department ?></option>
                    <?php }
                    } ?>
                  </select>
                </div>
                <br>

                <div class="form-group">
                  <label for="">Client:</label>
                  <?php
                  $clisql = $this->db->query("SELECT * FROM client");
                  $cli = $clisql->result();
                  ?>
                  <select data-placeholder="Choose Client..." class="form-control" multiple name="client[]" required="" id="getClient">
                    <?php for ($i = 0; $i < count($cli); $i++) { ?>
                      <option value="<?php echo $cli[$i]->client; ?>"><?php echo $cli[$i]->client ?></option>
                    <?php } ?>
                  </select>
                </div>
                <br>

                <div class="form-group" id="reportingPersonAdd">
                  <label for="">Reporting Person:</label>
                  <?php
                  $managerSql = $this->db->query("SELECT * FROM users where role='supervisor' ");
                  $managerData = $managerSql->result();
                  ?>
                  <select data-placeholder="Choose Reporting Person..." name="reportingPerson[]" id="getManagers" multiple class="form-control">
                    <?php for ($i = 0; $i < count($managerData); $i++) { ?>
                      <option value="<?php echo $managerData[$i]->emp_id . '/' . $managerData[$i]->name; ?>"><?php echo $managerData[$i]->name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="text-center"><br>
              <button type="submit" class="btn btn-success" name="fadd"><i class="fa fa-check"> Submit</i></button>
            </div>
          </form>
        </div>
        <!-- <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span> -->
      </div>
      <!-- Add Modal content End -->
    </div>
  </div>
  </div>
  <script>
    $('#userid_add').blur(() => {
      var emp_id_add = $('#userid_add').val();
      if (emp_id_add != '' && emp_id_add.length > 3) {
        var base_url = $('#base_url').val();

        $.ajax({
          url: base_url + 'Client/checkEmpIdExists',
          method: 'POST',
          data: {
            emp_id_add: emp_id_add
          },
          success: function(res) {
            if (res != 'null') {
              alert('Employee Id already exists');
              $('#username_add, #userid_add').val('');
            } else {
              $('#username_add').attr('readonly', true);
              $('#username_add').val(emp_id_add);
            }
          },
          failed: function(err) {
            console.log(err);
          }
        });
      } else {
        $('#username_add').val('');
      }
    });

    $('#getClient').select2();
    // $('#getClient_edit').select2();
    $('#updatemultclient').select2();
    $('#getManagers').select2();
    $('#getManagers_edit').select2();
    $('#subdt_view').hide();
    $('#subdt_viewupdate').hide();

    function openmodal() {
      $('#agentadd').modal('toggle');
    }

    function fixtimingupdate(data) {
      var dpt = data;
      if (dpt == 'DATA') {
        $('#checkintimingupdate').val('09:00');
        $('#checkouttimingupdate').val('18:00');
      } else if (dpt == 'VOICE' || dpt == 'QA' || dpt == 'BUSINESS DEVELOPMENT') {
        $('#checkintimingupdate').val('18:30');
        $('#checkouttimingupdate').val('03:30');
      } else if (dpt == 'SOFTWARE') {
        $('#checkintimingupdate').val('13:00');
        $('#checkouttimingupdate').val('22:00');
      } else {
        $('#checkintimingupdate').val('');
        $('#checkouttimingupdate').val('');
      }
      if (dpt == 'MANAGEMENT') {
        $('#subdt_viewupdate').show();
        $('#getManagers_edit').hide();
      } else {
        $('#subdt_viewupdate').hide();
        $('#getManagers_edit').show();
      }
    }

    function fixtiming() {
      var dpt = $('#department').children("option:selected").val();
      if (dpt == 'DATA') {
        $('#checkintiming').val('09:00');
        $('#checkouttiming').val('18:00');
      } else if (dpt == 'VOICE' || dpt == 'QA' || dpt == 'BUSINESS DEVELOPMENT') {
        $('#checkintiming').val('18:30');
        $('#checkouttiming').val('03:30');
      } else if (dpt == 'SOFTWARE') {
        $('#checkintiming').val('13:00');
        $('#checkouttiming').val('22:00');
      } else {
        $('#checkintiming').val('');
        $('#checkouttiming').val('');
      }
      if (dpt == 'MANAGEMENT') {
        $('#subdt_view').show();
        $('#reportingPersonAdd').hide();
      } else {
        $('#subdt_view').hide();
        $('#reportingPersonAdd').show();
      }
    }


    function Deactivate(client) {
      if (confirm('Are you sure want to Deactivate this agent?')) {
        $.ajax({
          method: 'post',
          url: '<?php echo base_url(); ?>Adduser/Deactivate',
          data: {
            emp_id: client
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    }

    function Activate(client) {
      if (confirm('Are you sure want to Activate this agent?')) {
        $.ajax({
          method: 'post',
          url: '<?php echo base_url(); ?>Adduser/Activate',
          data: {
            emp_id: client
          },
          dataType: 'json',
          success: function(data) {
            console.log(data);
            window.location.reload();
          }
        });
      }
    }
  </script>
</body>

</html>