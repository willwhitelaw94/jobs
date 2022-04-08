</div>
<!-- .app-layout-container -->
</div>
<!-- .app-layout-canvas -->

<!-- Apps Modal -->
<!-- Opens from the button in the header -->
<div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-sm modal-dialog modal-dialog-top">
        <div class="modal-content">
            <!-- Apps card -->
            <div class="card m-b-0">
                <div class="card-header bg-app bg-inverse">
                    <h4>Apps</h4>
                    <ul class="card-actions">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                        </li>
                    </ul>
                </div>
                <div class="card-block">
                    <div class="row text-center">
                        <div class="col-xs-6">
                            <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="index.php">
                                <i class="ion-speedometer fa-4x"></i>
                                <p>Admin</p>
                            </a>
                        </div>
                        <div class="col-xs-6">
                            <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" target="_blank" href="../home">
                                <i class="ion-laptop fa-4x"></i>
                                <p>Frontend</p>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- .card-block -->
            </div>
            <!-- End Apps card -->
        </div>
    </div>
</div>
<!-- End Apps Modal -->

<div class="app-ui-mask-modal"></div>

<!-- Zeunix Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
<script src="assets/js/core/jquery.min.js"></script>

<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/core/jquery.slimscroll.min.js"></script>
<script src="assets/js/core/jquery.scrollLock.min.js"></script>
<script src="assets/js/core/jquery.placeholder.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/app-custom.js"></script>
<script src="assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>


<script src="js/admin-ajax.js?ver=3.0"></script>
<script src="js/ajaxForm/jquery.form.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>

<!-- datatables JS Code -->
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/pages/base_tables_datatables.js"></script>
<!-- select2  -->
<script src="assets/js/plugins/select2/select2.full.min.js"></script>


<script src="assets/js/plugins/asscrollable/jquery.asScrollable.all.min.js"></script>
<script src="assets/js/plugins/slidepanel/jquery-slidePanel.min.js"></script>
<script src="assets/js/plugins/bootbox/bootbox.js"></script>
<script src="assets/js/slidepanel/core.min.js"></script>
<script src="assets/js/plugins/alertify/alertify.js"></script>
<script src="assets/js/slidepanel/action-btn.min.js"></script>
<script src="assets/js/slidepanel/selectable.min.js"></script>
<script src="assets/js/slidepanel/components.js"></script>
<script src="assets/js/slidepanel/app.min.js"></script>
<script src="assets/js/slidepanel/app.min.js"></script>
<script src="../includes/assets/js/repeater.min.js"></script>
<!-------------------------Add New Js and Css----------------------------------->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-------------------------End New Js and Css----------------------------------->
<script>
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $(".kt_daterangepicker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    }

    $(".kt_daterangepicker").daterangepicker({
        startDate: start,
        endDate: end,
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
        },
        ranges: {
            "Today": [moment(), moment()],
            "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "Last 7 Days": [moment().subtract(6, "days"), moment()],
            "Last 30 Days": [moment().subtract(29, "days"), moment()],
            "This Month": [moment().startOf("month"), moment().endOf("month")],
            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
        }
    }, cb);

    $('.kt_daterangepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY'));
    });

    $('.kt_daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    cb(start, end);
</script>