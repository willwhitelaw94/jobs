<?php
require_once('../datatable-json/includes.php');

$langId = isset($_GET['id'])? $_GET['id'] : "";

$info = ORM::for_table($config['db']['pre'].'language')->find_one($langId);
//print_r($info);die;
?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Language</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="religion_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div id="post_error"></div>
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editUserLanguage" id="sidePanel_form">
                        <div class="form-body">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Language Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputfullname" placeholder="Name" name="name" required=""  value="<?php echo $info['name'];?>">
                                            <span class="help-block"></span>
                                        </div>
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
                                    <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="exampleInputfulltype">Language Type</label>
                                            <select name="type" id="exampleInputreligionname" class="form-control">
                                                <option value="main" <?php if($info['type'] == 'main'){ echo 'selected'; } ?>>main</option>
                                                <option value="others" <?php if($info['type'] == 'others'){ echo 'selected'; } ?>>others</option>
                                            </select>
                                         </div>
                                    </div>
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

