<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <button class="btn btn-info" id="set">Set Notificatons</button>
            <button class="btn btn-info" id="show">show notification</button>
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
        
</body>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var frmdb = null;
        $("#set").click(function() {
            if (!window.Notification) {
                alert("Not Supported");
            }else{
                Notification.requestPermission(function(e) {
                    if (e==='denied') {
                        alert("you denied the request. Goto your notification settings in the browser to enable it!");                        
                    }else{
                        
                    }
                })
            }
        });
        $("#show").click(function() {
            $.get("process/getnotification.php", function(data) {
                frmdb = JSON.parse(data);
                var newfrmdb;
                for (let index = 0; index < frmdb.length; index++) {
                    newfrmdb = frmdb[index];
                    var notify;
                    notify = new Notification(newfrmdb.name, {
                        'body':newfrmdb.description,
                        'data':newfrmdb.anything
                        
                    });
                    console.log(notify);
                    notify.onclick = function() {
                        $("#endmodal").modal('show');
                    }
                }
                
            })
        })
    });
</script>
</html>