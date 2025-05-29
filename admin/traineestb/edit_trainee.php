
       <!-- Modal -->
       <div class="modal fade" id="editTr<?php echo $res['cust_id']?>" tabindex="-1" role="dialog"  style="display: none;" aria-hidden="true">
                                     
       <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Trainee info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                            <form name="update_tr" method="post" action="traineestb/update_querry.php">
                                                <?php
                                                           $tr_data_id=$res['cust_id'];
                                                          $cust_data_sql = "SELECT * FROM `customer` LEFT JOIN `organization` ON `customer`.`fk_organization`=`organization`.`org_id` LEFT JOIN `event` ON `customer`.`fk_event`=`event`.`ev_id` WHERE `customer`.`cust_id`='$tr_data_id'";
                                                          $tr_data = mysqli_query($conn,$cust_data_sql);
                                                        while ($trdata = mysqli_fetch_array($tr_data,MYSQLI_ASSOC)):; 
                                                    ?>
                                     <div class="row">
                                    <div class="col-md-6 mb-10">
                                                <label class="req">Organization</label>

                                    <select class="selorg" name="organization">
                                        <option value="<?php echo $trdata["org_id"];?>"><?php echo $trdata["org_name"];?></option>          
                                                    
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
                                    </div>
                                        
                                    <div class="form-group">
                                         <label for="input_tags">Select Topics</label>

                                         <?php
                                         $topic_cust_id=$res['cust_id'];
                                                    $sqlt_data = "SELECT `fk_topic_id` FROM `cust_topic` WHERE `fk_cust_id` = $topic_cust_id";
                                                    $allt_data= mysqli_query($conn,$sqlt_data);
                                                    $cust_topics=[];
                                                    foreach($allt_data as $fetchrow){
                                                        $cust_topics[]=$fetchrow['fk_topic_id'];
                                                    }
                                               ?>
                                            <select class="js-example-basic-multiple" name="topic[]" multiple="multiple">
                                        
                                                <?php
                                                    $sql = "SELECT * FROM `topic`";
                                                    $all_topic = mysqli_query($conn,$sql);
                                                    while ($tp = mysqli_fetch_array($all_topic,MYSQLI_ASSOC)):; 
                                                ?>
                                                    <option value="<?php echo $tp["topic_id"]; ?>"
                                                    <?= in_array($tp['topic_id'], $cust_topics) ? 'selected':'' ?>
                                                    >
                                                        <?php echo $tp["topic_title"];
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
                                                        // While loop must be terminated
                                                    ?>
                                        <div class="row">
                                        <div class="col-sm-8">
                                        <div class="card-box">
                                        <label class="" >Photo</label>
                                        <input type="file" class="form-control"  name="cust_img"  >
                                        <br>
                                        </div>
                                        </div>
                                        </div>
                                      <div class="row">
                                      <div class="col-md-3 form-group">
                                            <label class="required" >Title</label>
								            <input type="text" class="form-control"  name="cust_title" placeholder="Enter First Name" value="<?php echo $res["cust_title"];?>"  >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class=""> First Name</label>
								            <input type="text" class="form-control"  name="cust_first_name" placeholder="Enter First Name" value="<?php echo $res["cust_first_name"];?>"  >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class="" > Middle Name</label>
								            <input type="text" class="form-control" name="cust_middle_name" placeholder="Enter Middle Name" value="<?php echo $res["cust_middle_name"];?>"  >
								
                                            </div>
                                            <div class="col-md-4 mb-10">
                                            <label class=""> Last Name</label>
								            <input type="text" class="form-control"  name="cust_last_name" placeholder="Enter Last Name" value="<?php echo $res["cust_last_name"];?>"   >
								    
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4 mb-10">
                                            <label class="required" >Levels of education</label>
                                            <select class="form-control" name="cust_edu"  onChange="getSubCat(this.value);">
                                            <option value="<?php echo $res["cust_edu"];?>"><?php echo $res["cust_edu"];?></option>
                                            <option value="Diploma">Diploma</option>
                                                <option value="Degree">Degree</option>
                                                <option value="M.Sc.">M.Sc.</option>
                                                <option value="LLM.">LLM.</option>
                                                <option value="MBA.">MBA.</option>
                                                <option value="MA.">MA.</option>
                                                <option value="Ph.D.">Ph.D.</option>
                                                <option value="Assoc. Prof.">Assoc. Prof.</option>
                                                <option value="Prof.">Prof.</option>

                                            </select>
                                           
                                            </div> 
                                            <div class="col-md-4 mb-10">
                                            <label > Institution</label>
								            <input type="text" class="form-control"  name="cust_inistitute" placeholder="Job Tittle/Position" value="<?php echo $res["cust_inistitute"];?>" >
										
                                            </div>
                                        <div class="col-md-3 mb-10">
                                            <label > Position</label>
								            <input type="text" class="form-control"  name="cust_position" value="<?php echo $res["cust_position"];?>" >
										
                                        </div>
                                        <div class="col-md-4 mb-10">
                                            <label class="" > ""</label>
                                            <select class="form-control" name="cust_type"  onChange="getSubCat(this.value);" >
                                            <option value="<?php echo $res["cust_type"];?>"><?php echo $res["cust_type"];?></option>
                                                <option value="Trainee">Trainee</option>
                                                <option value="Trainer">Trainer</option>
                                                <option value="Coordinator">Coordinator</option>
                                                <option value="Guest">Guest</option>

                                            </select>
                                            </div> 
                                            <div class="col-md-6 form-group">
                                            <label > Date of Birth</label>
								<input type="date" class="form-control"  name="cust_dob" value="<?php echo $res["cust_dob"];?>" >
										
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="" >Gender</label>
                                            <select class="form-control" name="cust_gender"  onChange="getSubCat(this.value);" >
                                            <option value="<?php echo $res["cust_gender"];?>"><?php echo $res["cust_gender"];?></option>
                                            
                                            <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                            </select>
                                            </div>
                                            <div class="col-md-3 mb-10">
                                            <label class="">Disability tatus</label>
                                            <select class="form-control" name="cust_disability_status"  onChange="getSubCat(this.value);" >
                                            <option value="<?php echo $res["cust_disability_status"];?>"><?php echo $res["cust_disability_status"];?></option>
                                            
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
                                    <input type="text" class="form-control"  name="cust_country" placeholder="Enter Country" value="<?php echo $res["cust_country"];?>">
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                            <label class=""> Region </label>
                                    <input type="text" class="form-control"  name="cust_region" placeholder="Enter Region" value="<?php echo $res["cust_region"];?>">
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                            <label class=""> City </label>
                                    <input type="text" class="form-control"  name="cust_city" placeholder="Enter City" value="<?php echo $res["cust_city"];?>">
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label > Sub-City </label>
                                    <input type="text" class="form-control"  name="cust_sub_city" placeholder="Enter Sub-City" value="<?php echo $res["cust_sub_city"];?>" >
                                    
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label >Phone Number :</label>
                                    <input type="tel" name="cust_phone" class="form-control"  placeholder="(format: xxxxxxxxxx)" value="<?php echo $res["cust_phone"];?>" >
                                
                                                </div>
                                                <div class="col-md-4 mb-10">
                                                <label >email</label>
                                    <input type="email" class="form-control"  name="cust_email" placeholder="Enter email" value="<?php echo $res["cust_email"];?>" >
                                    
                                                </div>
                                               
                                                
                                                </div>
                                            </section>
                                        </div>

                                         <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class="">Assign Room</label>
								
                                            <select id='selrooms' class="form-control req" name="rooms"  required>
                                                <option value="<?php echo $res["fk_room"];?>"><?php echo $res["fk_room"];?></option>
                                                
                                                    <?php
                                                        $sql = " SELECT * FROM `room` WHERE `status` IS NULL ";
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
                                                      <input type="hidden" name="cust_id" value="<?php echo $res['cust_id']?>"/>
                                                      <input type="hidden" name="old_room" value="<?php echo $res['fk_room']?>"/>
                                                    <button name="update" class="btn btn-primary">Update </button>
                                                    <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                </div>

                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                             
</div>
