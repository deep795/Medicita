<?php
   include "action/databaseconn.php";
   ?>
<?php
   include "header.php";
   ?>
<?php
   $sql = "SELECT * from user";
   $result = $conn->query($sql);
   $arr_users = [];

   $sort = isset($_GET['sort']) ? $_GET['sort'] : "asc";

?>

<!-- row -->
<div class="container-fluid">
   <div class="form-head d-flex align-items-start">
      <div style="margin-right:20px;" class="input-group search-area ml-auto d-inline-flex">
         <input type="text" class="form-control" name="search" id="search" placeholder="Search here">
      </div>
      <div>
         <button type="button" class="btn btn-primary"  onclick="searchFunction()"><i class="flaticon-381-search-2"></i></button>
      </div>
      <select class="form-control style-2 ml-3 default-select" id="sort" name="sort" onchange="searchFunction()">
						<option value="asc" <?=$sort == 'asc' ? ' selected="selected"' : '';?>>A-Z List</option>
						<option value="desc" <?=$sort == 'desc' ? ' selected="selected"' : '';?>>Z-A List</option>
		</select>
   </div>
   <div class="row">
      <div class="col-xl-12">
         <div id="accordion-one" class="accordion doctor-list ">
            <div class="accordion__item">
               <div id="default_collapseOne" class="collapse accordion__body show" data-parent="#accordion-one">
                  <div class="widget-media best-doctor pt-4">
                     <div class="timeline row">
                        <?php 
                        if(isset($_GET['search']) || isset($_GET['sort']))
                        {
                           $query = "select id,first_name,last_name,profile_photo from user where user_type = 'Doctor' and status = 'Approved' and ( CONCAT_WS('', `first_name`, `last_name`) LIKE '%".preg_replace('/\s+/', '', $_GET['search'])."%') order by first_name ".$_GET['sort'];

                        } else{
                           $query = "select id,first_name,last_name,profile_photo from user where user_type = 'Doctor' and status = 'Approved'";
                        }
                        $result = $conn->query($query);
                           $arr_doctor = [];
                           if($result->num_rows > 0)
                           {
                           	$arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                           }
                        ?>
                        <?php if(!empty($arr_doctor)) { ?>
                        <?php foreach($arr_doctor as $r) { ?>
                        <div class="col-lg-6">
                           <div class="timeline-panel bg-white p-4 mb-4">
                              <div class="media mr-4">
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
                                 <a href= <?php echo "doctor_detail.php?id=".$r['id'] ?>>
                                 <h4 class="mb-2"><?=$r['first_name']?> <?=$r['last_name']?></h4>
                                 </a>
                                 <?php 
                                    $query1 = "select education from doc_basic_profile where user_id = '".$r['id']."'";
                                    $result1 = $conn->query($query1);
                                    $arr_doctor_basic = [];
                                    if($result1->num_rows > 0)
                                    {
                                       $arr_doctor_basic = $result1->fetch_all(MYSQLI_ASSOC);
                                    }
                                 ?>
                                 <?php if(!empty($arr_doctor_basic)) { ?>
                                 <?php foreach($arr_doctor_basic as $r1) { ?>
                                 <p class="mb-2 text-primary"><?=$r1['education']?></p>
                                 <?php
                                    $sql = "SELECT * FROM rating where doc_id = '".$r['id']."'";
                                    if ($result=mysqli_query($conn,$sql)) {
                                       $rowcount=mysqli_num_rows($result); 
                                    }
                                 ?>
                                 <?php 
                                    $query2 = "SELECT AVG(rating) AS averagerating FROM rating where doc_id = '".$r['id']."'";
                                    $result2 = $conn->query($query2);
                                    $arr_rating = [];
                                    if($result2->num_rows > 0)
                                    {  
                                       $arr_rating = $result2->fetch_all(MYSQLI_ASSOC);
                                    }
                                 ?>
                                 <?php if(!empty($arr_rating)) { ?>
                                 <?php foreach($arr_rating as $r2) { ?>
                                    <?php if ($r2['averagerating'] > "4" or $r2['averagerating'] == "5") { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php }elseif ($r2['averagerating'] < "4" && $r2['averagerating'] > "3" or $r2['averagerating'] == "4") { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php }elseif ($r2['averagerating'] < "3" && $r2['averagerating'] > "2" or $r2['averagerating'] == "3") { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php }elseif ($r2['averagerating'] < "2" && $r2['averagerating'] > "1" or $r2['averagerating'] == "2") { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php }elseif ($r2['averagerating'] < "1" && $r2['averagerating'] > "0" or $r2['averagerating'] == "1") { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-orange"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="star-review">
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <i class="fa fa-star text-gray"></i>
                                       <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                    </div>
                                    <?php }?>
                                 <?php }} ?>
                                 <?php }} ?>
                              </div>
                              <div class="social-media">
                                 <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-instagram btn-sm"></a>
                                 <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-twitter btn-sm"></a>
                                 <a href="javascript:void(0);" class="btn btn-outline-primary btn-rounded fa fa-facebook btn-sm"></a>
                              </div>
                           </div>
                        </div>
                     <?php }} ?>
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
<script>
function searchFunction()
{
   let search = $('#search').val();
   let sort = $('#sort').val();
   window.location.href = "doctors.php?search="+search+"&sort="+sort;
}

$(document).on('keypress',function(e) {
    if(e.which == 13) {
      searchFunction();
    }
});

</script>