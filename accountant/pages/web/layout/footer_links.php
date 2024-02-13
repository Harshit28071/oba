<script src="../../../theme/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../../theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../../theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../../theme/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../../theme/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="../../../theme/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../../theme/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="../../../theme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../../theme/plugins/moment/moment.min.js"></script>
<script src="../../../theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../../theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../../theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../../theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../theme/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../../theme/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- DataTables  & Plugins -->
<script src="../../../theme/dist/js/pages/dashboard.js"></script>
<script src="../../../theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../theme/plugins/jszip/jszip.min.js"></script>
<script src="../../../theme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../theme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../../../theme/bootbox.all.min.js"></script>
<!-- Toaster message-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  function sortTable(n, id, type) {
    debugger;
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(id);
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc";
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /* Check if the two rows should switch place,
        based on the direction, asc or desc: */
        if (dir == "asc") {
          switch (type) {
            case "string":
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;

              }
              break;
            case "date":
              let d1 = new Date(x.innerHTML);
              let d2 = new Date(y.innerHTML);
              if (d1 > d2) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;

              }
              break;
            case "number":
              if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;

              }
              break;
          }
          if (shouldSwitch) {
            break;
          }
        } else if (dir == "desc") {
          switch (type) {
            case "string":
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                
              }
              break;
            case "date":
              let d1 = new Date(x.innerHTML);
              let d2 = new Date(y.innerHTML);
              if (d1 < d2) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                
              }
              break;
            case "number":
              if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
               
              }
              break;
          }
          if(shouldSwitch){
            break;
          }
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Each time a switch is done, increase this count by 1:
        switchcount++;
      } else {
        /* If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again. */
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  function redirect(link){
    localStorage.clear();
    window.location.href=link;
  }
</script>