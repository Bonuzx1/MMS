<div class="container-fluid">
  <div class="side-body padding-top">
    <div class="row">
<div class="col-lg-10">
    
<div class="panel panel-primary">
<div class="panel-heading">
    <h4 class="panel-title">Schedule Maintenance</h4>
</div>
<div class="panel-body">
<div class="row">
    <form class="form-vertical" action="" method="post">
            <div class="col-lg-12">
            <div class="form-group">
            <label>Asset</label>
            <select required name="assetname" class="form-control">
                <option value=""></option>
                <option value="1">Asset 1</option>
                <option value="2">Asset 2</option>
            </select>
            </div>
        </div>
        <br><br><br><br>
    <div class="col-lg-12">
            <div class="form-group">
            <label>Frequency</label>
            <select required name="location" class="form-control">
                <option value=""></option>
                <option value="1">Daily</option>
                <option value="2">Weekly</option>
                <option value="3">Monthly</option>

            </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
            <label>Assigned to</label>
            <select required name="staff" class="form-control">
                <option value=""></option>
                <option value="1">staff 1</option>
                <option value="2">staff 2</option>
            </select>
            </div>
        </div>
        <div class="col-lg-12">
                <div class="form-group">
                <label>Maintenance Type</label>
                <select required name="maintenancetype" class="form-control">
                    <option value=""></option>
                    <option value="1">Preventive</option>
                    <option value="2">Damage</option>
                    <option value="3">Corrective</option>
                </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                <label>Priority Type</label>
                <select required name="supplier" class="form-control">
                    <option value=""></option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon" for="startdate">Start Date</span>
                    <input class="form-control" type="date" name="startdate" class="" id="">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon" for="enddate" > End Date &nbsp;</span>
                    <input aria-describedby="basic-addon3" class="form-control" type="date" name="enddate" class="" id="">
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-lg-12">
            <div class="form-group">
                <label for="" class="control-label">Purchase Price</label>
                <input type="number" name="purchaseprice" id="" class="form-control col-md-5" min="0" step="any"  placeholder="0.00">
            </div>
        </div>
        <div class="clearfix"></div>
      <br>
            <div class="col-lg-12" >
            <div class="form-group" >
            <div class="well well-lg" >
            <button class="btn btn-success" type="button" name="save">Save</button> &nbsp;
            <a href="" class="btn btn-info">Cancel</a>
                
            </div>
        </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>