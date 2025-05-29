<div class="col-sm">
       <!-- Modal -->
       <div class="modal fade" id="editev<?php echo $res['ev_id']?>" tabindex="-1" role="dialog" aria-labelledby="editRoom" style="display: none;" aria-hidden="true">
                                     
       <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Training info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                             <form name="update_ev" method="post" action="trainingstb/update_querry.php">
                                    <div class="row">
                                            <div class="col-md-6 form-group">
                                                
                                            <label >Customer</label>
                                            <?php
                                                $ev_org= $res['fk_organization'];
                                                        $sql_res = "SELECT * FROM `organization` WHERE org_id=$ev_org";
                                                        $all_org_res = mysqli_query($conn,$sql_res);
                                                        while ($org_res = mysqli_fetch_array($all_org_res,MYSQLI_ASSOC)):; 
                                                        
                                                    ?>
                                                    <select class="form-control" name="fk_organization"  onChange="getSubCat(this.value);" >
                                                <option value="<?php echo $org_res["org_id"]?>"><?php echo $org_res["org_name"]?></option>

                                                    <?php endwhile; ?>
                                            
                                                    <?php
                                                        $sql = "SELECT * FROM `organization`";
                                                        $all_org = mysqli_query($conn,$sql);
                                                        while ($org = mysqli_fetch_array($all_org,MYSQLI_ASSOC)):; 
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
                                                        // While loop must be terminated
                                                    ?>
                                                </select>
                                        </div>
                                            <div class="col-md-6 form-group">
                                            <label > Subject/Tittle</label>
													<input type="text" class="form-control" name="ev_tittle_subject" placeholder="Enter Subject/Tittle" value="<?php echo $res['ev_tittle_subject']?>">
													 
                                            </div>
                                        </div>
                                        <div class="row">
                                        <section class="hk-sec-wrapper">
                                            <h5 class="hk-sec-title">Request</h5>
                                            
                                            <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label class="required"> Date</label>
													<input type="date" class="form-control" name="ev_request_date" placeholder="e.g yyyy-mm-dd" value="<?php echo $res['ev_request_date']?>">

                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label class="required">Letter</label>
													<input type="file" class="form-control"  name="pdf_file"  accept="application/pdf" value="<?php echo $res['ev_request_letter']?>" >
												
                                            </div>
                                        </div>
                                            
                                            </section>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label >Start Date </label>
													<input type="date" class="form-control"  name="ev_start_date" placeholder="Enter Phone" value="<?php echo $res['ev_start_date']?>" >
												
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label >End Date</label> 
													<input type="date" class="form-control"  name="ev_end_date" placeholder="Enter Phone" value="<?php echo $res['ev_end_date']?>" >
													
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-md-5 mb-10">
                                            <label >Trainee Level</label>
															<select class="form-control" name="ev_level"  onChange="getSubCat(this.value);" >
															<option value="<?php echo $res['ev_level']?>"><?php echo $res['ev_level']?></option>

															<option value="Senior">Senior</option>
																<option value="Top">Top</option>
																<option value="Mid-level">Mid-level</option>
																<option value="Emerging leaders ">Emerging leaders </option>
															</select> 
                                            </div>
                                            
                                        </div>
                                        
                                       
                                        <section class="hk-sec-wrapper">
                                        <h5 class="hk-sec-title">Objective of The Training</h5>
                                           <textarea class="summernote" name="ev_objective" style="width: 100%;height: 150px" ><?php echo $res['ev_objective']?></textarea>
										 </section>
                                        
                                         <div class="row">
                                            <div class="col-md-6 form-group">
                                            <label >Mode of Delivery</label>
															<select class="form-control" name="ev_mode_of_delivery" onChange="getSubCat(this.value);" >
															<option value="<?php echo $res['ev_mode_of_delivery']?>"><?php echo $res['ev_mode_of_delivery']?> </option>

															<option value="Online ">Online </option>
																<option value="In Class room ">In Class room </option>
																<option value="In halls ">In halls </option>
																<option value="On job training ">On job training </option>
																<option value="Outside/field visit ">Outside/field visit </option>

															</select> 	
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label  >Medium of Communication</label>
													<input type="text" class="form-control"  name="ev_language" placeholder="Enter Language" value="<?php echo $res['ev_language']?>" >
															
                                            </div>
                                            <div class="col-md-6 form-group">
                                            <label >Key note Speaker</label>
													<input type="text" class="form-control" name="ev_key_note" placeholder="Enter Key note Speaker" value="<?php echo $res['ev_key_note']?>" >
																	
                                            </div>
                                        </div>

                                                <div class="modal-footer">
                                                      <hr>
                                                      <input type="hidden" name="ev_id" value="<?php echo $res['ev_id']?>"/>
                                                    <button name="update" class="btn btn-primary">Update </button>
                                                    <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                </div>

                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                             
</div>