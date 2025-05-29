<div class="col-sm">
       <!-- Modal -->
       <div class="modal fade" id="editTr<?php echo $res['trner_id']?>" tabindex="-1" role="dialog"  style="display: none;" aria-hidden="true">
                                     
       <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Trainer info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                <section class="hk-sec-wrapper">
                                                <div class="row">
                                                        <div class="col-sm">
                                                            <form name="update_tr" method="post" action="trainerstb/update_querry.php">
                                                                <div class="row">
                                                                <div class="col-md-3 form-group">
                                                                    <label class="required" >Title</label>
                                                                    <select class="form-control" name="trner_title"  onChange="getSubCat(this.value);"  required>
                                                                    <option value="<?php echo $res["trner_title"];?>"><?php echo $res["trner_title"];?></option>
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
                                                                    <div class="col-md-4 form-group">
                                                                        <label for="firstName">First name</label>
                                                                        <input class="form-control" name="trner_first_name" placeholder="First name" value="<?php echo $res["trner_first_name"];?>" type="text">
                                                                    </div>
                                                                    <div class="col-md-4 form-group">
                                                                        <label for="lastName">Middle name</label>
                                                                        <input class="form-control" name="trner_middle_name" placeholder="Middle name" value="<?php echo $res["trner_middle_name"];?>" type="text">
                                                                    </div>
                                                                    <div class="col-md-4 form-group">
                                                                        <label for="lastName">Last name</label>
                                                                        <input class="form-control" name="trner_last_name" placeholder="Last name" value="<?php echo $res["trner_last_name"];?>" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-md-6 form-group">
                                                                    <label > Date of Birth</label>
                                                                    <input type="date" class="form-control"  name="trner_birth_date" placeholder="Enter Date of Birth" value="<?php echo $res["trner_birth_date"];?>">
                                                                
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                    <label class="required" >Gender</label>
                                                                    <select class="form-control" name="trner_gender"  onChange="getSubCat(this.value);" required>
                                                                    <option value="<?php echo $res["trner_last_name"];?>"><?php echo $res["trner_last_name"];?></option>
                                                                    
                                                                    <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>

                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <hr>
                                                                <h5 class="hk-sec-title">Adress</h5>
                                                                <div class="row">
                                                                <div class="col-md-4 mb-10">
                                                                <label class="required"> Region </label>
                                                        <input type="text" class="form-control"  name="trner_region" placeholder="Region" value="<?php echo $res["trner_region"];?>" required>
                                                                </div>
                                                                <div class="col-md-4 mb-10">
                                                                <label class="required"> City </label>
                                                        <input type="text" class="form-control"  name="trner_city" placeholder="Enter City" value="<?php echo $res["trner_city"];?>" required>
                                                                </div>
                                                                    <div class="col-md-4 mb-10">
                                                                    <label > Sub-City </label>
                                                        <input type="text" class="form-control"  name="trner_sub_city" placeholder="Sub-City " value="<?php echo $res["trner_sub_city"];?>">
                                                        
                                                                    </div>
                                                                    <div class="col-md-6 mb-10">
                                                                    <label >Phone Number :</label>
                                                        <input type="tel" name="trner_phone" class="form-control" pattern="^\d{10}$" placeholder="(format: xxxxxxxxxx)" value="<?php echo $res["trner_phone"];?>">
                                                    
                                                                    </div>
                                                                    <div class="col-md-6 mb-10">
                                                                    <label >email</label>
                                                        <input type="email" class="form-control"  name="trner_email" placeholder="you@example.com" value="<?php echo $res["trner_email"];?>" >
                                                        
                                                                    </div>
                                                                
                                                                    </div>
                                                                
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                        <label for="firstName">Institution</label>
                                                                        <input class="form-control" name="trner_inistitute" placeholder="Institution" value="<?php echo $res["trner_inistitute"];?>" type="text">
                                                                    </div>
                                                                    <div class="col-md-6 form-group">
                                                                        <label for="lastName">Level of Education</label>
                                                                        <input class="form-control" name="trner_edu" placeholder="Level of Education" value="<?php echo $res["trner_edu"];?>" type="text">
                                                                    </div>
                                                                    
                                                                </div>
                                                                <?php
                                                                    $trner_data_id=$res['trner_id'];
                                                                    $sql2 = "SELECT * FROM `trainer` LEFT JOIN `event` ON `trainer`.`fk_event`=`event`.`ev_id` LEFT JOIN `topic` ON `trainer`.`fk_topic`=`topic`.`topic_id` WHERE `trainer`.`trner_id`='$trner_data_id'";
                                                                    $tr_data = mysqli_query($conn,$sql2);
                                                                    while ($trdata = mysqli_fetch_array($tr_data,MYSQLI_ASSOC)):; 
                                                                ?>
                                                                <div class="row">
                                                                <div class="col-md-6 mb-10">
                                                                    <label class="required">Training</label>
                                                            
                                                                    <select class="form-control" name="event"  onChange="getSubCat(this.value);" required>
                                                                        <option value="<?php echo $trdata["ev_id"];?>"><?php echo $trdata["ev_tittle_subject"];?></option>
                                                                        
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

                                                                <div class="col-md-6 mb-10">
                                                                    <label class="required">Training Tospic</label>
                                                            
                                                                    <select class="form-control" name="topic"  onChange="getSubCat(this.value);" required>
                                                                        <option value="<?php echo $trdata["topic_id"];?>"><?php echo $trdata["topic_title"];?></option>
                                                                        
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
                                                                            <?php 
                                                                                endwhile; 
                                                                            ?>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                    <label class="required">Assign Room</label>
                                                        
                                                                    <select class="form-control " name="rooms"  onChange="getSubCat(this.value);" data-live-search="true" required>
                                                                        <option value="">Select Room </option>
                                                                        
                                                                            <?php
                                                                                $sql = "SELECT * FROM `room` WHERE `room_booked`='Available' ORDER BY `room`.`room_no`";
                                                                                $all_room = mysqli_query($conn,$sql);
                                                                                while ($rooms = mysqli_fetch_array($all_room,MYSQLI_ASSOC)):; 
                                                                            ?>
                                                                                <option value="<?php echo $rooms["room_no"];
                                                                                ?>">
                                                                                    <?php echo $rooms["room_no"];
                                                                                        // To show the category name to the user
                                                                                    ?>
                                                                                </option>
                                                                            <?php 
                                                                                endwhile; 
                                                                                // While loop must be terminated
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <hr>
                                                                    <input type="hidden" name="tr_id" value="<?php echo $res['trner_id']?>"/>
                                                                    <button name="update" class="btn btn-primary">Update </button>
                                                                    <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    
                                                                </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </section>
                                                

                                       
                                                </div>

                                                </div>
                                        </div>
                                    </div>
                                    
                             
</div>
<div class="col-sm">
