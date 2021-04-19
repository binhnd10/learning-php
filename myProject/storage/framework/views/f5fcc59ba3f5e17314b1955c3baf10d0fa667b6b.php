<!-- Edit Modal HTML -->
<div id="editCandidateModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body"> 
            
          <form method="post" action="" id="edit-form" enctype="multipart/form-data">
            <?php echo method_field('PATCH'); ?>
            <?php echo csrf_field(); ?>  
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
              <label>Sex</label>
              <br/>
              <label class="radio-inline">
                <input type="radio" name="sex" id="sex-1" value=1 checked>Male
              </label>
              <label class="radio-inline">
                <input type="radio" name="sex" id="sex-2" value=2>Female
              </label>
              <label class="radio-inline">
                <input type="radio" name="sex" id="sex-3" value=3>Other
              </label>
            </div>
            <div class="form-group">
              <label>Avatar</label>
              <p><img id="edit-avatar" class="candidate-avatar"/></p>
              <input type="text" hidden name="image-name">
              <input id="edit-avatar" type="file" class="form-control" name="image" onchange="loadFile(event)">
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
            <input type="submit" class="btn btn-success" value="Edit">
          </form> 
        </div>
      </div>
    </div>
  </div><?php /**PATH /var/www/resources/views/candidates/edit_modal.blade.php ENDPATH**/ ?>