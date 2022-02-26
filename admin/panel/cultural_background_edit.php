<?php
require_once('../datatable-json/includes.php');

$langId = isset($_GET['id'])? $_GET['id'] : "";

$info = ORM::for_table($config['db']['pre'].'cultural_backgrounds')->find_one($langId);
//print_r($info);die;
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Cultural Background</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Country Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputfullname" placeholder="Religion Name" name="name" required=""  value="<?php echo $info['name'];?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="repeater form-group">
                                    <label for="exampleInputfulltype">Add Cultural Option<code>*</code></label>
                                        <div data-repeater-list="options" class="option_repeat">
                                                <div data-repeater-item class="input-group">
                                                    <div class="input-group-addon"><i class="ion-person"></i></div>
                                                  
                                                    <input type="text"  class="form-control" name="name" placeholder="Add Cultural Name"/>
                                                    <div class="input-group-addon btn-danger" data-repeater-delete type="button" value="Delete"><i class="fa fa-trash"></i></div>
                                                    <!-- <input data-repeater-delete type="button" value="Delete"/> -->
                                                </div>
                                        </div>
                                        <div class="input-group-addon btn-primary rpt_click" data-repeater-create type="button" value="Add"><i class="fa fa-plus"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfulltype">Language Type<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputreligionname" placeholder="Religion Name" name="type" required=""  value="<?php echo $info['type'];?>">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div> -->
                                    <!-- <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="exampleInputfulltype">Language Type</label>
                                            <select name="type" id="exampleInputreligionname" class="form-control">
                                                <option value="main" <?php if($info['type'] == 'main'){ echo 'selected'; } ?>>main</option>
                                                <option value="others" <?php if($info['type'] == 'others'){ echo 'selected'; } ?>>others</option>
                                            </select>
                                         </div>
                                    </div> -->
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
