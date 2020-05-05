
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  <!-- datatable -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <!-- end of datatable -->

  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>

  <script>
    var mymap = L.map('mapid').setView([-3.7912139, 119.3971386], 7.5);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(mymap);
  </script>






  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.select2').select2();

      var kab = $('#kab').val();
      var kec = '00';
      var kec = '00';
      var table2 = $('#datatable-slide').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
          "processing": 'Memuat...'
        },
        "serverSide": true,
        "scrollX": true,
        "ajax": "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel,
        "columns": [
          { "data": "DT_RowIndex", "orderable": false, "searchable": false },
          { "data": "IDBDT" },
          { "data": "NIK" },
          { "data": "NAMA" },
          { "data": "KABUPATEN" },
          { "data": "ALAMAT" },
        ],
        "columnDefs": [
          { "className": "text-center", "targets": [0, 4] }
        ],
      });

      $("#kab").change(function () {
        var kab = $('#kab').val();
        var kec = '00';
        var kel = '00';
        url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
        table2.ajax.url(url)
        table2.ajax.reload();
        $("#kec").load('/kecamatan/' + kab);
      });

      $("#kec").change(function () {
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = '00';
        url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
        table2.ajax.url(url)
        table2.ajax.reload();
        $("#kel").load('/kelurahan/' + kec);
      });

      $("#kel").change(function () {
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = $('#kel').val();
        url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
        table2.ajax.url(url)
        table2.ajax.reload();
      });

    });
  </script>


</body>

</html>