<?php
$cek    = $user->row();
$id_user = $cek->id_user;
$nama    = $cek->nama_lengkap;
$level   = $cek->level;

$tgl = date('m-Y');
?>

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat bg-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <center>Selamat Datang, <?php echo ucwords($nama); ?></center>
          </h3>
        </div>
      </div>
      <!-- /basic datatable -->
      <?php if ($level == 'petugas pasar') : ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-12">
                <div class="panel bg-teal-400">
                  <div class="panel-body">
                    <div class="heading-elements">
                      <span class="heading-text"></span>
                    </div>
                    <h3 class="no-margin">
                      <center>
                        <?php
                        $thn_ini = date('Y');
                        $this->db->like('tgl_pedagang', $thn_ini, 'after');
                        echo number_format($this->db->get('tbl_pedagang')->num_rows(), 0, ",", "."); ?>
                    </h3>
                    </center>
                    <center>
                      Pedagang yang mendaftar Tahun <?php echo $thn_ini; ?>
                    </center>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>

        <?php if ($web_ppg->status_ppg == 'buka') { ?>
          <div class="alert alert-info alert-dismissible" role="alert">
            <form action="" method="post">
              <button type="submit" name="btnnonaktif" class="btn btn-primary" onclick="return confirm('Anda Yakin?')"><i class="icon-laptop"></i> Tutup Pendaftaran PPG Online!</button>
              <strong>Status Pendaftaran PPG Online</strong> masih dibuka. Terakhir diubah <?php echo date('d-m-Y H:i:s', strtotime($web_ppg->tgl_diubah)); ?>.
            </form>
          </div>
        <?php } else { ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <form action="" method="post">
              <button type="submit" name="btnaktif" class="btn btn-warning" onclick="return confirm('Anda Yakin?')"><i class="icon-laptop"></i> Buka Pendaftaran PPG Online!</button>
              <strong>Status Pendaftaran PPG Online</strong> masih ditutup. Terakhir diubah <?php echo date('d-m-Y H:i:s', strtotime($web_ppg->tgl_diubah)); ?>.
            </form>
          </div>
      <?php }
      endif; ?>

    </div>
    <!-- /dashboard content -->
    <div class="row">
      <div class="panel panel-flat col-md-12">
        <div class="panel-body">
          <fieldset class="content-group">
            <legend class="text-bold"><i class="icon-pin"></i> Peta Informasi Zona Wilayah Kecamatan Baleendah</legend>
            <div id="mapid"></div>
          </fieldset>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="<?= base_url() ?>assets/leaflet.ajax.js"></script>
    <script>
      var mymap = L.map('mapid').setView([-7.0121636, 107.633879], 13);
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/light-v9',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
      }).addTo(mymap);
      var p = 0;
      var n = 0;
      var id = '';

      function getColor(d) {
        return d == 2 ? '#ff0000' :
          // d < 0.5 ? '#BD0026' :
          // d > 0.5 ? '#E31A1C' :
          // d > 0.3 ? '#FC4E2A' :
          // d > 0.1 ? '#FD8D3C' :
          '#009933';
      }

      // control that shows state info on hover
      var info = L.control();

      info.onAdd = function(mymap) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
      };

      info.update = function(props) {
        this._div.innerHTML = '<h4>KECAMATAN BALEENDAH</h4>' + (props ?
          '<b> Kelurahan ' + props.NAME_4 + '</b>' :
          'Geser mouse pada peta untuk mendapatkan informasi Nama Kelurahan');
      };

      info.addTo(mymap);

      function popUp(f, layer) {
        var out = [];
        if (f.properties) {
          // // out.push(key + ": " + f.properties[key]);
          // out.push("Provinsi : " + f.properties['NAME_1']);
          // out.push("Kota : " + f.properties['NAME_2']);
          // out.push("Kecamatan : " + f.properties['NAME_3']);
          // out.push("Kelurahan / Desa : " + f.properties['NAME_4']);
          // out.push("Positif : " + p);
          // out.push("Negatif : " + n);
          // out.push(id);
          // layer.bindPopup(out.join("<br />"));
          layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight
          });
        }
      }

      function style(nilai) {
        return {
          fillColor: getColor(nilai),
          weight: 2,
          opacity: 1,
          color: 'white',
          dashArray: '3',
          fillOpacity: 1
        };
      }


      function highlightFeature(e) {
        var layer = e.target;

        // layer.setStyle({
        //     weight: 5,
        //     color: '#ddd',
        //     dashArray: '1',
        //     fillOpacity: 1
        // });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
          layer.bringToFront();
        }
        info.update(layer.feature.properties);
      }


      var geojson;

      function resetHighlight(e) {
        // geojson.resetStyle(e.target);
        info.update();
      }

      function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
      }

      mymap.createPane('labels');

      // This pane is above markers but below popups
      mymap.getPane('labels').style.zIndex = 650;

      // Layers in this pane are non-interactive and do not obscure mouse/touch events
      mymap.getPane('labels').style.pointerEvents = 'none';

      var cartodbAttribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attribution">CARTO</a>';

      var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
        attribution: cartodbAttribution
      }).addTo(mymap);

      var positronLabels = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
        attribution: cartodbAttribution,
        pane: 'labels'
      }).addTo(mymap);


      <?php
      foreach ($kelurahan as $k) :
      ?>
        p = <?= $k->positif_kelurahan ?>;
        n = <?= $k->negatif_kelurahan ?>;
        id = "<a href='<?= $k->id_kelurahan ?>' class='btn btn-sm btn-primary'>Daftar </a>";
        geojson = new L.GeoJSON.AJAX(['assets/<?= $k->file_geo_kelurahan ?>'], {
          style: style(<?= $k->nilai_kmeans_kelurahan ?>),
          onEachFeature: popUp
        }).addTo(mymap).bindPopup('Kelurahan : <?= $k->nama_kelurahan ?> <br> Kasus Positif : <?= $k->positif_kelurahan ?> Orang <br> Kasus Negatif : <?= $k->negatif_kelurahan ?> Orang');
        geojson.eachLayer(function(layer) {
          layer.bindPopup(layer.feature.properties.NAME_4);
        });
      <?php
      endforeach;
      ?>
      var legend = L.control({
        position: 'bottomright'
      });

      legend.onAdd = function(mymap) {

        var div = L.DomUtil.create('div', 'info legend'),
          grades = [0, 1],
          labels = [],
          from, to;

        for (var i = 0; i < grades.length; i++) {
          from = i + 1;

          if (from == 1) {
            labels.push(
              '<i style="background:' + getColor(from) + '"></i> Zona Hijau<br>');
          } else {
            labels.push(
              '<i style="background:' + getColor(from) + '"></i> Zona Merah<br>');
          }
        }

        div.innerHTML = labels.join('<br>');
        return div;
      };

      legend.addTo(mymap);
    </script>