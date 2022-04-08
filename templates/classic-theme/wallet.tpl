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
                        <li>{LANG_WALLET}</li>
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
                        <h3><i class="icon-feather-briefcase"></i> {LANG_WALLET}</h3>
                    </div>
                    <div class="content with-padding">
                        <div class="row">
                            <div class="col-xl-4">
                                <h2>{LANG_WALLET_AMOUNT} :- {OVERALL_AMOUNT}{CURRENCY_SIGN}</h2>
                            </div>
                            <div class="col-xl-8 text-right">
                                <a href="{LINK_CREATE_WALLET}" class="button ripple-effect">{LANG_CREATE_WALLET}</a>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="dashboard-box js-accordion-item active ">
                    <!-- Headline -->
                    <div class="headline">
                        <h3><i class="icon-feather-user"></i> {LANG_WALLET_HISTORY}</h3>
                    </div>
                    <div class="container margin-top-20">
                        <div class="table-responsive">
                            <table id="js-table-list" class="basic-table dashboard-box-list">
                                <thead>
                                    <tr>
                                        <th class="small-width">{LANG_DATE}</th>
                                        <th class="big-width">{LANG_DESCRIPTION}</th>
                                        <th class="small-width">{LANG_WALLET_CREDIT}</th>
                                        <th class="small-width">{LANG_WALLET_DEBIT}</th>
                                        <th class="small-width">{LANG_CLOSING_BALANCE}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {LOOP: TRANSACTIONS}
                                    <tr>
                                        <td>{TRANSACTIONS.date}</td>
                                        <td>{TRANSACTIONS.description}</td>
                                        <td>{TRANSACTIONS.credit}</td>
                                        <td>{TRANSACTIONS.debit}</td>
                                        <td>{TRANSACTIONS.closing_balance}</td>
                                    </tr>
                                    {/LOOP: TRANSACTIONS}
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagination-container margin-top-20">
                                    <nav class="pagination">
                                        
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{OVERALL_FOOTER}
