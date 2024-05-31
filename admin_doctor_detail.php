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
                                        $query = "SELECT * FROM user INNER JOIN doc_basic_profile ON doc_basic_profile.user_id = user.id WHERE id = '".$_GET['id']."'";                                        $result = mysqli_query($conn, $query);
                                        $arr_doctor = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doctor)) { ?>
                                    <?php foreach($arr_doctor as $r) { ?>
                                    <div class="media align-self-start">
                                        <img alt="image" class="rounded" width="130" src=<?php echo "image/".$r['profile_photo'] ?>>
                                    </div>
                                    <div class="media-body">
                                    
                                        <h2 class="mb-2"><?=$r['first_name']?> <?=$r['last_name']?></h2>
                                    <?php }} ?>
                                    </div>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Short Biography</h3>
                                    <p class="mb-3"><?=$r['bio']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Education</h3>
                                    <p class="mb-3"><?=$r['education']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Award</h3>
                                    <p class="mb-3"><?=$r['award']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Speciality</h3>
                                    <p>
                                    <?php 
                                        $query = "select * from doc_speciality where id = '".$r['speciality_id']."'";
                                        $result = $conn->query($query);
                                        $arr_speciality = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                        <?php if(!empty($arr_speciality)) { ?>
                                            <?php foreach($arr_speciality as $r) { ?>
                                                <p value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></p>
                                        <?php }} ?>
                                    </p>
                                </div>
                                <div class="doctor-info-content">
                                    <p>
                                    <?php 
                                        $query = "select * from doc_venue where doc_id = '".$_GET['id']."'";
                                        $result = mysqli_query($conn, $query);
                                        $arr_venue = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_venue = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_venue)) { ?>
                                    <?php foreach($arr_venue as $r1) { ?>
                                        <h3 class="text-black mb-3">Venue Name</h3>
                                        <p class="mb-3"><?=$r1['venue_1_name']?></p>
                                    </p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Venue Address</h3>
                                    <p class="mb-3"><?=$r1['venue_1_address']?></p>
                                </div>
                                <div class="doctor-info-content">
                                    <h3 class="text-black mb-3">Venue Image</h3>
                                    <img alt="image" class="rounded" width="130" src=<?php echo "venue-image/".$r1['venue_1_image'] ?>>
                                </div>
                                <?php }} ?>
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