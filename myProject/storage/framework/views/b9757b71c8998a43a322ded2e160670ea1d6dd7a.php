<!-- Edit Modal HTML -->
<div id="addCandidateModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body"> 
        <form method="post" action="<?php echo e(route('candidates.store')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>  
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" required>
          </div>
          <div class="form-group">
            <label>Sex</label>
            <br/>
            <label class="radio-inline">
              <input type="radio" name="sex" value=1 checked>Male
            </label>
            <label class="radio-inline">
              <input type="radio" name="sex" value=2>Female
            </label>
            <label class="radio-inline">
              <input type="radio" name="sex" value=3>Other
            </label>
          </div>
          <div class="form-group">
            <label>Avatar</label>
            <input id="avatar" type="file" class="form-control" name="image">
          </div>
          <div class="form-group">
            <label>Birthday</label>
            <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd"> 
              <input class="form-control" type="text" name="birthday" required> 
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label>Graduated year</label>
            <div id="yearpicker" class="input-group date" data-date-format="yyyy"> 
              <input class="form-control" type="text" name="graduated_year" required> 
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-menu-down"></i>
              </span>
            </div>
          </div>     
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-success" value="Add" onclick=test()>
        </form> 
      </div>
    </div>
  </div>
</div>
 <script type="text/javascript">
   $(function () {  
      $("#datepicker").datepicker({         
      autoclose: true,         
      todayHighlight: true 
      }).datepicker('update', new Date());
      $("#yearpicker").datepicker({         
        format: " yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
      });
  });
  function test(){
    console.log('click');
  }
</script><?php /**PATH /var/www/resources/views/candidates/add_modal.blade.php ENDPATH**/ ?>