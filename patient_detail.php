<?php
	include "header.php";
    include "action/databaseconn.php";
?>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex doctor-info-details mb-5">
                                    <?php 
                                        $query = "SELECT * FROM user INNER JOIN patient_basic_profile ON patient_basic_profile.user_id = user.id WHERE id = '".$_GET['id']."'";
                                        $result = mysqli_query($conn, $query);
                                        $arr_doctor = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doctor)) { ?>
                                    <?php foreach($arr_doctor as $r) { ?>
                                    <div class="media align-self-start">
                                    <?php    
                                        if ($r['profile_photo'] > 0) {
                                        ?>
                                        <img class="rounded" width="130" src=<?php echo "image/".$r['profile_photo'] ?> alt="">
                                    <?php
                                    }
                                    else {
                                        ?>
                                        <img class="rounded" src="images/avatar/727399.png" width="130" alt=""/>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="media-body">
                                    
                                        <h2 class="mb-2"><?=$r['first_name']?> <?=$r['last_name']?></h2>
                                    <?php }} ?>    
                                        <p class="mb-md-2 mb-sm-4 mb-2"><?=$r['bio']?></p>
                                    </div>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Email</h3>
                                    <p class="mb-3"><?=$r['email']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Mobile Number</h3>
                                    <p class="mb-3"><?=$r['mobile_number']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Gender</h3>
                                    <p class="mb-3"><?=$r['gender']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Bith-Date</h3>
                                    <p class="mb-3"><?=$r['birth_date']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Short Biography</h3>
                                    <p class="mb-3"><?=$r['bio']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Address</h3>
                                    <p class="mb-3"><?=$r['address'].", ".$r['city'].", ".$r['state'].", ".$r['zip_code']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Health Issue</h3>
                                    <p class="mb-3"><?=$r['health_issue']?></p>
                                </div>
                            </div>
                            <div class="card-footer border-0 pt-0 text-center">
                                <a href="#" class="btn-link">Read More</a>
                            </div>
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