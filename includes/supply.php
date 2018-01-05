<?php if($_GET['supply']==''||($_GET['supply']=="deleted")||($_GET['supply']=="notdeleted")){ ?>
    <div class="container-fluid">
        <div class="side-body padding-top">
            <div class="row">
                <div class="col-lg-10">

                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <div class="panel-title"> supply <?php if ($_GET['supply']=="deleted") {
                                    echo "Deleted Succesfully";
                                } ?></div>
                        </div>

                        <div class="panel-body">
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                <th>supply No</th><th>Name</th><th>Status</th><th>Category</th><th>Location</th><th></th>
                                </thead>
                                <tbody id="table1">
                                <?php
                                $count = $user->howmanyinone('supply');
                                $fetch = $user->populatewith('supply', 'status', '1');
                                if($count>1){
                                    foreach($fetch as $row) {
                                        

                                        ?>
                                        <tr>
                                            <td><?php echo $row['supplyid']?></td><td><?php echo $row['name']; ?></td>
                                            <td><?php echo ($row['status'] == 1) ? "Available" : "Not Available"; ?></td>
                                            <td><a href="index.php?asset=new&id=<?php echo $row['supplyid']?>&from=supply"><button class="btn-primary">Edit</button></a> | <a href="javascript:delset('<?php echo $row['supplyid'];?>','<?php echo $row['name'];?>')"><button class="btn-danger" ">Delete</button></a></td>
                                        </tr>

                                    <?php } } else { ?>
                                    <td>No supply yet</td>
                                <?php } ?>


                                </tbody>
                                <tbody id="table2">

                                </tbody>
                            </table>



                        </div><!--body-->

                        <div class="well well-sm panel-footer">
                            <ul class="list-group">
                                <div class="row">
                                    <div class="col-lg-4">

                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchquery" placeholder="Search for...">
                                            <span class="input-group-btn">
        <button class="btn btn-primary" name="searchbutton" type="button">Search</button>
      </span>
                                        </div><!-- /input-group -->
                                    </div><!--/.col-lg-4-->
                                    <div class="col-lg-4">
                                        <a href="index.php?supply=new">
                                            <button class="btn btn-primary" type="submit">New supply</button>
                                        </a>
                                    </div>

                                </div>
                            </ul>
                        </div><!--well-->

                    </div><!--panel-->

                </div><!--col-10-->
            </div>
        </div>
    </div>
<?php } elseif ($_GET['supply']=='new') {
    include 'newasset.php';
} ?>
<script type="text/javascript">
    function delset(id, title)
    {
        if (confirm("Are you sure you want to delete '" + title + "'"))
        {
            window.location.href = 'index.php?supply=del&id=' + id;
        }
    }
</script>
<?php

if (($_GET["supply"]=='del')&&(isset($_GET['id']))) {
    $stmt = 'UPDATE supply SET status = :value WHERE supplyid = :supplyid' ;
    $param = array(':value' => '0', ':supplyid' => $_GET['id']);
    if ($user->update($stmt, $param)) {
        header('Location: index.php?supply=deleted');
        exit;
    }else{
        header('Location: index.php?supply=notdeleted');
    }

}
?>
<script type="text/javascript">
    $(document).ready(function(){



        function load_data(query)
        {
            $.ajax({
                url:"search.php",
                method:"POST",
                data:{query:query},
                success:function(data)
                {
                    $('#table1').html('');
                    $('#table2').html(data);
                },
                error:function(data) {
                    $('#table1').html('');
                    $('#table2').html("error");
                }
            });
        }

        $('#searchquery').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
                // alert(search);
                load_data(search);
            }
            else
            {
                alert(search);
            }
        });
    });

</script>