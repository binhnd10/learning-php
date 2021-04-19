<?php $__env->startSection('main'); ?>
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">candidates</h1> 
        <?php echo $__env->make('candidates.add_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('candidates.edit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Button trigger modal -->
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCandidateModal">Add candidate</button>   
        <table class="table table-striped candidate-list-table" id="candidate-list-table">
            <thead>
                <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Sex</td>
                <td>Birthday</td>
                <td>Avartar</td>
                <td>Graduated year</td>
                <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="row<?php echo e($candidate->id); ?>">
                    <td><?php echo e($candidate->id); ?></td>
                    <td><?php echo e($candidate->name); ?></td>
                    <?php if($candidate->sex == 1): ?>
                        <td>Male</td>
                    <?php elseif($candidate->sex == 2): ?>
                        <td>Female</td>
                    <?php else: ?>
                        <td>Other</td>
                    <?php endif; ?>
                    <td><?php echo e($candidate->birthday); ?></td>
                    <td class='candidate-avatar'><img src="<?php echo e(URL::to('/')); ?>/images/<?php echo e($candidate->image_url); ?>" class="img-fluid img-thumbnail" alt="Candidate"></td>
                    <td><?php echo e($candidate->graduated_year); ?></td>
                    <td>
                        <a href="<?php echo e(route('candidates.edit',$candidate->id)); ?>" class="btn btn-primary">Edit</a>
                        
                    </td>
                    <td>
                        <button class="btn btn-danger delete-candidate-btn" onclick=deleteCandidate(<?php echo e($candidate->id); ?>) type="submit">Delete</button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <div>
</div>
<script type="text/javascript">
    window.onload = function() {
        if (window.jQuery) {  
            // jQuery is loaded  
            
            window.jQuery = window.$ = jQuery;
        } else {
            // jQuery is not loaded
            alert("Doesn't Work");
        }
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    function deleteCandidate(id){
        $.ajax({
              type: "DELETE",
              url: "<?php echo e(url('candidates')); ?>"+'/'+id,
              success: function (data) {
                $("#row" + id).remove()
              },
              error: function (data,response) {
                  alert(response)
                  console.log('Error:', data);
              }
          });
      }
    
    var loadFile = function(event) {
        console.log('loadFile');
        var image = document.getElementById('edit-avatar');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/candidates/index.blade.php ENDPATH**/ ?>