<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Cultural Background</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addCulturalBackground" id="sidePanel_form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputfullname">Country Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-person"></i></div>
                                            <input type="text" class="form-control" id="exampleInputreligionname" placeholder="Country Name" name="name" required="">
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
                                <!-- <div class="col-md-10"> -->
                                       
                                <!-- </div> -->
                                <!-- <div class="col-md-2 mt-4">
                                    <button class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div> -->
                                    <!-- <div class="form-group">
                                        <div class="col-sm-12">
                                        <label for="exampleInputfulltype">Language type:</label>
                                            <select name="type" id="exampleInputfulltype" class="form-control">
                                                <option value="main">main</option>
                                                <option value="others">others</option>
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


<!-- <script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div class="col-md-12">';
        html += '<div class="form-group">';
        html += '<div class="input-group">';
        html += '<div class="input-group-addon"><i class="ion-person"></i></div>';
        html += '<input type="text" class="form-control" id="exampleInputreligionname" placeholder="Language Name" name="option" required="">';
        html += '<span class="help-block"></span>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });
</script> -->
<script type="text/javascript">
$(function(){
    $('.repeater').repeater({
        isFirstItemUndeletable: true
});

});
</script>