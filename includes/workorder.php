<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 04/01/2018
 * Time: 4:52 PM
 */

?>
    <div class="side-body   padding-top">
        <div class="col-sm-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span>
                    <h4 class="panel-title">Add/Edit Maintenance Schedule</h4></span>

            </div>
            <div class="panel-body">

                <div id="calendar"></div>
            </div>
        </div>
        </div>
            <div class="col-sm-3">

                <div class="panel panel-primary" style="background-color:white">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="background-color: #0075b0">
                        <div class="panel-title" style="color: white"> Schedules(tabular form) </div>
                    </div>



                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="index.php?order-tbl">
                                    <button class="btn btn-primary" type="button" style="padding: 20px 30px;">View</button>
                                </a>
                            </div>

                        </div>
                    </div><!--well-->

                </div><!--panel-->

            </div><!--col-10-->


    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="process/addSchedule.php">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Assign name</label>
                            <div class="col-sm-10">
                                <select name="staff" class="form-control" id="staff">
                                    <option value="">Choose</option>
                                    <?php
                                    $all = $user->populatewith('staff', 'active', '1');
                                    foreach ($all as $item) { ?>
                                        <option value="<?php echo $item['staffid']?>"><?php echo $item['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Asset</label>
                            <div class="col-sm-10">
                                <select name="assetname" class="form-control" id="color">
                                    <option value="">Choose</option>
                                    <?php
                                    $all = $user->populatewith('assets', 'isdeleted', '0');
                                    foreach ($all as $item) { ?>
                                        <option value="<?php echo $item['assetid']?>"><?php echo $item['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Priority</label>
                            <div class="col-sm-10">
                                <select name="priority" class="form-control" id="priority">
                                    <option value="">Choose</option>
                                    <option style="color:#FF0000;" value="1">High</option>
                                    <option style="color:#FFD700;" value="2">Medium</option>
                                    <option style="color:#008000;" value="3">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Schedule Frequency</label>
                            <div class="col-sm-10">
                                <select name="ftype" class="form-control" id="color">
                                    <option value="">Choose</option>
                                    <option value="0">Once</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenace Type</label>
                            <div class="col-sm-10">
                                <select name="mtype" class="form-control" id="color">
                                    <option value="">Choose</option>
                                    <option value="1">Preventive</option>
                                    <option value="2">Corrective</option>
                                    <option value="3">Damage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenance Cost</label>
                            <div class="col-sm-10">
                                <input type="number" name="cost" id="cost"  class="form-control" min="0" step="any"  placeholder="0.00">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Start date</label>
                            <div class="col-sm-10">
                                <input type="text" name="start" class="form-control" id="start" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">End date</label>
                            <div class="col-sm-3">
                                <input type="text" name="end" class="form-control" id="end" readonly>
                            </div>
                            <label for="end" class="col-sm-3 control-label">Custom End </label>
                            <div class="col-sm-4">
                                <input type="date" name="customend" class="form-control" id="customend">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- thats all for adding -->




    <!-- Modal -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Assigned Staff</label>
                            <div class="col-sm-10">
                                <select name="staff" class="form-control" id="staffedit" >
                                    <?php
                                    $all = $user->populatewith('staff', 'active', '1');
                                    foreach ($all as $item) { ?>
                                        <option value="<?php echo $item['staffid']?>"><?php echo $item['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Asset</label>
                            <div class="col-sm-10">
                                <select name="assetid" class="form-control" id="titleedit" disabled>
                                    <?php
                                    $all = $user->populatewith('assets', 'isdeleted', '0');
                                    foreach ($all as $item) { ?>
                                        <option value="<?php echo $item['assetid']?>"><?php echo $item['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Priority</label>
                            <div class="col-sm-10">
                                <select name="priority" class="form-control" id="priorityedit">
                                    <option value="">Choose</option>
                                    <option style="color:#FF0000;" value="1">High</option>
                                    <option style="color:#FFD700;" value="2">Medium</option>
                                    <option style="color:#008000;" value="3">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Schedule Frequency</label>
                            <div class="col-sm-10">
                                <select name="ftype" class="form-control" id="ftypeedit">
                                    <option value="">Choose</option>
                                    <option value="0">Once</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenance Type</label>
                            <div class="col-sm-10">
                                <select name="mtype" class="form-control" id="mtypeedit">
                                    <option value="">Choose</option>
                                    <option value="1">Preventive</option>
                                    <option value="2">Corrective</option>
                                    <option value="3">Damage</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenance Cost</label>
                            <div class="col-sm-10">
                                <input type="number" name="cost" id="costdit"  class="form-control" min="0" step="any"  placeholder="0.00">
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="start" class="col-sm-2 control-label">Start date</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="start" class="form-control" id="start" readonly>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="end" class="col-sm-2 control-label">End date</label>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input type="text" name="end" class="form-control" id="end">-->
<!--                            </div>-->
<!--                        </div>-->

                        <input type="hidden" name="id" class="form-control" id="id">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="editbtn" id="edit-event" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- thats all for editing -->

    </div>

<script type="text/javascript">
    $(document).ready(function () {
        var g = false;
        g = '<?php echo($_GET['order']!='') ? true : false ; ?>';
        if (g==1) {
            openEdit();
        }
        $("#customend").change(function () {
            $("#end").val("");
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'month',
                center: 'title',
                right: 'prev,next,today',
            },
            events: 'process/showevents.php',
            selectable: true,
            selectHelper: true,
            allDayDefault: true,
            eventRender: function(event, element) {
                //if(event.start.get('month') < moment()) { return false; }


                element.bind('dblclick', function() {
                    $('#ModalEdit #staffedit').val(event.staffid);
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #titleedit').val(event.titleid);
                    $('#ModalEdit #mtypeedit').val(event.maintenance);
                    $('#ModalEdit #ftypeedit').val(event.frequency);
                    $('#ModalEdit #costdit').val(event.cost);
                    $('#ModalEdit #priorityedit').val(event.type);
                    $('#ModalEdit').modal('show');
                    // ended
                });
                element.on('contextmenu', function () {
                    if(confirm('do you want delete?')){
                        del(event.id);
                    }
                })
            },
            eventMouseover: function(calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:200px;height:100px;background:#ccc;position:absolute;z-index:10001;"> <b>Asset Name:</b> ' + calEvent.title +'<br><b>Assigned to: </b>'+calEvent.staff+'<br><b>Cost: </b>GHC '+calEvent.cost+'<br>'+ +'</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltipevent').remove();
            },
            select: function (start, end, allday) {
                if(start < moment()) {
                    return false;
                }
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventDrop: function(event, delta, revertFunc) {
                if(event.start <= moment()) {
                    revertFunc();
                }else {
                    edit(event);
                }

            },
            eventResize: function(event, delta, revertFunc) {

                edit(event);

            },
        });
        $("#edit-event").click(function () {

            Event = [];
            Event[0] = $("#id").val();
            Event[1] = $("#staffedit").val();
            Event[2] = $("#priorityedit").val();
            Event[3] = $("#ftypeedit").val();
            Event[4] = $("#mtypeedit").val();
            Event[6] = $("#costdit").val();

            alert("Saved Successfully");
            $.ajax({
                url: 'process/editSchedule.php',
                type: 'POST',
                data: {Event:Event},
                success: function (data) {
                        // alert('saved sucessfully');
                        window.location.href = "?order";
                }
            });
        });
        function edit(event){
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end){
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }else{
                end = start;
            }

            id =  event.id;

            vent = [];
            vent[0] = id;
            vent[1] = start;
            vent[2] = end;

            $.ajax({
                url: 'process/editSchedule.php',
                type: "POST",
                data: {vent:vent},
                success: function(data) {
                    
                        alert('Saved Sucessfully');
                        $("#calendar").fullCalendar('refetchEvents');
                    
                }
            });
        }
        function del(value) {
            Event = [];
            Event[0] = value;
            $.ajax({
                url: 'process/deleteSchedule.php',
                type: 'POST',
                data: {Event:Event},
                success: function (data) {

                        alert('Deleted Suceesfully');
                        $("#calendar").fullCalendar('refetchEvents');

                },
                error: function (data) {
                    alert("Error "+data);
                }
            });
        }

        
    });
</script>

<?php
if ($_GET['order']!=''){
$schedule = $user->showone('schedule', 'scheduleid', $_GET['order']);
$id = $schedule['scheduleid'];
$staff = $schedule['staffid'];
$asset = $schedule['assetid'];
$freq = $schedule['frequencytype'];
$maintain = $schedule['maintenancetype'];
$cost = $schedule['cost'];
$priority = $schedule['prioritytype'];

?>
<script type="text/javascript">
    function openEdit() {
        $('#ModalEdit #staffedit').val(<?=$staff?>);
        $('#ModalEdit #id').val(<?=$id?>);
        $('#ModalEdit #titleedit').val(<?=$asset?>);
        $('#ModalEdit #mtypeedit').val(<?=$maintain?>);
        $('#ModalEdit #ftypeedit').val(<?=$freq?>);
        $('#ModalEdit #costdit').val(<?=$cost?>);
        $('#ModalEdit #priorityedit').val(<?=$priority?>);
        $('#ModalEdit').modal('show');
    }
    $(document).ready(function() {
        
    })
</script>
<?php }?>