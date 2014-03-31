<script src="<?php echo URL::asset('assets/js/angular/angular.js')?>"></script>
<script src="<?php echo URL::asset('assets/js/angular/angular-animate.js')?>"></script>
<script src="<?php echo URL::asset('assets/js/angular/app.js')?>"></script>
<script src="<?php echo URL::asset('assets/js/angular/animations.js')?>"></script>
<script src="<?php echo URL::asset('assets/js/angular/controller.js')?>"></script>
<link href="<?php echo URL::asset('assets/js/angular/animations.css') ?>" rel="stylesheet">


<div ng-app="AccountListApp" ng-controller="AccountListCtrl">
  <div class="row">
    <div class="form-group input-group">
        <table>
          <tr>
              <td>Search:&nbsp;</td>
              <td>
                <input type="text" ng-model="query" class="form-control" autofocus placeholder="Username">
              </td>
              <td>&nbsp;Filter:&nbsp;</td>
              <td>
                <select class="form-control" ng-model="query2">
                  <option value="">All</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Professor">Class Adviser</option>
                  <option value="Student">Student</option>
                </select>
              </td>
              <td>
                &nbsp;<div id="spinner" class="fa fa-spinner fa-spin fa-2x"></div>
              </td>
          </tr>
        </table>
    </div>
  </div>

  <div class="row">
    <div class="table-responsive">
  	<table class="table table-hover table-striped tablesorter" id="user_table" class="user_table"  ng-app="AccountListApp" ng-controller="AccountListCtrl">
  		<thead>
  			<tr>
  				<th>ID <i class="fa fa-sort"></i></th>
  				<th>Username <i class="fa fa-sort"></i></th>
  				<th>Account Type <i class="fa fa-sort"></i></th>
  				<th>Last Login <i class="fa fa-sort"></i></th>
  				<th><center>Action <i class="fa fa-sort"></i></center></th>
  			</tr>
  		</thead>
        <tbody>
            <tr ng-repeat="user in users | filter:query | filter:query2" class="user-listing">
      				<td><center><b>{{ user.id }}</b></center> </td>
      				<td> <center>{{ user.username }}</center> </td>
      				<td> <center>{{ user.type }}</center> </td>
      				<td> <center>{{ user.last_login }}</center> </td>
      				<td>
                <center>
                  <!-- <a class="btn btn-info btn-sm" href="{{ user.id }}"> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp; -->
                  <a class="btn btn-info btn-sm" href='<?php echo route('admin.show', "") ?>/{{ user.id }}'> <i class="fa fa-eye"></i> View </a>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-warning btn-sm" href="<?php echo route('admin.show', "") ?>/{{ user.id }}/edit"> <i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-danger btn-sm" href="<?php echo route('admin.show', "") ?>/{{ user.id }}/delete"> <i class="fa fa-trash-o"></i> Delete </a>
                </center>
              </td>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>