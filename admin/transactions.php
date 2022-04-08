<?php
require_once('includes.php');
$payment_method = ORM::for_table($config['db']['pre'] . 'payments')->find_array();
?>
<!-- Page JS Plugins CSS -->
<style>
    .wraper_card_cust .filter-option-inner-inner {
        font-weight: 300;
        font-size: 14px
    }

    .dropdown-menu .inner li a {
        font-weight: 300;
        font-size: 14px
    }
</style>

<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card wraper_card_cust">
            <div class="card-header">
                <h4>Transactions</h4>
            </div>
            <div class="card-block">
                <div id="js-table-list">
                    <form method="get" data-ajax-action="transaction.php" data-url="<?= $config['site_url']; ?>" id="search_filter">
                        <input type="hidden" class="form-control" name="search_type" value="filter" />
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Username</label>
                                        <select class="form-control selectpicker" name="username[]" multiple>
                                            <option value='"consumer"'>Consumer</option>
                                            <option value='"employer"'>Employer</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Status</label>
                                        <select class="form-control selectpicker" name="status[]" multiple>
                                            <option value='"success"'>Success</option>
                                            <option value='"failed"'>Failed</option>
                                            <option value='"pending"'>Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Pay Method</label>
                                        <select class="form-control selectpicker" name="pay_method[]" multiple>
                                            <?php foreach ($payment_method as $method) { ?>
                                                <option value='"<?= $method['payment_title']; ?>"'><?= $method['payment_title']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date</label>
                                        <input class="form-control form-control-solid kt_daterangepicker" autocomplete="off" name="date" placeholder="Pick date rage" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary form-control" style="margin-top:28px;" value="Search">
                            </div>
                        </div>
                    </form>
                    <br>
                    <table id="ajax_datatable" data-jsonfile="transaction.php" class="js-table-checkable table table-vcenter table-hover" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                        <thead>
                            <tr>
                                <th class="text-center w-5 sortingNone">
                                    <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                        <input type="checkbox" id="check-all" name="check-all"><span></span>
                                    </label>
                                </th>
                                <th class="sortingNone">Ad Title</th>
                                <th class="sortingNone">Username</th>
                                <th class="sortingNone">Amount</th>
                                <th class="sortingNone">Premium</th>
                                <th class="sortingNone">Status</th>
                                <th class="sortingNone">Pay Method</th>
                                <th class="sortingNone">Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ajax-services">

                        </tbody>
                    </table>

                </div>


            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
        <!-- End Partial Table -->

    </div>
    <!-- .container-fluid -->
    <!-- End Page Content -->

</main>

<!-- Site Action -->
<div class="site-action">
    <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating" style="visibility: hidden">
        <i class="back-icon ion-android-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
        <button type="button" data-ajax-response="deletemarked" data-ajax-action="deleteTransaction" class="btn-raised btn btn-danger btn-floating animation-slide-bottom">
            <i class="icon ion-android-delete" aria-hidden="true"></i>
        </button>
    </div>
</div>
<!-- End Site Action -->

<?php include("footer.php"); ?>

<script>
    $(function() {
        // Init page helpers (Table Tools helper)
        App.initHelpers('table-tools');
    });
</script>

</body>

</html>