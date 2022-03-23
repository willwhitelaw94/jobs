{OVERALL_HEADER}
<div class="margin-bottom-0" id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    {LANG_ADD_RESUME}
                </h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li>
                            <a href="{LINK_INDEX}">
                                {LANG_HOME}
                            </a>
                        </li>
                        <li>
                            {LANG_ADD_RESUME}
                        </li>
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
                        <h3>
                            <i class="icon-feather-paperclip">
                            </i>
                            {LANG_ADD_RESUME}
                        </h3>
                    </div>
                    <div class="content with-padding">
                        IF("{ERROR}" != ""){
                        <span class="status-not-available">{ERROR}</span>
                        {:IF}
                        <form method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                            <div class="submit-field">
                              <h5>{LANG_NAME}</h5>
                                <input type="text" class="with-border" id="name" name="name" value="{NAME}">
                            </div>
                            <div class="submit-field">
                              <h5>{LANG_FILE} *</h5>
                              <div class="uploadButton">
                                  <input class="uploadButton-input" type="file" id="resume" name="resume"/>
                                  <label class="uploadButton-button ripple-effect" for="resume">{LANG_UPLOAD_RESUME}</label>
                                  <span class="uploadButton-file-name">{LANG_RESUME_FILE_TYPE}</span>
                                </div>
                            </div>
                            IF('{ID}' != ''){
                            <input type="hidden" name="id" value="{ID}">
                            {:IF}
                            <button type="submit" name="submit" class="button ripple-effect">{LANG_SAVE}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}
