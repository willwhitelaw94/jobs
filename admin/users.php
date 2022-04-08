<?php
require_once('includes.php');
$category = ORM::for_table($config['db']['pre'] . 'catagory_main')->find_array();
?>
<!-- Page JS Plugins CSS -->
<style>
    .table_wrapper {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

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
        <div class="card">
            <div class="card-header">
                <h4>Users</h4>
                <div class="pull-right">
                    <a href="#" data-url="panel/users_add.php" data-toggle="slidePanel" class="btn btn-success waves-effect waves-light m-r-10">Add User</a>
                </div>
            </div>
            <div class="card-block">
                <div id="js-table-list">
                    <div class="card wraper_card_cust" style="padding:20px;background:#f9f6f6;">
                        <form method="get" data-ajax-action="users.php" data-url="<?= $config['site_url']; ?>" id="search_filter">
                            <input type="hidden" class="form-control" name="search_type" value="filter" />
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Type</label>
                                    <select class="form-control selectpicker" name="user_type[]" multiple>
                                        <option value='"user"'>Job Seeker</option>
                                        <option value='"employer"'>Employer</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Status</label>
                                    <select class="form-control selectpicker" name="status[]" multiple>
                                        <option value='"0"'>Active</option>
                                        <option value='"1"'>Verify</option>
                                        <option value='"2"'>Ban</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Sex</label>
                                    <select class="form-control selectpicker" name="sex[]" multiple>
                                        <option value='"Male"'>Male</option>
                                        <option value='"Female"'>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Joined Date</label>
                                    <input class="form-control form-control-solid kt_daterangepicker" autocomplete="off" name="date" placeholder="Pick date rage" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Wallet amount</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon pointer">
                                            <span class="glyphicon">$</span>
                                        </span>
                                        <input type="number" name="wallet_min_amount" class="form-control">

                                        <span class="input-group-addon pointer ">
                                            <span class="glyphicon">TO</span>
                                        </span>
                                        <input type="number" name="wallet_max_amount" class="form-control">
                                        <span class="input-group-addon pointer ">
                                            <span class="glyphicon">$</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Work Status</label>
                                    <select class="form-control selectpicker" name="available_to_work[]" multiple>
                                        <option value='"1"'>Online</option>
                                        <option value='"0"'>Offline</option>
                                    </select>
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
                            </div><br>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary form-control" value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <table id="ajax_datatable" data-jsonfile="users.php" class="js-table-checkable table table-vcenter table-hover table_wrapper" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                        <thead>
                            <tr>
                                <th class="text-center w-5 sortingNone">
                                    <label class="css-input css-checkbox css-checkbox-default m-t-0 m-b-0">
                                        <input type="checkbox" id="check-all" name="check-all"><span></span>
                                    </label>
                                </th>
                                <th><i class="ion-image"></i> User</th>
                                <th class="w-10">Work Status</th>
                                <th class="w-10">Address</th>
                                <th class="w-10">Wallet</th>
                                <th class="w-10">Type</th>
                                <th class="w-10">Email</th>
                                <th class="hidden-xs w-30" style="width: 100px;">Sex</th>
                                <th class="hidden-xs hidden-sm" style="width:100px">Status</th>
                                <th class="hidden-xs w-30" style="width: 100px;">Joined</th>
                                <th style="width: 130px;">Actions</th>
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
    <button data-url="panel/users_add.php" data-toggle="slidePanel" id="slidepanel-show" style="display: none;"> </button>
    <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating">
        <i class="front-icon ion-android-add animation-scale-up" aria-hidden="true"></i>
        <i class="back-icon ion-android-close animation-scale-up" aria-hidden="true"></i>
    </button>
    <div class="site-action-buttons">
        <button type="button" data-ajax-response="deletemarked" data-ajax-action="deleteusers" class="btn-raised btn btn-danger btn-floating animation-slide-bottom">
            <i class="icon ion-android-delete" aria-hidden="true"></i>
        </button>
    </div>
</div>
<!-- End Site Action -->

<?php include("footer.php");
?>
<script>
    $(function() {
        // Init page helpers (Table Tools helper)
        App.initHelpers('table-tools');
    });
</script>
</body>

</html>