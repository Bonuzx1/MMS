<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 04/01/2018
 * Time: 4:52 PM
 */

?>
<div class="container">
    <div class="side-body   padding-top">
    <div class="row">
        <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span>
                <h4 class="panel-title">Calendar</span>

            </div>
            <div class="panel-body">

                <div id="calendar"></div>
            </div>

        </div>
        </div>

    </div>





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
                                    $all = $user->populatewith('staff', 'isdeleted', '0');
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
                            <label for="start" class="col-sm-2 control-label">Start date</label>
                            <div class="col-sm-10">
                                <input type="text" name="start" class="form-control" id="start" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">End date</label>
                            <div class="col-sm-10">
                                <input type="text" name="end" class="form-control" id="end" readonly>
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
                                    $all = $user->populatewith('staff', 'isdeleted', '0');
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
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Monthly</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-2 control-label">Maintenace Type</label>
                            <div class="col-sm-10">
                                <select name="mtype" class="form-control" id="mtypeedit">
                                    <option value="">Choose</option>
                                    <option value="1">Preventive</option>
                                    <option value="2">Corrective</option>
                                    <option value="3">Damage</option>
                                </select>
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
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label class="text-danger">
                                        <input type="checkbox" id="delete" name="delete"> Delete event</label>
                                </div>
                            </div>
                        </div>

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
    </div>









<script type="text/javascript">
    $(document).ready(function () {

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
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
                    $('#ModalEdit #priorityedit').val(event.type);
                    $('#ModalEdit').modal('show');
                    // ended
                });
            },
            eventMouseover: function(calEvent, jsEvent) {
                var tooltip = '<div class="tooltipevent" style="width:100px;height:100px;background:#ccc;position:absolute;z-index:10001;">' + calEvent.title +'<br>'+calEvent.type+ '</div>';
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
                    $('#calendar').fullCalendar('select');
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
            var d;

            if ($("#delete").is('checked'))
            {
                d='1';
            }else {
                d='2';
            }

            Event = [];
            Event[0] = $("#id").val();
            Event[1] = $("#staffedit").val();
            Event[2] = $("#priorityedit").val();
            Event[3] = $("#ftypeedit").val();
            Event[4] = $("#mtypeedit").val();
            Event[5] = d;

            alert(Event);
            $.ajax({
                url: 'process/editSchedule.php',
                type: 'POST',
                data: {Event:Event},
                success: function () {
                    $("#calendar").fullCalendar('refetchEvents');
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
                success: function() {
                    $("#calendar").fullCalendar('refetchEvents');
                }
            });
        }
    });
</script>