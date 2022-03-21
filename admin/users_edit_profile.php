<?php

require_once('includes.php');
$main_languages=ORM::for_table($config['db']['pre'] . 'language')->where('type','main')->find_array();
$religion_list = ORM::for_table($config['db']['pre'] .'religions')->select_many('id','name')->find_array();

$backgrounds = ORM::for_table($config['db']['pre'] .'cultural_backgrounds')->table_alias('c_back')
    ->select_many('c_back.id','c_back.name',array('bck_opt_id'=>'bck_opt.id','bck_opt_name'=>'bck_opt.name'))
    ->select_expr('(SELECT COUNT(cultural_background_id) FROM '.$config['db']['pre'].'cultural_background_options WHERE cultural_background_id=c_back.id)','total_options')
    ->left_outer_join($config['db']['pre'] . 'cultural_background_options','c_back.id=bck_opt.cultural_background_id','bck_opt')
    ->order_by_asc('c_back.id')
    ->find_array();

$backgrounds = ORM::for_table($config['db']['pre'] .'cultural_backgrounds')->order_by_asc('name')->find_array();


    // echo "<pre>";
    //  print_r($backgroundOptions);die;

$user_id= $_GET['id'];
$userBackgrounds = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->select('cultural_background_id')->where('user_id', $user_id)->where_raw('NOT(cultural_background_id <=> NULL)')->find_array();
$userBackgroundIds=array_column($userBackgrounds,'cultural_background_id');


// print_r($userBackgroundOptionIds);die;

$user_religion=ORM::for_table($config['db']['pre'] . 'user_religions')->where('user_id',$user_id)->find_array();
$religion_code=array_column($user_religion,'religion_id');
 //print_r($religion_code);die;
 $user_lang=ORM::for_table($config['db']['pre'] . 'user_languages')->where('user_id',$user_id)->find_array();
 $lang_code=array_column($user_lang,'language_id');
 //print_r($user_lang);die;


$salary = ORM::for_table($config['db']['pre'] . 'user')->where('id',$user_id)->find_array();
//print_r($salary);die;
$user_city=ORM::for_table($config['db']['pre'] . 'user_cities')->where('user_id',$user_id)->find_array();
$city_codes=array_column($user_city,'city_code');

$city_list=ORM::for_table($config['db']['pre'] . 'cities')->find_many();

$user_pr_days=ORM::for_table($config['db']['pre'] . 'user_prefered_days')
->select_many('id','user_id','day')
->select_many_expr(["start_time"=>"TIME_FORMAT(start_time,'%h:%i %p')"],["end_time"=>"TIME_FORMAT(end_time, '%h:%i %p')"])
->where('user_id',$user_id)->find_array();
$user_days=[];
foreach($user_pr_days as $val){
    $user_days[$val['day']]=['start_time'=>$val['start_time'],'end_time'=>$val['end_time']];
}

$user_pr_days_code=array_keys($user_days);
// print_r($user_days);
// die;
?>

<style>
    .wp_in_icon{position: relative;}
    .wp_in_icon i{    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    color:#a0a0a0;
    font-size: 20px;}

    .er_in_icon{position: relative;}
    .er_in_icon i{    position: absolute;
    top: 0;
    right: 10px;
    padding: 10px;
    color:#a0a0a0;
    font-size: 20px;}

    .d-none{
        display: none;
    }
</style>

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
                                            <!-- <li class="quickad-nav-item" data-target="#quickad_experiences" data-toggle="tab">User Experiences</li>-->
                                            <li class="quickad-nav-item" data-target="#quickad_immunisation" data-toggle="tab">Immunisation Info</li>
                                            
                                        </ul>
                                    </div>
                                    <div id="quickad_settings_controls" class="col-sm-8">
                                        <div class="panel panel-default quickad-main">
                                            <div class="panel-body">
                                                <div class="tab-content">
                                                 
                                                    <div class="tab-pane active" id="quickad_rate_avalibility">
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserProfileRate" id="#quickad_rate_avalibility">
                                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                            <div class="form-group row">
                                                                <div class="col-md-2">
                                                                    <label class="css-input switch switch-sm switch-success">  
                                                                         <?php foreach ($salary as $key => $sal) { ?>      
                                                                        <input   name="available_to_work" type="checkbox" value="1" <?php if($sal['available_to_work'] == '1') echo "checked"; ?> /><span></span>
                                                                        <?php
                                                                         }
                                                                       ?>
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

                                                                       
                                                                        foreach ($city_list as $value){
                                                                            $selected= in_array($value['id'],$city_codes) ? 'selected': '';
                                                                            echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['name'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-4 mt-3">
                                                                    <label class="">Prefered Days :</label>
                                                                </div>
                                                                <div class="col-md-8 mt-3">
                                                                    <select class="form-control js-select2" multiple data-selected-text-format="count > 1" name="days[]" id="days">
                                                                    <?php foreach(getDays() as $days){
                                                                        $selected= in_array($days['code'],$user_pr_days_code) ? 'selected': '';
                                                                        echo "<option value=".$days['code']." ".$selected.">".$days['day']."</option>";         
                                                                    }?>
                                                                    </select>
                                                                    <div class="col-lg-12">
                                                                    <?php
                                                                    foreach(getDays() as $days){
                                                                        $cls = 'd-none';
                                                                        $start_time= $end_time='';
                                                                        if(in_array($days['code'],$user_pr_days_code)){
                                                                            $cls = '';
                                                                            $start_time =   $user_days[$days['code']]['start_time'];
                                                                            $end_time =     $user_days[$days['code']]['end_time'] ; 
                                                                        }
                                                                            echo '<div class="row time_section '.$cls.'" id="section_'.$days['code'].'" data-day-code="'.$days['code'].'">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label><b>'.$days['day'].'</b></label>
                                                                                            <div class="wp_in_icon">
                                                                                                <input class="form-control" type="text" placeholder="Start time" value="'.$start_time.'" name="time_slot['.$days['code'].'][start_time]">
                                                                                                <i class="fa fa-clock-o"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <label style="opacity: 0;"><b>empty</b></label>
                                                                                            <div class="wp_in_icon">
                                                                                            <input class="form-control" type="text" placeholder="END time" value="'.$end_time.'" name="time_slot['.$days['code'].'][end_time]">
                                                                                            <i class="fa fa-clock-o"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                            </div> '; 
                                                                        
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group row">
                                                                <div class="col-md-4 mt-3">
                                                                <label class="">Expected Rate :</label>
                                                                </div>
                                                                <?php foreach ($salary as $key => $sal) { ?>
                                                                    <div class="col-md-4 er_in_icon">
                                                                    <input type="number" class="form-control" name="salary_min" value="<?php echo $sal['salary_min']; ?>">
                                                                    <i class="fa fa-usd"></i>
                                                                    <small>Minimum Rate per hour.</small>
                                                                </div>
                                                                <div class="col-md-4 er_in_icon">
                                                                    <input type="number" class="form-control" name="salary_max" value="<?php echo $sal['salary_max']; ?>">
                                                                    <i class="fa fa-usd"></i>
                                                                    <small>Maximum Rate per hour.</small>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-2">
                                                                    <label class="css-input css-checkbox css-checkbox-primary">
                                                                    <?php foreach ($salary as $key => $sal) { ?> 
                                                                        <input type="checkbox" name="session_willing" id="session_willing" value="1" <?php if($sal['is_session_willing'] == '1') echo "checked"; ?>><span></span>
                                                                        <?php 
                                                                        } 
                                                                        ?>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <label for="session_willing"><span class="checkbox-icon"></span>I'm willing to offer a free great & meet session to potential clients.</label>
                                                                </div>                                                                   
                                                            </div>
                                                            <!-- <div class="form-group row">
                                                                <div class="checkbox submit-field co-md-2">
                                                                    <input type="checkbox" id="session_willing" name="session_willing" value="1">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    
                                                                </div>
                                                            </div> -->
                                                            <div class="panel-footer">
                                                                <button name="quick_map" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="quickad_languages">
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserLanguages" id="#quickad_languages">
                                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                            <div class="form-group">
                                                                    <label for="map_type"> Main Languages : </label>
                                                                    <select name="main_langs[]" id="" class="form-control js-select2" style="width: 100%;" multiple>
                                                                    <?php 
                                                                    foreach ($main_languages as $key => $value) {
                                                                        $selected= in_array($value['id'],$lang_code) ? 'selected': '';
                                                                        echo '<option value="'.$value['id'].'" '.$selected.' >'.$value['name'].'</option>';
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
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserCulturalBackground" id="#quick_cultural_background">
                                                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                            <div class="form-group">
                                                                <label for="map_type">Cultural Backgrounds : </label>
                                                                <select name="background[]" id="" class="form-control  background js-select2" style="width: 100%;" multiple>
                                                                <?php 
                                                                foreach ($backgrounds as $key => $value) {
                                                                    $selected=in_array($value['id'],$userBackgroundIds) ? 'selected':'';
                                                                    echo '<option value="'.$value['id'].'" '.$selected.' >'.$value['name'].'</option>';
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <?php 
                                                                foreach ($backgrounds as $key => $value) {
                                                                    $backgroundOptions = ORM::for_table($config['db']['pre'] .'cultural_background_options')->where('cultural_background_id', $value['id'])->find_array();
                                                                    $userBackgroundOptions = ORM::for_table($config['db']['pre'] . 'user_cultural_backgrounds')->select('cultural_background_option_id')->where('user_id', $user_id)->where('cultural_background_id', $value['id'])->where_raw('NOT(cultural_background_option_id <=> NULL)')->find_array();
                                                                    $userBackgroundOptionIds=array_column($userBackgroundOptions,'cultural_background_option_id');
                                                                    
                                                                    if(!empty($backgroundOptions) && count($backgroundOptions)) {
                                                                        ?>
                                                                            <div data-id="<?php echo $value['id'];?>" class="form-group background_options <?php if(count($userBackgroundOptionIds) <= 0) { echo 'd-none'; } ?>">
                                                                                <label for="map_type"><?php echo $value['name']; ?> : </label>
                                                                                <select name="back_options[<?php echo $value['id'] ?>][]" id="" class="form-control js-select2" style="width: 100%;" multiple>
                                                                                <?php 
                                                                                foreach ($backgroundOptions as $key => $backOption) {
                                                                                    $selected=in_array($backOption['id'],$userBackgroundOptionIds) ? 'selected="selected"':'';
                                                                                    echo '<option value="'.$backOption['id'].'" '.$selected.' >'.$backOption['name'].'</option>';
                                                                                }
                                                                                ?>
                                                                                </select>
                                                                            </div>                                                                       
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>                                                            
                                                            <div class="panel-footer">
                                                                <button name="live_location_track" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="tab-pane" id="quickad_religion">
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserReligion" id="#quickad_religion">
                                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                             <div class="form-group">
                                                                <label for="map_type">Religion </label>
                                                                <select name="religion[]" id="" class="form-control js-select2" style="width: 100%;" multiple>
                                                                <?php 
                                                                foreach ($religion_list as $key => $rel) {
                                                                    $selected= in_array($rel['id'],$religion_code) ? 'selected': '';
                                                                    echo '<option value="'.$rel['id'].'" '.$selected.'>'.$rel['name'].'</option>';                                                            
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
                                                    <div class="tab-pane" id="quickad_immunisation">
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserImmunisationInfo" id="#quickad_immunisation">
                                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                                              <div class="form-group row">
                                                               
                                                                    <label>Currently Working</label>
                                                                    <div class="radio">
                                                                            <input id="radio-rating-1" name="radio" type="radio" checked="">
                                                                            <label for="radio-rating-1"><span class="radio-label"></span> Yes</label>
                                                                    </div>
                                                                        <label >Yes</label>
                                                                        <input type="radio" name="current_working" class="with-gap"/>
                                                                        <label > No</label>  
                                                            </div>
                                                            <div class="panel-footer">
                                                                <button name="international" type="submit" class="btn btn-primary btn-radius save-changes">Save</button>
                                                                <button class="btn btn-default" type="reset">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- <div class="tab-pane" id="quickad_experiences">
                                                        <form method="post" action="ajax_sidepanel.php?action=editUserProfile" id="#quickad_experiences">
                                                            
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
            $('a[href="#'+ activeTab +'"]').tab('show');
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
<script>
    /* Get and Bind cities */
    $('#jobcity').select2({
        multiple:true,
        ajax: {
            url: ajaxurl + '?action=searchCityFromCountry',
            dataType: 'json',
            delay: 50,
            data: function (params) {
                return {
                    q: params.term, /* search term */
                    page: params.page
                };
            },
            processResults: function (data, params) {
                /*
                 // parse the results into the format expected by Select2
                 // since we are using custom formatting functions we do not need to
                 // alter the remote JSON data, except to indicate that infinite
                 // scrolling can be used
                 */
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 10) < data.totalEntries
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, /* let our custom formatter work */
        minimumInputLength: 2,
        templateResult: function (data) {
            return data.text;
        },
        templateSelection: function (data, container) {
            return data.text;
        }
    });
 
 
    let string = '{USER_PRE_DAYS}';
    let arr = string.split(',');   
    //$('#days').selectpicker('val',arr);
    $('#days').on('change',function(){
        var values = $(this).val();
        document.querySelectorAll('.time_section').forEach(function(node) {
            let day_code=node.dataset.dayCode
            if(values.indexOf(day_code) == -1){
                node.classList.add("d-none");
            }else{
                node.classList.remove("d-none");
            } 
        });
    });
</script>
<script>
$(function() {
    $(".background").on("change", function() {
        var cl= $(this).val();

        let backgroundOptions = $(".background_options");

        backgroundOptions.each( (ind, elment) => {
            let id = $(elment).data('id');
            if(cl.includes(id.toString())) {
                $(elment).removeClass('d-none');
            } else {
                $(elment).addClass('d-none');
            }
        })
        console.log(backgroundOptions);

        // backgroundOptions.forEach( (elment) => {
        //     console.log($(elment).data('id'));
        //     // $(".background_options[data-id="+val+"]").removeClass('d-none');
        //     // console.log();
        // });

        console.log(cl, $(".background_options[data-id="+1+"]"));
        $("#option_section"+cl).toggleClass("d-none");
        
    });
});
</script>
</body></html>