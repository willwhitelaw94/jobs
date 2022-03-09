<?php
require_once('includes.php');
$main_languages=ORM::for_table($config['db']['pre'] . 'language')->where('type','main')->find_array();
$religions = ORM::for_table($config['db']['pre'] .'religions')->select_many('id','name')->find_array();

$backgrounds = ORM::for_table($config['db']['pre'] .'cultural_backgrounds')->table_alias('c_back')
    ->select_many('c_back.id','c_back.name',array('bck_opt_id'=>'bck_opt.id','bck_opt_name'=>'bck_opt.name'))
    ->select_expr('(SELECT COUNT(cultural_background_id) FROM '.$config['db']['pre'].'cultural_background_options WHERE cultural_background_id=c_back.id)','total_options')
    ->left_outer_join($config['db']['pre'] . 'cultural_background_options','c_back.id=bck_opt.cultural_background_id','bck_opt')
    ->order_by_asc('c_back.id')
    ->find_array();
    // print_r($backgrounds);

$user_id= $_SESSION['user']['id'];
$user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_array();
$city_codes=array_column($user_city,'city_code');

$user_pr_days=ORM::for_table($config['db']['pre'] . 'user_prefered_days')
->select_many('id','user_id','day')
->select_many_expr(["start_time"=>"TIME_FORMAT(start_time,'%h:%i %p')"],["end_time"=>"TIME_FORMAT(end_time, '%h:%i %p')"])
->where('user_id',$user_id)->find_array();
$user_days=[];
foreach($user_pr_days as $val){
    $user_days[$val['day']]=['start_time'=>$val['start_time'],'end_time'=>$val['end_time']];
}

$user_pr_days_code=array_keys($user_days);

?>

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card">
            <div class="card-header">
                <h4>User-Profile setting</h4>
            </div>
            <div class="card-block">
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">


                        <div id="quickad-tbs" class="wrap">
                            <div class="quickad-tbs-body">

                                <div class="row">
                                    <div id="quickad-sidebar" class="col-sm-4">
                                        <ul class="quickad-nav" role="tablist">
                                            <li class="quickad-nav-item active" data-target="#quickad_rate_avalibility" data-toggle="tab">Rate & Avalibility</li>
                                            <li class="quickad-nav-item" data-target="#quickad_languages" data-toggle="tab">Languages</li>
                                            <li class="quickad-nav-item" data-target="#quick_cultural_background" data-toggle="tab">Cultural Backgrounds</li>
                                            <li class="quickad-nav-item" data-target="#quickad_religion" data-toggle="tab">Religion</li>
                                            <!-- <li class="quickad-nav-item" data-target="#quickad_experiences" data-toggle="tab">User Experiences</li>
                                            <li class="quickad-nav-item" data-target="#quickad_email" data-toggle="tab">My Educations</li>
                                            <li class="quickad-nav-item" data-target="#quickad_theme_setting" data-toggle="tab">Skills</li> -->
                                            
                                        </ul>
                                    </div>
                                    <div id="quickad_settings_controls" class="col-sm-8">
                                        <div class="panel panel-default quickad-main">
                                            <div class="panel-body">
                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="quickad_rate_avalibility">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_rate_avalibility">
                                                            <div class="form-group row">
                                                                <div class="col-md-2">
                                                                    <label class="css-input switch switch-sm switch-success">        
                                                                        <input   name="available_to_work" type="checkbox" value="1" <?php if($info['active'] == '1') echo "checked"; ?> /><span></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <label>Not available for work</label>
                                                                </div>       
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="specific_country">Address</label>
                                                                <div>
                                                                    <select  class="js-select2 form-control" name="city[]" id="jobcity" style="width: 100%;" multiple>
                                                                        <?php

                                                                        $country = get_country_list(get_option("specific_country"));
                                                                        foreach ($country as $value){
                                                                            echo '<option value="'.$value['code'].'" '.$value['selected'].'>'.$value['asciiname'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php foreach(getDays() as $days){
                                                                    //print_r($days);
                                                                        $cls = 'd-none';
                                                                        $start_time= $end_time='';
                                                                        if(in_array($days['code'],$user_pr_days_code)){
                                                                            $cls=''; 
                                                                            $start_time =   $user_days[$days['code']]['start_time'];
                                                                            $end_time =     $user_days[$days['code']]['end_time'] ; 
                                                                        }
                                                                        $day_time_slots.='
                                                                        <div class="col-xl-12 time_section '.$cls.'" id="section_'.$days['code'].'" data-day-code="'.$days['code'].'">
                                                                                <div class="col-xl-6">
                                                                                    <div class="submit-field">
                                                                                        <h5>'.$days['day'].'</h5>
                                                                                        <div class="row">
                                                                                            <div class="col-xl-6">
                                                                                                <div class="input-with-icon">
                                                                                                    <input class="with-border" type="text" placeholder="'.$lang['START_TIME'].'" value="'.$start_time.'" name="time_slot['.$days['code'].'][start_time]">
                                                                                                    <i class="fa fa-clock-o"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-xl-6">
                                                                                                <div class="input-with-icon">
                                                                                                    <input class="with-border" type="text" placeholder="'.$lang['END_TIME'].'"  value="'.$end_time.'" name="time_slot['.$days['code'].'][end_time]">
                                                                                                    <i class="fa fa-clock-o"></i>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>';
                                                                    }
                                                                    ?>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 mt-3">
                                                                <label class="">Expected Rate :</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input name="home_map_longitude" type="number" class="form-control" name="salary_min" value="">
                                                                    Minimum Rate per hour.
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input name="home_map_longitude" type="number" class="form-control" name="salary_max" value="">
                                                                    Maximum Rate per hour.
                                                                </div>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="quick_map" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="quickad_languages">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_languages" multiple>
                                                            <div class="form-group">
                                                                    <label for="map_type"> Main Languages : </label>
                                                                    <select name="main_langs[]" id="" class="form-control js-select2" style="width: 100%;">
                                                                    <?php 
                                                                    foreach ($main_languages as $key => $value) {
                                                                        echo '<option value="'.$value['id'].'" '.$value['selected'].' >'.$value['name'].'</option>';
                                                                    }
                                                                    ?>
                                                                    </select>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="quick_map" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="quick_cultural_background">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quick_cultural_background">
                                                            <div class="form-group">
                                                                <label for="map_type">Cultural Backgrounds : </label>
                                                                <select name="cul_bag[]" id="" class="form-control js-select2" style="width: 100%;" multiple>
                                                                <?php 
                                                                foreach ($backgrounds as $key => $value) {
                                                                    echo '<option value="'.$value['id'].'" '.$value['selected'].' >'.$value['name'].'</option>';
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="map_type">Asian : </label>
                                                                <select name="cul_bag_opt[]" id="" class="form-control js-select2" style="width: 100%;" multiple>
                                                                <?php 
                                                                foreach ($backgrounds as $key => $value) {
                                                                    echo '<option value="'.$value['bck_opt_id'].'" '.$value['selected'].' >'.$value['bck_opt_name'].'</option>';
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="live_location_track" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="quickad_religion">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_religion">
                                                        <div class="form-group">
                                                                <label for="map_type">Religion </label>
                                                                <select name="religion[]" id="" class="form-control js-select2" style="width: 100%;">
                                                                <?php 
                                                                foreach ($religions as $key => $value) {
                                                                    echo '<option value="'.$value['id'].'" '.$value['selected'].'>'.$value['name'].'</option>';                                                            
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="international" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- <div class="tab-pane" id="quickad_experiences">
                                                        <form method="post" action="ajax_sidepanel.php?action=SaveSettings" id="#quickad_experiences">
                                                            
                                                            <div class="form-group">
                                                                <label >Title</label>
                                                                <div>
                                                                    <input name="title" class="form-control" type="text"  value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label >Client</label>
                                                                <div>
                                                                    <input name="client" class="form-control" type="text"  value="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label >City</label>
                                                                <div>
                                                                    <input name="city" class="form-control" type="text"  value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label >Description</label>
                                                                <div>
                                                                    <textarea name="description" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label>Start Date</label>
                                                                    <div>
                                                                        <input name="start_date" class="form-control" type="date"  value="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>End Date</label>
                                                                    <div>
                                                                        <input name="end_date" class="form-control" type="date"  value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group margin-right-20">
                                                                <label>Currently Working</label>
                                                                <div>
                                                                    <input type="radio"checked name="current_working" class="with-gap"/>
                                                                    <label >Yes</label>
                                                                    <input type="radio" name="current_working" class="with-gap"/>
                                                                    <label > No</label>
                                                                </div>
                                                            </div>

                                                            <div class="panel-footer">
                                                                <button name="email_setting" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>


<?php include("footer.php"); ?>
<script>
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);
    if(url.indexOf("#") > -1){
        if(activeTab.length > 0){
            $(".quickad-nav-item").removeClass("active");
            $(".tab-pane").removeClass("active in");
            $("li[data-target = #"+activeTab+"]").addClass("active");
            $("#" + activeTab).addClass("active in");
            $('a[href="#'+ activeTab +'"]').tab('show')
        }
    }
</script>
<script>
    $(".save-changes").on('click',function(){
        $(".save-changes").addClass("bookme-progress");
    });
    // wait for the DOM to be loaded
    $(document).ready(function() {
        // bind 'myForm' and provide a simple callback function
        $('form').ajaxForm(function(data) {
            if (data == 0) {
                alertify.error("Unknown Error generated.");
            } else {
                data = JSON.parse(data);
                if (data.status == "success") {
                    alertify.success(data.message);
                }
                else {
                    alertify.error(data.message);
                }
            }
            $(".save-changes").removeClass('bookme-progress');
        });

        /* Mail Method Changer */
        $("#email_type").on('change',function(){
            $(".mailMethods").hide();
            $(".mailMethod-"+$(this).val()).fadeIn('fast');
        });
    });
</script>
<!-- Page JS Code -->
<script>
    $(function()
    {
        // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
        App.initHelpers('select2');
    });
</script>
</body></html>