<?php
require_once('includes.php');
$companies = ORM::for_table($config['db']['pre'] . 'companies')->find_array();
$category = ORM::for_table($config['db']['pre'] . 'catagory_main')->find_array();
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
<link rel="stylesheet" href="assets/js/plugins/datatables/jquery.dataTables.min.css" />
<main class="app-layout-content">

    <!-- Page Content -->
    <div class="container-fluid p-y-md">
        <!-- Partial Table -->
        <div class="card wraper_card_cust">
            <div class="card-header">
                <h4>Active Jobs</h4>
                <div class="pull-right">
                    <a href="setting.php#quickad_frontend_submission" class="btn btn-success waves-effect waves-light m-r-10">Post job setting</a>
                </div>
            </div>
            <div class="card-block">
                <div id="js-table-list">
                    <form method="get" data-ajax-action="post.php" data-url="<?= $config['site_url']; ?>" id="search_filter">
                        <input type="hidden" class="form-control" name="search_type" value="filter" />
                        <input type="hidden" class="form-control" name="post_status" value='"active"' />
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Company</label>
                                        <select class="form-control selectpicker" name="company[]" multiple>
                                            <?php foreach ($companies as $company) { ?>
                                                <option value='"<?= $company['id']; ?>"'><?= $company['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Posted Date</label>
                                        <input class="form-control form-control-solid kt_daterangepicker" autocomplete="off" name="created_at" placeholder="Pick date rage" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Category</label>
                                        <select class="form-control selectpicker" name="category[]" data-url="<?= $config['site_url']; ?>" id="filter_category" data-ajax-action="users_category.php" multiple>
                                            <?php foreach ($category as $cat) { ?>
                                                <option value='<?= $cat['cat_id']; ?>'><?= $cat['cat_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3" id="filter_subctaegory">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary form-control" style="margin-top:28px;" value="Search">
                            </div>
                        </div>
                    </form>
                    <br>
                    <table class="js-table-checkable table table-vcenter table-hover" id="ajax_datatable" data-jsonfile="post.php?status=active">
                        <thead>
                            <tr>
                                <th class="text-center w-5 sortingNone">
                                    <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                        <input type="checkbox" id="check-all" name="check-all"><span></span>
                                    </label>
                                </th>
                                <th>Title</th>
                                <th class="hidden-xs hidden-sm">Username</th>
                                <th class="hidden-xs hidden-sm">Company</th>
                                <th class="hidden-xs w-30">Location</th>
                                <th class="hidden-xs hidden-sm" style="width:100px">Posted</th>
                                <th class="hidden-xs hidden-sm" style="width:100px">Status</th>
                                <th class="text-center" style="width: 128px;">Actions</th>
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
    <button type="button" class="site-action-toggle btn-raised btn btn-warning btn-floating" style="visibility: hidden;">
        <i class="back-icon ion-android-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
        <button type="button" data-ajax-response="deletemarked" data-ajax-action="deleteads" class="btn-raised btn btn-danger btn-floating animation-slide-bottom">
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

        // Init page helpers (BS Notify Plugin)
        App.initHelpers('notify');
    });
</script>
</body>

</html>