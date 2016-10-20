    
<?php
    $h_u_m_defaultIcon = "https://s.gravatar.com/avatar/23463b99b62a72f26ed677cc556c44e8?s=128";
    $iMS = 'style="color: #3e50b4;"';
?>

<?php $__env->startSection('content'); ?>
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                <div class="checkboxer checkboxer-<?php echo e($PAGE['Header']['Color']); ?>">
                    <input type="checkbox" value="" checked id="page_realtime_search">
                    <label for="page_realtime_search">Realtime searching</label>
                </div>
                
                <small>Press enter to search if realtime is turned off. Press search to refresh with search results (URL BAR)</small>
            </div>
            
            <div class="panel-inputs inputer-<?php echo e($PAGE['Header']['Color']); ?>" style="width: 95%;margin-right: 10px">
                
                <div class="input-group">
                    <input 
                        id="page_query_input" 
                        type="text" 
                        class="form-control input-circle-left"
                        placeholder="Query..."
                        value="<?php echo e(isset($query) ? $query : ''); ?>">
                    
                    <span class="input-group-btn">
                        <button style="padding: 0px 10px 0px 10px;" 
                                type="button" 
                                id="page_query_go"
                                class="btn btn-flat btn-<?php echo e($PAGE['Header']['Color']); ?> btn-ripple">Search</button>
                    </span>
                    
                </div>
            </div>
        </div>
        <div class="panel-body without-padding">
            <ul class="list-material has-hidden" id="user_body">
                <?php echo $__env->make('areas.admin.users.userlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
        </div>
    </div>


    <div class="modal scale fade" id="page_edituser_areyousure" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    You are about to edit the user "<span id="page_edituser_name"></span>" with the id <span id="page_edituser_id"></span>. <br>
                    This will redirect you!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default btn-ripple" data-dismiss="modal">Close<span class="ripple _7 animate" style="height: 80px; width: 80px; top: -16.736px; left: 2.04688px;"></span><span class="ripple _10 animate" style="height: 80px; width: 80px; top: -17.736px; left: 0.046875px;"></span></button>
                    <button type="button" class="btn btn-flat btn-primary btn-ripple" id="page_edit_mobile_accept">Edit User</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script src="/js/pages/admin/users/home.js"></script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>