<?php 
?>
                        <div class="row"  align="right">
                                               <div class="col-sm">
                                               <div class="btn-group btn-group-sm mb-15" role="group">
                                                   <button type="button" class="btn btn-success btn-rounded" data-toggle="modal" data-target="#addmsg" ><span>&#43;</span> New Message</button>
                                                   </div>
                                               </div>
                                           </div>
                                <!-- Modal -->
                                <div class="modal fade" id="addmsg" tabindex="-1" role="dialog" aria-labelledby="addmsg" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Message</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                               
                                                                    <div class="col-8" >
                                                                    <form name="addmsg" method="post" action="roomtb/msg_querry.php" enctype="multipart/form-data" >
                                                                    <div class="row">
                                                                    <div class="form-group col-md-6 ">
                                                                        <label> Name</label>
                                                                        <input type="text" class="form-control" placeholder=" Name" name="msg_er_name" required="">
                                                                        <div class="help-block with-errors"></div>
                                                                    </div>
                                                                    

                                                                    <div class="form-group col-lg-12 has-error has-danger">
                                                                        <label>Message Description</label>
                                                                        <textarea class="form-control mt-15" name="msg_detail"rows="10" placeholder="Message" required=""></textarea>
                                                                       
                                                                    </div>

                                                                </div>
                                                                                                                    <hr>
                                                                                <br>
                                                                                <button type="submit" name="createmsg" class="btn btn-success waves-effect waves-light">Add</button>
                                                                                <button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>
                                                                                <br>
                                                                            </form>
                                                                </div>
                                                            
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
    <br><br><br>
                              <!-- Row -->
                              <div class="row">
                            
                            <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                
                                    <div class="col-sm">
                                        <div class="table-wrap">
                                   <div id="datable_5_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="lookup" class="table table-hover w-100 display dataTable no-footer dtr-inline collapsed" role="grid" style="width: 100%;">
                            
                                                    <thead class="table-dark">
                                                    <tr role="row">	
							  
                                                            <th >Name</th>
                                                            <th >Message Description</th>	
                                                            <th >Created Date</th>
                                                            <th >Status</th>							  
                                                            <th >Delivered Date</th>
                                                            <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                </div>
                                        </div>
                                    </div>
                            </section>
                                </div>
                            </div>
                            <!-- /Row -->