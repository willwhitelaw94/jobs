{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_JOB_ALERT}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li>{LANG_JOB_ALERT}</li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<div class="section gray padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                {USER_SIDEBAR}
            </div>
        <div class="col-lg-9 col-md-12">
            <div class="dashboard-box margin-top-0">
                <!-- Headline -->
                <div class="headline">
                    <h3><i class="icon-feather-bell"></i> Notifications</h3>
                </div>
                <div class="content with-padding">
                    <form method="post">

                        IF('{USERTYPE}' == "user"){
                        <!-- Notify me when a job gets posted that is relevant to my choice. -->

                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify" name="notify" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify"><span class="checkbox-icon"></span> {LANG_NOTIFYEMAIL}</label>
                            </div>
                            <ul class="skills margin-left-20">
                                {LOOP: CATEGORY}
                                    <li>
                                        <div class="checkbox">
                                            <input type="checkbox" id="{CATEGORY.id}" name="choice[{CATEGORY.id}]" value="{CATEGORY.id}" {CATEGORY.selected}>
                                            <label for="{CATEGORY.id}"><span class="checkbox-icon"></span> {CATEGORY.name}</label>
                                        </div>
                                    </li>
                                {/LOOP: CATEGORY}
                            </ul>
                        </div>
                        <!-- Employer -->

                        <!-- Notify me when somebody sends me a message. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify2" name="notify2" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify2"><span class="checkbox-icon"></span> Notify me when somebody sends me a message.</label>
                            </div>
                            <ul class="skills margin-left-20">

                            </ul>
                        </div>
                        <!-- Notify me when somebody accepts a job I applied for. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify3" name="notify3" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify3"><span class="checkbox-icon"></span> Notify me when somebody accepts a job I applied for.</label>
                            </div>
                            <ul class="skills margin-left-20">

                            </ul>
                        </div>
                        <!-- Notify me when somebody cancels a job. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify4" name="notify4" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify4"><span class="checkbox-icon"></span> Notify me when somebody cancels a job.</label>
                            </div>
                            <ul class="skills margin-left-20">

                            </ul>
                        </div>

                        <!-- Notify me when somebody accepts a timesheet. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify4" name="notify4" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify4"><span class="checkbox-icon"></span> Notify me when somebody accepts a timesheet. </label>
                            </div>
                            <ul class="skills margin-left-20">

                            </ul>
                        </div>

                        <!-- Notify me when an invoice is prepared. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify4" name="notify4" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify4"><span class="checkbox-icon"></span> Notify me when an invoice is prepared.</label>
                            </div>
                            <ul class="skills margin-left-20">

                            </ul>
                        </div>

                        <!-- Notify me when an invoice is paid. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify4" name="notify4" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify4"><span class="checkbox-icon"></span> Notify me when an invoice is paid.</label>
                            </div>
                            <ul class="skills margin-left-20">
                            </ul>
                        </div>

                        <!-- Notify me when somebody leaves a review. -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" id="notify4" name="notify4" value="1" onchange="NotifyValueChanged()" IF({NOTIFY}){ checked {:IF}>
                                <label for="notify4"><span class="checkbox-icon"></span> Notify me when somebody leaves a review.</label>
                            </div>
                            <ul class="skills margin-left-20">
                            </ul>
                        </div>

                        {:IF}
                        IF('{USERTYPE}' == "user"){

                        <!-- Notify me when somebody sends me a message. (shared) -->
                        <!-- Notify me when somebody applies for a job. -->
                        <!-- Notify me when somebody cancels a job (shared) -->
                        <!-- Notify when somebody submits a timesheet. -->
                        <!-- Notify me when an invoice is submitted. (shared) -->
                        <!-- Notify me when an invoice is paid. -->
                        <!-- Notify me when somebody leaves a review. (shared) -->

                        {:IF}







                      <button type="submit" name="submit" class="button ripple-effect">{LANG_SAVE_CHANGES}</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    function NotifyValueChanged()
    {
        if($('#notify').is(":checked"))
            $(".skills").slideDown();
        else
            $(".skills").slideUp();
    }
    NotifyValueChanged();
</script>
{OVERALL_FOOTER}
