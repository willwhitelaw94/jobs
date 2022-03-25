<?php
require_once('../datatable-json/includes.php');

$jobRequirements = ORM::for_table($config['db']['pre'].'requirements')->find_array();
$userRequirements = ORM::for_table($config['db']['pre'].'user')->find_array();
// echo "<pre>";
// var_dump($userRequirements);die;

?>
<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Documents</h2>
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
        <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addDocuments" id="sidePanel_form">
            <div class="form-body">
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputfulltype">Select User<code>*</code></label>
                            <select class="select2-user form-control" name="user_type">   
                                <option></option>
                                <?php 
                                    if(!empty($userRequirements)) {
                                        foreach($userRequirements as $userreq) {
                                            ?>
                                                <option value="<?php echo $userreq['id'] ?>"><?php echo $userreq['name']; ?></option>
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
                                                <option value="<?php echo $req['id'] ?>"><?php echo $req['name']; ?></option>
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
                            <input class="form-control input-sm" type="date" name="expiry_date" placeholder="Expiry Date" />
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
                            <input type="text" class="form-control" id="registration_number" placeholder="Enter Registration Number" name="registration_number" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Write Description"></textarea>
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

