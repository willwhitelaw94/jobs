{OVERALL_HEADER}
<div id="titlebar" class="margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{LANG_WALLET}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
                        <li><a href="{LINK_WALLET}">{LANG_WALLET}</a></li>
                        <li>{LANG_CREATE_WALLET}</li>
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
                        <h3><i class="icon-feather-briefcase"></i> {LANG_CREATE_WALLET}</h3>
                    </div>
                    <div class="content with-padding">
                        
                        <div class="row">
                            <div class="">
                                <div class="d-flex align-items-center rounded py-3 px-4 bg-light-danger">
                                    <span class="icon-feather-user text-gray-700 fa-2x " ></span>
                                    <div class="text-gray-700 fw-bold fs-6">
                                      {LANG_ACC_PRIVACY_MSG}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-5">
                            <form method="post" accept-charset="UTF-8">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="submit-field">
                                            <h5>{LANG_WALLET_AMOUNT} *</h5>
                                            <input type="text" class="with-border" name="account_amount" value="">
                                            IF("{AMOUNT_ERROR}"!=""){ {AMOUNT_ERROR} {:IF}
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit_details"
                                        class="button ripple-effect">{LANG_WALLET_ADD}</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{OVERALL_FOOTER}
