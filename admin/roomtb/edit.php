                <div class="col-sm">
                               <!-- Modal -->
                                    <div class="modal fade" id="editRoom<?php echo $res['room_id']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
                                    <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form name="form1" method="post" action="roomtb/update_querry.php" >
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group m-b-20 ">
                                                    <label > Room Number</label>
                                                    <input type="hidden" name="room_id" value="<?php echo $res['room_id']?>"/>
							                        <input type="text" name="room_no" value="<?php echo $res['room_no']?>" class="form-control" required="required"/>
                                                    </div>

                                                    <div class="form-group m-b-20">
                                                    <label >Room Type</label>
                                                    <select class="form-control" name="room_type" id="room_type" onChange="getSubCat(this.value);" required>
                                                    <option value="<?php echo $res['room_type']?>"><?php echo $res['room_type']?> </option>

                                                    
                                                        <option value="Standard">Standard </option>
                                                        <option value="Accessible">Accessible</option>
                                                        <option value="Deluxe">Deluxe</option>
                                                        <option value="Mini-suite">Mini-suite</option>

                                                    </select> 
                                                    </div>

                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="update" class="btn btn-primary"> Update</button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                </div>
                                             </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm">
                               <!-- Check In Modal -->
                                    <div class="modal fade" id="checkin<?php echo $res['room_no']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <form name="form1" method="post" action="roomtb/checkin.php" >
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Customer Check IN</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                <section >
                                                <div class="card" style="border-radius: 15px;">
                                                    <div class="card-body p-4">
                                                    <?php
                                                        $b_c_id=$res ['room_no']; 
                                                        $sql = "SELECT * FROM `booking` NATURAL JOIN `room` NATURAL JOIN `customer` WHERE `customer`.`deleted` ='0'AND `booking`.`room_no` = '$b_c_id 'ORDER BY `booking`.`booking_date` DESC LIMIT 1";
                                                        $b_id = mysqli_query($conn,$sql);
                                                        while ($b_c = mysqli_fetch_array($b_id,MYSQLI_ASSOC)):; 
                        
                                                    ?>
                                                        <div class="d-flex text-black">
                                                        <div class="flex-shrink-0">
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                                            alt="Generic placeholder image" class="img-fluid"
                                                            style="width: 100px; border-radius: 10px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="mb-1"><?php echo $b_c['cust_title']?>&nbsp;<?php echo $b_c['cust_first_name']?>&nbsp;<?php echo $b_c['cust_middle_name']?>&nbsp;<?php echo $b_c['cust_last_name']?> ( <?php echo $b_c['cust_type']?> )</h5>
                                                          <br>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Phone Number</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_phone']?></p>
                                                            </div>
                                                            &emsp;&emsp;&emsp;
                                                            <div>
                                                                <p class="small text-muted mb-1">e-mail</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_email']?></p>
                                                            </div>
                                                            </div>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Room Number</p>
                                                                <p class="mb-0"><?php echo $b_c['room_no']?></p>
                                                            </div>
                                                            <div class="px-3">
                                                                <p class="small text-muted mb-1">Check In Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_in']?></p>
                                                            </div>
                                                            <div>
                                                                <p class="small text-muted mb-1">Check Out Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_out']?></p>
                                                            </div>
                                                            </div>
                                                            
                                                            
                                                           
                                                        </div>
                                                        </div>
                                                        <input type="hidden" name="b_c_id" value="<?php echo $b_c['booking_id']?>"/>
                                                        <?php endwhile;?>
                                                    </div>
                                                    </div>
                                                
                                            </section>
                                                    
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="checkin" class="btn btn-primary"> Check In</button>
                                                </div>
                                             </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                               <!-- Check out Modal -->
                                    <div class="modal fade" id="checkout<?php echo $res['room_no']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <form name="form1" method="post" action="roomtb/checkout.php" >
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Customer Check Out</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                <section >
                                                <div class="card" style="border-radius: 15px;">
                                                    <div class="card-body p-4">
                                                    <?php
                                                        $b_c_id=$res ['room_no'];  
                                                        $sql = "SELECT * FROM `booking` NATURAL JOIN `room` NATURAL JOIN `customer` WHERE `customer`.`deleted` ='0'AND `booking`.`room_no` = '$b_c_id 'ORDER BY `booking`.`booking_date` DESC LIMIT 1";
                                                        $b_id = mysqli_query($conn,$sql);
                                                        while ($b_c = mysqli_fetch_array($b_id,MYSQLI_ASSOC)):; 
                        
                                                    ?>
                                                        <div class="d-flex text-black">
                                                        <div class="flex-shrink-0">
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                                            alt="Generic placeholder image" class="img-fluid"
                                                            style="width: 100px; border-radius: 10px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="mb-1"><?php echo $b_c['cust_title']?>&nbsp;<?php echo $b_c['cust_first_name']?>&nbsp;<?php echo $b_c['cust_middle_name']?>&nbsp;<?php echo $b_c['cust_last_name']?> ( <?php echo $b_c['cust_type']?> )</h5>
                                                          <br>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Phone Number</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_phone']?></p>
                                                            </div>
                                                            &emsp;&emsp;&emsp;
                                                            <div>
                                                                <p class="small text-muted mb-1">e-mail</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_email']?></p>
                                                            </div>
                                                            </div>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Room Number</p>
                                                                <p class="mb-0"><?php echo $b_c['room_no']?></p>
                                                            </div>
                                                            <div class="px-3">
                                                                <p class="small text-muted mb-1">Check In Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_in']?></p>
                                                            </div>
                                                            <div>
                                                                <p class="small text-muted mb-1">Check Out Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_out']?></p>
                                                            </div>
                                                            </div>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                            <label>Food Expenses </label>
                                                            <p class="mb-0" align="center"><?php echo $b_c['food_price']?></p>
                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            </div>
                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            <div>
                                                            <label>Drink Expenses </label>
                                                            <p class="mb-0" align="center"><?php echo $b_c['drink_price']?></p>
                                                            </div>
                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            <div>
                                                            <h6>Total Expenses </h6>
                                                            <br>
                                                            <h5 class="mb-1" align="center"><?php echo $b_c['total_price']?></h5>
                                                         
                                                            </div>
                                                            
                                                            </div>
                                                            
                                                           
                                                            <div class="col-md-6 form-group">
                                                            <label for="firstName">Payment</label>
                                                            <input class="form-control"id="payment_amount" name="payment_amount"  type="number">
                                                        </div>
                                                           
                                                        </div>
                                                        </div>
                                                        <input type="hidden" name="b_c_id" value="<?php echo $b_c['booking_id']?>"/>
                                                        <?php endwhile;?>
                                                    </div>
                                                    </div>
                                                
                                            </section>
                                                    
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer">
                                                    <button name="checkout" class="btn btn-primary"> Proceed Checkout</button>
                                                </div>
                                             </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                               <!-- Customer Detail Modal -->
                                    <div class="modal fade" id="cutomerDetails<?php echo $res['room_no']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <form name="form1" method="post" action="roomtb/checkout.php" >
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                <section >
                                                <div class="card" style="border-radius: 15px;">
                                                    <div class="card-body p-4">
                                                    <?php
                                                        $b_c_id=$res ['room_no'];  
                                                        $sql = "SELECT * FROM `booking` NATURAL JOIN `room` NATURAL JOIN `customer` WHERE `customer`.`deleted` ='0'AND `booking`.`room_no` = '$b_c_id 'ORDER BY `booking`.`booking_date` DESC LIMIT 1";
                                                         $b_id = mysqli_query($conn,$sql);
                                                        while ($b_c = mysqli_fetch_array($b_id,MYSQLI_ASSOC)):; 
                        
                                                    ?>
                                                        <div class="d-flex text-black">
                                                        <div class="flex-shrink-0">
                                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                                            alt="Generic placeholder image" class="img-fluid"
                                                            style="width: 100px; border-radius: 10px;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="mb-1"><?php echo $b_c['cust_title']?>&nbsp;<?php echo $b_c['cust_first_name']?>&nbsp;<?php echo $b_c['cust_middle_name']?>&nbsp;<?php echo $b_c['cust_last_name']?> ( <?php echo $b_c['cust_type']?> )</h5>
                                                          <br>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Phone Number</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_phone']?></p>
                                                            </div>
                                                            &emsp;&emsp;&emsp;
                                                            <div>
                                                                <p class="small text-muted mb-1">e-mail</p>
                                                                <p class="mb-0"><?php echo $b_c['cust_email']?></p>
                                                            </div>
                                                            </div>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                                <p class="small text-muted mb-1">Room Number</p>
                                                                <p class="mb-0"><?php echo $b_c['room_no']?></p>
                                                            </div>
                                                            <div class="px-3">
                                                                <p class="small text-muted mb-1">Check In Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_in']?></p>
                                                            </div>
                                                            <div>
                                                                <p class="small text-muted mb-1">Check Out Date</p>
                                                                <p class="mb-0"><?php echo $b_c['check_out']?></p>
                                                            </div>
                                                            </div>
                                                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                                                            style="background-color: #efefef;">
                                                            <div>
                                                            <label>Food Expenses </label>
                                                            <p class="mb-0" align="center"><?php echo $b_c['food_price']?></p>
                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            </div>
                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            <div>
                                                            <label>Drink Expenses </label>
                                                            <p class="mb-0" align="center"><?php echo $b_c['drink_price']?></p>
                                                            </div><div>
                                                            <label>Total Expenses </label>
                                                            <p class="mb-0" align="center"><?php echo $b_c['total_price']?></p>
                                                            </div>

                                                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                            <div>
                                                            <h6>Payment </h6>
                                                            <br>
                                                            <h5 class="mb-1" align="center"><?php echo $b_c['remaining_price']?></h5>
                                                         
                                                            </div>
                                                            
                                                            </div>
                                                            
                                                           
                                                        </div>
                                                        </div>
                                                        <input type="hidden" name="b_c_id" value="<?php echo $b_c['booking_id']?>"/>
                                                        <?php endwhile;?>
                                                    </div>
                                                    </div>
                                                
                                            </section>
                                                    
                                                </div>
                                               
                                             </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                               <!-- Customer Book Modal -->
                                    <div class="modal fade" id="book<?php echo $res['room_no']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
                                    <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <form method="post" enctype="multipart/form-data" action="traineestb/addTrainee.php">
                                                      
                                                <div class="modal-header d-block">
                                                    <h4 class="modal-title text-center" id="exampleModalLabel" >Book Room &emsp; <?php echo $res['room_no']?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
                                                    
                                                <section class="hk-sec-wrapper">
                                                <div class="row">
                                                    <div class="col-sm">
                                                    <div class="row">
                                                            <input type="hidden" name="rooms" value="<?php echo $res['room_no']?>"/>
                                                      
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-md-6 mb-10">
                                                                    <label class="req">Organization</label>

                                                        <select class="selorg" name="organization">
                                                            <option value="">Select Organization </option>          
                                                                        
                                                                        <?php
                                                                                $sql = "SELECT * FROM `organization`";
                                                                                $all_org = mysqli_query($conn,$sql);
                                                                                while ($org = mysqli_fetch_array($all_org,MYSQLI_ASSOC)):; 
                                                                                $org_id=$org["org_id"]
                                                                            ?>
                                                                                <option value="<?php echo $org["org_id"];
                                                                                    // The value we usually set is the primary key
                                                                                ?>">
                                                                                    <?php echo $org["org_name"];
                                                                                        // To show the category name to the user
                                                                                    ?>
                                                                                </option>
                                                                                <?php 
                                                                                endwhile; 
                                                                            ?>
                                                        </select>
                                                        </div>
                                                            
                                                                    <div class="col-md-6 mb-10">
                                                                    <label class="">Training</label>
                                                                    <select  class="selev" name="event" >
                                                                    
                                                                        <option value="">Select Training </option>
                                                                        
                                                                            <?php
                                                                                $sql = "SELECT * FROM `event`";
                                                                                $all_ev = mysqli_query($conn,$sql);
                                                                                while ($ev = mysqli_fetch_array($all_ev,MYSQLI_ASSOC)):; 
                                                                            ?>
                                                                                <option value="<?php echo $ev["ev_id"];
                                                                                    // The value we usually set is the primary key
                                                                                ?>">
                                                                                    <?php echo $ev["ev_tittle_subject"];
                                                                                        // To show the category name to the user
                                                                                    ?>
                                                                                </option>
                                                                            <?php 
                                                                                endwhile; 
                                                                            ?>
                                                                        
                                                                        </select>
                                                                    </div>
                                                        </div>
                                                            
                                                            <div class="form-group">
                                                            <label for="input_tags">Select Topics</label>
                                                                <select class="js-example-basic-multiple" name="topic[]" multiple="multiple">
                                                            
                                                                    <?php
                                                                        $sql = "SELECT * FROM `topic`";
                                                                        $all_topic = mysqli_query($conn,$sql);
                                                                        while ($tp = mysqli_fetch_array($all_topic,MYSQLI_ASSOC)):; 
                                                                    ?>
                                                                        <option value="<?php echo $tp["topic_id"];
                                                                            // The value we usually set is the primary key
                                                                        ?>">
                                                                            <?php echo $tp["topic_title"];
                                                                                // To show the category name to the user
                                                                            ?>
                                                                        </option>
                                                                    <?php 
                                                                        endwhile; 
                                                                        // While loop must be terminatedorg
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-3 form-group">
                                                                <label class="" >Title</label>
                                                                <select class="form-control" name="cust_title"  onChange="getSubCat(this.value);" >
                                                                <option value="">Select Title </option>
                                                                    <option value="Mr.">Mr.</option>
                                                                    <option value="Mrs.">Mrs.</option>
                                                                    <option value="Miss.">Miss.</option>
                                                                    <option value="Dr.">Dr.</option>
                                                                    <option value="Pro.">Pro.</option>
                                                                    <option value="President.">President.</option>
                                                                    <option value="Ambassador">Ambassador.</option>
                                                                    <option value="Minister.">Minister.</option>

                                                                </select>
                                                                </div>
                                                                <div class="col-md-4 mb-10">
                                                                <label class="req"> First Name</label>
                                                                <input type="text" class="form-control"  name="cust_first_name" placeholder="Enter First Name" required >
                                                    
                                                                </div>
                                                                <div class="col-md-4 mb-10">
                                                                <label class="req" > Middle Name</label>
                                                                <input type="text" class="form-control" name="cust_middle_name" placeholder="Enter Middle Name"required >
                                                    
                                                                </div>
                                                                <div class="col-md-4 mb-10">
                                                                <label class="req" > Last Name</label>
                                                                <input type="text" class="form-control" name="cust_last_name" placeholder="Enter Last Name"required >
                                                    
                                                                </div>
                                                            
                                                        
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-3 mb-10">
                                                                <label > Position</label>
                                                    <input type="text" class="form-control"  name="cust_position" placeholder="Job Tittle/Position"  >
                                                            
                                                                </div>
                                                                <div class="col-md-4 mb-10">
                                                                <label class="" >Levels of education</label>
                                                                <select class="form-control" name="cust_edu"  onChange="getSubCat(this.value);" >
                                                                <option value="">Select </option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree">Degree</option>
                                                                    <option value="M.S.">M.S.</option>
                                                                    <option value="PH.D.">PH.D.</option>

                                                                </select>
                                                                </div>    
                                                                <div class="col-md-4 mb-10">
                                                                <label class="" ></label>
                                                                <select class="form-control" name="cust_type"  onChange="getSubCat(this.value);" >
                                                                <option value="">Select </option>
                                                                    <option value="Trainee">Trainee</option>
                                                                    <option value="Trainer">Trainer</option>
                                                                    <option value="Coordinator">Coordinator</option>
                                                                    <option value="Guest">Guest</option>

                                                                </select>
                                                                </div> 
                                                            <div class="col-md-6 form-group">
                                                                <label > Date of Birth</label>
                                                    <input type="date" class="form-control"  name="cust_dob" placeholder="Enter Date of Birth" >
                                                            
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                <label class="req" >Gender</label>
                                                                <select class="form-control" name="cust_gender"  onChange="getSubCat(this.value);" required>
                                                                <option value="">Select Gender </option>
                                                                
                                                                <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>

                                                                </select>
                                                                </div>
                                                                <div class="col-md-3 mb-10">
                                                                <label class="">Disability tatus</label>
                                                                <select class="form-control" name="cust_disability_status"  onChange="getSubCat(this.value);" >
                                                                <option value="">Select Status </option>
                                                                
                                                                <option value="Non Disabled">Non Disabled</option>
                                                                    <option value="Disabled">Disabled</option>

                                                                </select> 
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                            <section class="hk-sec-wrapper">
                                                                
                                                                <h5 class="hk-sec-title">Adress</h5>
                                                                    <div class="row">
                                                                    <div class="col-md-4 mb-10">
                                                                <label class=""> Country </label>
                                                        <input type="text" class="form-control"  name="cust_country" placeholder="Enter Country" >
                                                        
                                                                    </div>
                                                                    <div class="col-md-4 mb-10">
                                                                <label class=""> Region </label>
                                                        <input type="text" class="form-control"  name="cust_region" placeholder="Enter Region" >
                                                        
                                                                    </div>
                                                                    <div class="col-md-4 mb-10">
                                                                <label class=""> City </label>
                                                        <input type="text" class="form-control"  name="cust_city" placeholder="Enter City" >
                                                        
                                                                    </div>
                                                                    <div class="col-md-4 mb-10">
                                                                    <label > Sub-City </label>
                                                        <input type="text" class="form-control"  name="cust_sub_city" placeholder="Enter Sub-City" >
                                                        
                                                                    </div>
                                                                    <div class="col-md-4 mb-10">
                                                                    <label >Phone Number :</label>
                                                        <input type="tel" name="cust_phone" class="form-control"  placeholder="(format: xxxxxxxxxx)" >
                                                    
                                                                    </div>
                                                                    <div class="col-md-4 mb-10">
                                                                    <label >email</label>
                                                        <input type="email" class="form-control"  name="cust_email" placeholder="Enter email" >
                                                        
                                                                    </div>
                                                                
                                                                    
                                                                    </div>
                                                                </section>
                                                            </div>

                                                            <div class="row">
                                                            <div class="col-md-6 form-group">
                                                            <h5><label class=""><?php echo $res['room_no']?></label></h5>
                                                            <input type="hidden" name="rooms" value="<?php echo $res['room_no']?>"/>
                                                
                                                            </div>
                                                        
                                                        </div>
                                                
                                                            </div>
                                                    </div>
                                                </section>
                                                        </div>
                                                        <div style="clear:both;"></div>
                                                        <div class="modal-footer">
                                                            <button name="add" class="btn btn-primary"> Book Room</button>
                                                        </div>
                                                        </form>
                                                  

                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                