@extends('layouts.conquer')
@section('title')
ADD DATA KABUPATEN
@endsection

@section('content')
<h3 class="page-title">
  Tambah Data Penyebaran COVID-19
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{ url('kabupaten') }}">Peta Penyebaran</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Add</a>
        </li>
    </ul>
</div>

KABUPATEN
<div class="row">
  <div class="col-md-8">
    <div id="map" style="height: 720px">
        <div id="rumahpeta" style="background-color: red; height: 720px;">
          ini adalah rumah peta
        </div>
    </div>
  </div>
  <div class="col-md-4">
    <!-- isi form -->
    <form role="form" method="POST" action="" enctype="multipart/form-data">
      <div class="form-body">

      <div class="form-group">
          <label for="jenis">Jenis COVID-19</label>
          <select class="form-control" id="jenis" name="jenis">
            <option value="suspect">Suspect</option>
            <option value="penderita">Penderita</option>
          </select>
        </div>

        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" class="form-control" id='name' name='name' placeholder="isi nama" required>
        </div>

        <div class="form-group">
          <label for="ktp">KTP</label>
          <input type="text" class="form-control" id="ktp" name="ktp" placeholder="isi nomor ktp" required>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control " rows="3" id="alamat" name="alamat" placeholder="isi alamat rumah" required></textarea>
        </div>

        <div class="form-group">
          <label>Foto</label>
          <input type="file" value="" name="foto" class="form-control" id="foto" placeholder="input foto" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required>
        </div>
        <img id="output" src="" width="200px" height="200px">

        <div class="form-group">
          <label for="keluhan">Keluhan Sakit</label>
          <input type="text" class="form-control" id="keluhan" name="keluhan" placeholder="isi keluhan sakit" required>
        </div>

        <div class="form-group">
          <label for="riwayat">Riwayat Perjalanan</label>
          <input type="text" class="form-control" id="riwayat" name="riwayat" placeholder="isi riwayat perjalanan" required>
        </div>

        <div class="form-group">
          <label for="tipe">Tipe</label>
          <select class="form-control" id="tipe" name="tipe">
            <option value="point">Point</option>
            <option value="linestring">Line String</option>
            <option value="polygon">Polygon</option>
          </select>
        </div>

        <div class="form-group">
          <label for="geom">Geom</label>
          <textarea class="form-control " rows="3" id="geom" name="geom" placeholder="geom koordinat" readonly required></textarea>
        </div>

      </div>
      <div class="form-actions">
        <button type="submit"  onclick="simpan_geom();" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  //                        view awal (    center view     ) zoom level(makin kecil makin jauh)
  var map=L.map('rumahpeta').setView([-1.303833, 117.859810], 5);

  //membuat layer dasar (base layer), linknya sudah paten
  var osm=L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {});                                       
  var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{ maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3'] });
  var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{ maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3'] });
  var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3']});
  //add to div rumah peta  
  osm.addTo(map);

  //pengaturan visibility dan choose option
  var baseMaps = {
    "OpenStreetMap": osm,
    "Google Street":googleStreets,
    "Google Satellite": googleSat,
    "googleHybrid":googleHybrid
  };

  @foreach($data as $d)
    var kab_id_{{ $d->id }}= L.marker([ {{ $d->y }} ,{{ $d->x }}]).bindPopup("TESSSS");
    // kab_id_{{ $d->id }}.addTo(map);
  @endforeach

  //DRAW CONTROL
  var drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems); 
  map.addControl(new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        poly: {
        allowIntersection: false
        }
    },
    draw: {
        polygon: {
        allowIntersection: false,
        showArea: true
        }
    }
  }));

  
  //AMBIL KOORDINAT DARI CONTROL DRAW
  map.on(L.Draw.Event.CREATED, function (e) {
    drawnItems.eachLayer(function(layer) { map.removeLayer(layer);});
    var type = e.layerType;
    var layer = e.layer; 

    var shape = layer.toGeoJSON();
    var shape_for_db = JSON.stringify(shape);
    var x = JSON.parse(shape_for_db);
    console.log(x);

    var res = "";
    if (x['geometry']['type'] == "Point") {
    $('#tipe').val('point'); //untuk mengganti combobox
    res = "POINT("; 
    res += x['geometry']['coordinates'][0] + " " + x['geometry']['coordinates'][1];
    res += ")";
    } else if (x['geometry']['type'] == "LineString") {
    $('#tipe').val('linestring'); //untuk mengganti combobox
    res = "LINESTRING(";
    for ( var i = 0; i < x['geometry']['coordinates'].length; i++ ) {
        if(i == 0) {
        res += x['geometry']['coordinates'][i][0] + " " + x['geometry']['coordinates'][i][1];
        } else {
        res += "," + x['geometry']['coordinates'][i][0] + " " + x['geometry']['coordinates'][i][1];
        }
    }
    res += ")";
    } else if (x['geometry']['type'] == "Polygon") {
    $('#tipe').val('polygon'); //untuk mengganti combobox
    res = "POLYGON((";
    for ( var i = 0; i < x['geometry']['coordinates'][0].length; i++ ) {
        if(i == 0) {
            res += x['geometry']['coordinates'][0][i][0] + " " + x['geometry']['coordinates'][0][i][1];
        } else {
            res += "," + x['geometry']['coordinates'][0][i][0] + " " + x['geometry']['coordinates'][0][i][1];
        }
    }
    res += "," + x['geometry']['coordinates'][0][0][0] + " " + x['geometry']['coordinates'][0][0][1];
    res += "))";
    }
    document.getElementById("geom").value = res;
    drawnItems.addLayer(layer);
  });

  //panggil geojson
  var kabupaten = L.geoJson.ajax("{{ asset('res_leaflet/indonesia_kab.geojson') }}").addTo(map);

  L.control.layers(baseMaps).addTo(map);
</script>
@endsection