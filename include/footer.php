<!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="noprint">
            <footer class="footer">
                © 2019 Codebanten
            </footer>
            </div>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- <script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/popper/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="horizontal/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="horizontal/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="horizontal/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="horizontal/js/custom.min.js"></script>
    <script src="horizontal/js/jasny-bootstrap.js"></script>
    <script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="assets/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="assets/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script>
    $(function() {
    $('#myTable').DataTable();
    $(function() {
    var table = $('#example').DataTable({
    "columnDefs": [{
    "visible": false,
    "targets": 2
    }],
    "order": [
    [2, 'asc']
    ],
    "displayLength": 25,
    "drawCallback": function(settings) {
    var api = this.api();
    var rows = api.rows({
    page: 'current'
    }).nodes();
    var last = null;
    api.column(2, {
    page: 'current'
    }).data().each(function(group, i) {
    if (last !== group) {
    $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
    last = group;
    }
    });
    }
    });
    // Order by the grouping
    $('#example tbody').on('click', 'tr.group', function() {
    var currentOrder = table.order()[0];
    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
    table.order([2, 'desc']).draw();
    } else {
    table.order([2, 'asc']).draw();
    }
    });
    });
    });
    $('#example23').DataTable({
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    });
    $('#config-table').DataTable( {
            responsive: true
    } );
    </script>
    <!-- Plugin JavaScript -->
            
            <script>
                /*******************************************/
                // Basic Date Range Picker
                /*******************************************/
                $('.daterange').daterangepicker();

                /*******************************************/
                // Date & Time
                /*******************************************/
                $('.datetime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY h:mm A'
                    }
                });

                /*******************************************/
                //Calendars are not linked
                /*******************************************/
                $('.timeseconds').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    timePicker24Hour: true,
                    timePickerSeconds: true,
                    locale: {
                        format: 'MM-DD-YYYY h:mm:ss'
                    }
                });

                /*******************************************/
                // Single Date Range Picker
                /*******************************************/
                $('.singledate').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true
                });

                /*******************************************/
                // Auto Apply Date Range
                /*******************************************/
                $('.autoapply').daterangepicker({
                    autoApply: true,
                });

                /*******************************************/
                // Calendars are not linked
                /*******************************************/
                $('.linkedCalendars').daterangepicker({
                    linkedCalendars: false,
                });

                /*******************************************/
                // Date Limit
                /*******************************************/
                $('.dateLimit').daterangepicker({
                    dateLimit: {
                        days: 7
                    },
                });

                /*******************************************/
                // Show Dropdowns
                /*******************************************/
                $('.showdropdowns').daterangepicker({
                    showDropdowns: true,
                });

                /*******************************************/
                // Show Week Numbers
                /*******************************************/
                $('.showweeknumbers').daterangepicker({
                    showWeekNumbers: true,
                });

                /*******************************************/
                // Date Ranges
                /*******************************************/
                $('.dateranges').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                });

                /*******************************************/
                // Always Show Calendar on Ranges
                /*******************************************/
                $('.shawCalRanges').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    alwaysShowCalendars: true,
                });

                /*******************************************/
                // Top of the form-control open alignment
                /*******************************************/
                $('.drops').daterangepicker({
                    drops: "up" // up/down
                });

                /*******************************************/
                // Custom button options
                /*******************************************/
                $('.buttonClass').daterangepicker({
                    drops: "up",
                    buttonClasses: "btn",
                    applyClass: "btn-info",
                    cancelClass: "btn-danger"
                });

                /*******************************************/
                // Language
                /*******************************************/
                $('.localeRange').daterangepicker({
                    ranges: {
                        "Aujourd'hui": [moment(), moment()],
                        'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Les 7 derniers jours': [moment().subtract('days', 6), moment()],
                        'Les 30 derniers jours': [moment().subtract('days', 29), moment()],
                        'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
                        'le mois dernier': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    locale: {
                        applyLabel: "Vers l'avant",
                        cancelLabel: 'Annulation',
                        startLabel: 'Date initiale',
                        endLabel: 'Date limite',
                        customRangeLabel: 'SÃ©lectionner une date',
                        // daysOfWeek: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi','Samedi'],
                        daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                        monthNames: ['Janvier', 'fÃ©vrier', 'Mars', 'Avril', 'ÐœÐ°i', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                        firstDay: 1
                    }
                });
            </script>
            <script>
                // MAterial Date picker
                $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
                $('#mdate2').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
                $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
                $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

                $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
                // Clock pickers
                $('#single-input').clockpicker({
                    placement: 'bottom',
                    align: 'left',
                    autoclose: true,
                    'default': 'now'
                });
                $('.clockpicker').clockpicker({
                    donetext: 'Done',
                }).find('input').change(function () {
                    console.log(this.value);
                });
                $('#check-minutes').click(function (e) {
                    // Have to stop propagation here
                    e.stopPropagation();
                    input.clockpicker('show').clockpicker('toggleView', 'minutes');
                });
                if (/mobile/i.test(navigator.userAgent)) {
                    $('input').prop('readOnly', true);
                }
                // Colorpicker
                $(".colorpicker").asColorPicker();
                $(".complex-colorpicker").asColorPicker({
                    mode: 'complex'
                });
                $(".gradient-colorpicker").asColorPicker({
                    mode: 'gradient'
                });
                // Date Picker
                jQuery('.mydatepicker, #datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#date-range').datepicker({
                    toggleActive: true
                });
                jQuery('#datepicker-inline').datepicker({
                    todayHighlight: true
                });
                // Daterange picker
                $('.input-daterange-datepicker').daterangepicker({
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-danger',
                    cancelClass: 'btn-inverse'
                });
                $('.input-daterange-timepicker').daterangepicker({
                    timePicker: true,
                    format: 'MM/DD/YYYY h:mm A',
                    timePickerIncrement: 30,
                    timePicker12Hour: true,
                    timePickerSeconds: false,
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-danger',
                    cancelClass: 'btn-inverse'
                });
                $('.input-limit-datepicker').daterangepicker({
                    format: 'MM/DD/YYYY',
                    minDate: '06/01/2015',
                    maxDate: '06/30/2015',
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-danger',
                    cancelClass: 'btn-inverse',
                    dateLimit: {
                        days: 6
                    }
                });
            </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>