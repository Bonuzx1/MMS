              <!-- Main Content -->
              <?php
              $num_rows1 = $user->howmanyin('staff', 'isdeleted','0');
              $num_rows2 = $user->howmanyin('schedule', 'iscanceled','0');
              $num_rows3 = $user->howmanyin('assets', 'isdeleted','0');
              $num_rows4 = $user->howmanyin('request', 'isapproved','1');

          
              ?>
         
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?staff">
                                <div class="card dark blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-user fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $num_rows1;?></div>
                                            <div class="sub-title">Staff</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                       
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card dark blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-comments fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $num_rows4;?></div>
                                            <div class="sub-title">Notifications</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card dark blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-tags fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $num_rows2;?></div>
                                            <div class="sub-title">Work Orders</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <a href="#">
                                <div class="card dark blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-cubes fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $num_rows3;?></div>
                                            <div class="sub-title">Assests</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                     <div class="card card-success">
                                <div class="card-header">
                                    <div class="title">
                                        <p class="text-center">Work Orders Due</p>
                                    </div>
                                    <div class="pull-right card-action">
                                        <div class="btn-group" role="group">
                                            <!-- <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalListExample"><i class="fa fa-code"></i></button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php  
                                    $sql = "SELECT * FROM schedule ORDER BY prioritytype,enddate asc";
                                    $param = array(
                                        ':startdate' => 'startdate'
                                    );
                                    $all = $user->select($sql, $param);
                                    foreach ($all as $row ) { 
                                        $row2 = $user->showone('assets', 'assetid', $row['assetid']);
                                        ?>
                                    <li class="list-group-item"><?php echo $row2['name']?></li>
                                    <?php } ?>
                                     
                                 </div>
                                    </div>
                    </div>
                    <div class="col-lg-6">
                     <div class="card card-success">
                                <div class="card-header">
                                    <div class="title">
                                        <p class="text-center">Work Orders Due</p>
                                    </div>
                                    <div class="pull-right card-action">
                                        <div class="btn-group" role="group">
                                            <!-- <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalListExample"><i class="fa fa-code"></i></button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php  
                                    $sql = "SELECT assetid, scheduleid, cost, prioritytype, enddate, SUM(cost) FROM schedule GROUP BY assetid";
                                    $param = array(
                                        ':startdate' => 'startdate'
                                    );
                                    $all = $user->select($sql, $param);
                                    foreach ($all as $row ) { 
                                        $row2 = $user->showone('assets', 'assetid', $row['assetid']);
                                        $num = $user->howmanyin('schedule', 'assetid', $row['assetid']);
                                        $price = ($row['SUM(cost)']);
                                        $totp = NULL;


                                        
                                        
                                        
                                        ?>
                                    <li class="list-group-item"><label class="control-label">Asset: </label><?php echo ' '.$row2['name'] .' '?><label class="control-label">Purchase Price: </label><?php echo ' GH¢ '.$row2['purchaseprice'].'::::Cost Used: '. $price ?> </li>
                                    <?php } ?>
                                     
                                 </div>
                         <div class="modal fade" id="showstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                             <div class="modal-dialog" role="document" id="me">

                             </div>
                         </div>
                                    </div>
                    </div>
<!--after notification-->
                    <div class="modal fade" id="endmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Too much spent?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="control-label">Place this item on lease</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No! Cancel</button>
                                    <button type="button" class="btn btn-primary">Yes, Proceed to Sales</button>
                                </div>
                            </div>
                        </div>
                    </div>
                                    </div>
                                </div>
