<header class="slidePanel-header overlay">
    <div class="overlay-panel overlay-background vertical-align">
        <div class="service-heading">
            <h2>Add Requirement</h2>
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
                    <form name="form2"  class="form form-horizontal" method="post" data-ajax-action="addRequirement" id="sidePanel_form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="requirement">Requirement Name<code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ion-document-text"></i></div>
                                            <input type="text" class="form-control" id="requirement" placeholder="Name" name="name" required="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="css-input switch switch-sm switch-success">    
                                        <input name="expiry_date" type="checkbox" value="1"/><span></span>
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <label>Expiry Date</label>
                                </div>       
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="css-input switch switch-sm switch-success">    
                                        <input   name="upload" type="checkbox" value="1"/><span></span>
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <label>Upload</label>
                                </div>       
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="css-input switch switch-sm switch-success">    
                                        <input   name="registration_number" type="checkbox" value="1"/><span></span>
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <label>Registration Number</label>
                                </div>       
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label class="css-input switch switch-sm switch-success">    
                                        <input   name="status" type="checkbox" value="1"/><span></span>
                                    </label>
                                </div>
                                <div class="col-md-10">
                                    <label>Status</label>
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
