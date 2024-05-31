<?php
   include "action/databaseconn.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "select * from appointment";
   $result = $conn->query($sql);
   $arr_appointment = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">View Appointment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm" id="example3" class="display" style="min-width: 845px">
                            <?php 
                            if($result->num_rows > 0)
                                {
                                    $arr_appointment = $result->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Appointment Type</th>
                                    <th>Dieseas</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($arr_appointment)) { ?>
                                <?php foreach($arr_appointment as $r) { ?>
                                <tr>
                                    <?php 
                                        $query1 = "select * from user where id = '".$r['doc_id']."'";
                                        $result = mysqli_query($conn, $query1);
                                        $arr_doc = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_doc = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doc)) { ?>
                                        <?php foreach($arr_doc as $r2) { ?>
                                            <td><?php echo $r2['first_name'] ?> <?php echo $r2['last_name'] ?></td>
                                    <?php }} ?>
                                    <td><?php echo $r['appointment_type'] ?></td>
                                    <td><?php echo $r['dieseas'] ?></td>
                                    <td><?php $date = new DateTime($r['appointment_time']); echo $date->format('d-m-Y H:i:s');?></td>
                                    <?php
                                        if( $r['status'] == "Upcoming")
                                        {
                                            ?>
                                            <td><span class="badge light badge-primary"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Completed")
                                        {
                                            ?>
                                            <td><span class="badge light badge-success"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Canceled")
                                        {
                                            ?>
                                            <td><span class="badge light badge-danger"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Resheduled")
                                        {
                                            ?>
                                            <td><span class="badge light badge-info"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><span class="badge light badge-warning"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                    ?>
                                </tr>
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