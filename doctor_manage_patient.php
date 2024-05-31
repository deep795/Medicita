<?php
   include "action/databaseconn.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "SELECT DISTINCT patient_id FROM appointment where doc_id = '".$_SESSION['id']."'";
   $result = $conn->query($sql);
   $arr_users = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage Patient</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <?php 
                            if($result->num_rows > 0)
                                {
                                    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php if(!empty($arr_users)) { ?>
                            <?php foreach($arr_users as $r) { ?>
                            <?php
                                $sql1 = "SELECT * FROM user where id = '".$r['patient_id']."'";
                                $result1 = $conn->query($sql1);
                                $arr_users1 = [];
                            ?>
                            <?php 
                            if($result1->num_rows > 0)
                                {
                                    $arr_users1 = $result1->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <tbody>
                            <?php if(!empty($arr_users1)) { ?>
                                <?php foreach($arr_users1 as $r1) { ?>
                                <tr>
                                    <td><?php echo $r1['first_name'] ?></td>
                                    <td><?php echo $r1['last_name'] ?></td>
                                    <td><?php echo $r1['email'] ?></td>
                                    <td><?php echo $r1['mobile_number'] ?></td>
                                    <td>
                                    <div class="d-flex">
                                        <a href=<?php echo "patient_detail.php?id=".$r1['id'] ?>><button type="button" class="btn btn-info shadow btn-xs sharp mr-1 view-modal" data-toggle="modal" data-id="<?= $r1['id'] ?>" data-target="#viewModal"><i class="fa fa-eye"></i></button></a>
                                    </div>
                                    </td>
                                </tr>
                                <?php }} ?>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
   include "footer.php";
?>

<script>
    var table = $('#example3').DataTable();
</script>