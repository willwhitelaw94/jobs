<?php
require_once('../datatable-json/includes.php');

$prId = isset($_GET['id'])? $_GET['id'] : "";

$info = ORM::for_table($config['db']['pre'].'preferences')->find_one($prId);
$c_option = ORM::for_table($config['db']['pre'].'preference_options')->table_alias('pr_opt')
->select_many('pr_opt.id','pr_opt.name')
->left_outer_join($config['db']['pre'].'preferences','pr_opt.preference_id=p_back.id','p_back')
->where('p_back.id',$prId)
->find_array();
//echo ORM::get_last_query();die;
//print_r($c_option);die;
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit About Me</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="religion_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>

<style>
    
    .option_repeat .input-group {    margin-bottom: 15px;}

    .rpt_click{    width: 60%;
    border-radius: 3px !important;
    cursor: pointer;}

    .option_repeat .input-group .btn-danger{cursor: pointer;}

</style>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editPreference" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputfullname" placeholder="Name" name="name" required=""  value="<?php echo $info['question'];?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="repeater form-group">
                                    <label for="exampleInputfulltype">Add Option<code>*</code></label>
                                        <div data-repeater-list="options" class="option_repeat">
                                               <?php
                                               if(empty($c_option)){?>
                                                   <div data-repeater-item class="input-group">
                                                         <div class="input-group-addon"><i class="ion-person"></i></div>
                                                       
                                                         <input type="text"  class="form-control" name="name" placeholder="Option" value="<?php echo $val['name']?>"/>
                                                         <div class="input-group-addon btn-danger" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></div>
                                                        
                                                    </div> 
                                               <?php
                                               }
                                               else{
                                                foreach($c_option as $k=>$val){?>
                                                    <div data-repeater-item class="input-group">
                                                         <div class="input-group-addon"><i class="ion-person"></i></div>
                                                       
                                                         <input type="text"  class="form-control" name="name" placeholder="Option" value="<?php echo $val['name']?>"/>
                                                         <div class="input-group-addon btn-danger" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></div>
                                                        
                                                     </div> 
                                                    <?php 
                                                     }
                                                    
                                               }  ?>     
                                        </div>
                                        <div class="input-group-addon btn-primary rpt_click" data-repeater-create type="button" value="Add"><i class="fa fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <input type="hidden" name="submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('.repeater').repeater({
        isFirstItemUndeletable: true
});

});
</script>

