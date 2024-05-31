<?php
	include "header.php";
	include "action/databaseconn.php";
?>

<div class="container-fluid">
	<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
		<div class="mr-auto d-none d-lg-block">
			<h3 class="text-primary font-w600">Hey <?php echo $_SESSION['first_name'] ?>, Welcome to Medicita!</h3>
			<p class="mb-0">Doctor Dashboard</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-3 col-lg-6 col-sm-2">
			<a href="doctor_appointment.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
								<img src="icons/6146404.png" class="zoom" alt="">
								<!-- <i class="ti-user"></i> -->
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM appointment where doc_id = '".$_SESSION['id']."'";
								if ($result=mysqli_query($conn,$sql)) {
									$rowcount=mysqli_num_rows($result); 
								}
							?>
								<p class="mb-1">Appointment</p>
								<h4 class="mb-0"><?php echo $rowcount ?></h4>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<a href="doctor_manage_patient.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">	
							<img src="icons/2750657.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql2 = "select count(distinct patient_id) from appointment where doc_id = '".$_SESSION['id']."'";
								$result2 = mysqli_query($conn, $sql2);
								$r = mysqli_fetch_assoc($result2);
							?>
							<p class="mb-1">Patient</p>
							<?php
								foreach ($r as $value) {
							?>
							<h4 class="mb-0"><?php echo $value ?></h4>
							<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<a href="manage_assistant.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
							<img src="icons/2750716.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql1 = "SELECT * FROM assistant_basic_profile WHERE doc_id = '".$_SESSION['id']."'";
								if ($result1=mysqli_query($conn,$sql1)) {
									$rowcount1=mysqli_num_rows($result1); 
								}
							?>
								<p class="mb-1">Assistant</p>
								<h4 class="mb-0"><?php echo $rowcount1 ?></h4>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<div class="widget-stat card">
				<div class="card-body cursor-pointer p-4">
					<div class="media ai-icon">
						<span class="mr-3">
						<img src="icons/2750759.png" class="zoom" alt="">
						</span>
						<div class="media-body">
							<p class="mb-1">Venue</p>
							<h4 class="mb-0">1</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
			<div class="card">
				<div class="card-header border-0 pb-0">
					<h4 class="card-title">Revenue</h4>
					<!-- <select class="form-control style-1 default-select ">
						<option>2021</option>
						<option>2020</option>
						<option>2019</option>
					</select> -->
				</div>
				<div class="card-body pt-2">
					<?php
						$query12 = "select SUM(charge) as total_revenue from appointment where doc_id = '".$_SESSION['id']."' and YEAR(appointment_time) = 2022";    
						$exe12 = mysqli_query($conn,$query12);
						$result12 = mysqli_fetch_assoc($exe12);
					?>
					<h3 class="text-primary font-w600">Rs. <?=$result12['total_revenue']?></h3>
					<div id="chartBar"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	include "footer.php";
?>
 <script src="js/dashboard/dashboard-1.js"></script>