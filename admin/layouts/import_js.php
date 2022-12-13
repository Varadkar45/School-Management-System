<!-- jQuery -->
<script src="./admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="./admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="./admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="./admin/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="./admin/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="./admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="./admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="./admin/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="./admin/assets/plugins/moment/moment.min.js"></script>
<script src="./admin/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="./admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="./admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="./admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="./admin/assets/dist/js/adminlte.js"></script>
<!-- Alerts - toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" crossorigin="anonymous"></script>

<!-- DataTables  & Plugins -->
<script src="./admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./admin/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./admin/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./admin/assets/plugins/jszip/jszip.min.js"></script>
<script src="./admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="./admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="./admin/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./admin/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./admin/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- page script -->
<script>
  $(function() {
    $("#dTable").DataTable();

  });
</script>

<!--redirect your own url when clicking browser back button -->
<script>
(function(window, location) {
history.replaceState(null, document.title, location.pathname+"#!/history");
history.pushState(null, document.title, location.pathname);

window.addEventListener("popstate", function() {
  if(location.hash === "#!/history") {
    history.replaceState(null, document.title, location.pathname);
    setTimeout(function(){
      location.replace("index.php");//path to when click back button
    },0);
  }
}, false);
}(window, location));
</script>