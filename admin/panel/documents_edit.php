<?php
require_once('../datatable-json/includes.php');
$reqId = isset($_GET['id'])? $_GET['id'] : "";
//print_r($abId);die;
$jobRequirements = ORM::for_table($config['db']['pre'].'requirements')->find_array();
$userRequirements = ORM::for_table($config['db']['pre'].'user')->find_array();
$info = ORM::for_table($config['db']['pre'].'user_documents')->find_one($reqId);
// echo "<pre>";
// var_dump($info);die;

?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Edit Documents</h2>
        </div>
        <div class="slidePanel-actions">
            <div class="btn-group-flat">
                <button type="button" class="btn btn-floating btn-warning btn-sm waves-effect waves-float waves-light margin-right-10" id="post_sidePanel_data"><i class="icon ion-android-done" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-pure btn-inverse slidePanel-close icon ion-android-close font-size-20" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</header>
<div class="slidePanel-inner">
    <div class="panel-body">
        <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="editDocuments" id="sidePanel_form">
            <div class="form-body">
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputfulltype">Select User<code>*</code></label>
                            <select class="select2-user form-control" name="user_type">   
                                <option></option>
                                <?php 
                                    if(!empty($userRequirements)) {
                                        foreach($userRequirements as $userreq) {
                                            ?>
                                                <option value="<?php echo $userreq['id'] ?>" <?php if($info['user_id'] == $userreq['id']) { echo 'selected'; } ?>> <?php echo $userreq['name']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>                              
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputfulltype">Select Documents<code>*</code></label>
                            <select class="select2-icon form-control" name="document_type">   
                                <option></option>
                                <?php 
                                    if(!empty($jobRequirements)) {
                                        foreach($jobRequirements as $req) {
                                            ?>
                                                <option value="<?php echo $req['id'] ?>" <?php if($info['requirement_id'] == $req['id']){ echo 'selected';} ?>><?php echo $req['name']; ?></option>
                                            <?php
                                        }
                                    }
                                ?>                              
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Expiry Date<code>*</code></label>
                            <input class="form-control input-sm" type="date" name="expiry_date" placeholder="Expiry Date" value="<?php echo $info['expiry_date']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Upload Documents<code>*</code></label>
                            <input class="form-control input-sm" type="file" id="file" name="file"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="registration_number">Registration Number</label>
                            <input type="text" class="form-control" id="registration_number" placeholder="Enter Registration Number" name="registration_number" value="<?php echo $info['registration_number'] ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Write Description"><?php echo $info['details'] ?></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="submit">
            </div>

        </form>
    </div>
</div>
<script>

    // reference: https://jsfiddle.net/qCn6p/208/

function formatText (icon) {
    return $('<span>'+ icon.text + '</span>');
};

$('.select2-icon').select2({
    placeholder: "Select Documents",
});
  
$('.select2-user').select2({
    placeholder: "Select User",
});   
</script>

