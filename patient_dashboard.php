<?php
	include "header.php";
?>
<div class="container-fluid">
	<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
		<div class="mr-auto d-none d-lg-block">
			<h3 class="text-primary font-w600">Hey <?php echo $_SESSION['first_name'] ?>, Welcome to Medicita!</h3>
			<p class="mb-0">Patient Dashboard</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-4 col-lg-6 col-sm-3">
			<div class="widget-stat card">
				<div class="card-body cursor-pointer p-4">
					<div class="media ai-icon">
						<span class="mr-3">
							<img src="icons/6146404.png" class="zoom" alt="">
							<!-- <i class="ti-user"></i> -->
						</span>
						<div class="media-body">
						<?php
							$sql = "SELECT * FROM appointment where patient_id = '".$_SESSION['id']."' and status = 'Upcoming'";
							if ($result=mysqli_query($conn,$sql)) {
								$rowcount=mysqli_num_rows($result); 
							}
						?>
							<p class="mb-1">Upcoming Appointment</p>
							<h4 class="mb-0"><?php echo $rowcount ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-6 col-sm-3">
			<div class="widget-stat card">
				<div class="card-body cursor-pointer p-4">
					<div class="media ai-icon">
						<span class="mr-3">	
						<img src="icons/6145600.png" class="zoom" alt="">
						</span>
						<div class="media-body">
						<?php
							$sql2 = "SELECT * FROM appointment where patient_id = '".$_SESSION['id']."' and status = 'Completed'";
							if ($result2=mysqli_query($conn,$sql2)) {
								$rowcount2=mysqli_num_rows($result2); 
							}
						?>
						<p class="mb-1">Completed Appointment</p>
						<h4 class="mb-0"><?php echo $rowcount2 ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-lg-6 col-sm-3">
			<div class="widget-stat card">
				<div class="card-body cursor-pointer p-4">
					<div class="media ai-icon">
						<span class="mr-3">
						<img src="icons/5267928.png" class="zoom" alt="">
						</span>
						<div class="media-body">
						<?php
							$sql1 = "SELECT * FROM appointment where patient_id = '".$_SESSION['id']."' and status = 'Canceled'";
							if ($result1=mysqli_query($conn,$sql1)) {
								$rowcount1=mysqli_num_rows($result1); 
							}
						?>
							<p class="mb-1">Canceled Appointment</p>
							<h4 class="mb-0"><?php echo $rowcount1 ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-12">
            <div class="widget-stat card">
                <div class="card-header">
                    <h4 class="card-title">Your upcoming Appointment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm" class="display" style="min-width: 845px">
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
<script type="text/javascript">
function jsFunction(value)
{
    <?php ?>
}
</script>