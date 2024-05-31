<?php
	include "header.php";
?>
	<div class="container-fluid">
		<div class="form-head d-flex mb-3 mb-md-5 align-items-start">
			<div class="mr-auto d-none d-lg-block">
				<h3 class="text-primary font-w600">Hey <?php echo $_SESSION['first_name'] ?>, Welcome to Medicita!</h3>
				<p class="mb-0">Hospital Admin Dashboard</p>
			</div>
		</div>
		<div class="row">
		<div class="col-xl-3 col-lg-6 col-sm-2">
			<a href="admin_appointment.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
								<img src="icons/6146404.png" class="zoom" alt="">
								<!-- <i class="ti-user"></i> -->
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM appointment";
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
			<a href="manage_patient.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">	
							<img src="icons/2750657.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM user where user_type = 'Patient'";
								if ($result=mysqli_query($conn,$sql)) {
									$rowcount=mysqli_num_rows($result); 
								}
							?>
							<p class="mb-1">Patient</p>
							<h4 class="mb-0"><?php echo $rowcount ?></h4>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<a href="manage_assistant_admin.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
							<img src="icons/2750716.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql1 = "SELECT * FROM user where user_type = 'Assistant'";
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
			<a href="manage_doctor.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
							<img src="icons/2750724.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM user where user_type = 'Doctor'";
								if ($result=mysqli_query($conn,$sql)) {
									$rowcount=mysqli_num_rows($result); 
								}
							?>
								<p class="mb-1">Doctor</p>
								<h4 class="mb-0"><?php echo $rowcount ?></h4>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<a href="doctor_speciality.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
							<img src="icons/1946785.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM doc_speciality";
								if ($result=mysqli_query($conn,$sql)) {
									$rowcount=mysqli_num_rows($result); 
								}
							?>
								<p class="mb-1">Speciality</p>
								<h4 class="mb-0"><?php echo $rowcount ?></h4>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<a href="manage_subscription.php">
				<div class="widget-stat card">
					<div class="card-body cursor-pointer p-4">
						<div class="media ai-icon">
							<span class="mr-3">
							<img src="icons/5008056.png" class="zoom" alt="">
							</span>
							<div class="media-body">
							<?php
								$sql = "SELECT * FROM subscription";
								if ($result=mysqli_query($conn,$sql)) {
									$rowcount=mysqli_num_rows($result); 
								}
							?>
								<p class="mb-1">Subscription</p>
								<h4 class="mb-0"><?php echo $rowcount ?></h4>
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
						<img src="icons/1747302.png" class="zoom" alt="">
						</span>
						<div class="media-body">
							<p class="mb-1">Visitors</p>
							<h4 class="mb-0"><?php include("action/count.php"); ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include "footer.php";
?>