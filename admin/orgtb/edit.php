<div class="col-sm">
       <!-- Modal -->
       <div class="modal fade" id="editOrg<?php echo $res['org_id']?>" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                     
       <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Organization info</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                
                            <form name="update_org" method="post" action="orgtb/update_querry.php">
                                        
                                       <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstName">Type</label>
                                                <input class="form-control"id="org_type" name="org_type" placeholder="Organization Type" value="<?php echo $res['org_type']?>" type="text">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="lastName">Name</label>
                                                <input class="form-control" id="org_name" name="org_name" placeholder="Name" value="<?php echo $res['org_name']?>" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" id="org_email" name="org_email" placeholder="name@example.com" value="<?php echo $res['org_email']?>"type="email">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="firstPhone">Phone</label>
                                                <input type="number" class="form-control" id="org_phone" name="org_phone" placeholder="Enter  Phone" value="<?php echo $res['org_phone']?>" >
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="secondPhone">Alternative Phone</label>
                                                <input type="number" class="form-control" id="org_phone_2" name="org_phone_2" placeholder="Enter Alternative Phone" value="<?php echo $res['org_phone_2']?>">
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-md-5 mb-10">
                                                <label for="firstName">Region</label>
                                                <input class="form-control" id="org_region" name="org_region" placeholder="" value="<?php echo $res['org_region']?>" type="text">
                                            
                                            </div>
                                            <div class="col-md-4 mb-10">
                                                <label for="lastName">City</label>
                                                <input class="form-control" id="org_city" name="org_city" placeholder="" value="<?php echo $res['org_city']?>" type="text">
                                            
                                            </div>
                                            <div class="col-md-3 mb-10">
                                                <label for="lastName">Sub-City</label>
                                                <input class="form-control" id="org_sub_city" name="org_sub_city" placeholder="" value="<?php echo $res['org_sub_city']?>" type="text">
                                           </div>
                                           <div class="col-md-3 mb-10">
                                                <label for="lastName">Woreda</label>
                                                <input class="form-control" id="org_woreda" name="org_woreda" placeholder="" value="<?php echo $res['org_woreda']?>" type="text">
                                           </div>
                                           <div class="col-md-9 mb-10">
                                            <section class="hk-sec-wrapper">
                                                    <h5 class="hk-sec-title">Logo</h5>
                                                    
                                                         <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span>
                                                             <p>Drag and drop a file here or click</p>
                                                             <p class="dropify-error">something wrong appended.</p></div>
                                                             <div class="dropify-loader"></div>
                                                             <div class="dropify-errors-container"><ul></ul></div>
                                                             <input type="file" id="org_logo" name="org_logo" class="dropify">
                                                             <button type="button" class="dropify-clear">Remove</button>
                                                             <div class="dropify-preview"><span class="dropify-render"></span>
                                                             <div class="dropify-infos"><div class="dropify-infos-inner">
                                                                 <p class="dropify-filename"><span class="file-icon"></span> 
                                                                 <span class="dropify-filename-inner"></span></p>
                                                            <p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                                                   
                                                </section>
                                        </div>
                                        </div>
                                        
                                 
                                          
                                                </div>
                                                <div class="modal-footer">
                                                      <hr>
                                                      <input type="hidden" name="org_id" value="<?php echo $res['org_id']?>"/>
                                                    <button name="update" class="btn btn-primary">Update </button>
                                                    <button  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    
                                                </div>

                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                             
</div>