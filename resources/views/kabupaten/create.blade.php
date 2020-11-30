@extends('layouts.conquer')
@section('title')
ADD DATA
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
    <form class="form" method="post" action="#">
      <div class="form-body">
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" class="form-control" id='name' name='name' placeholder="Type your name" required>
        </div>

        <div class="form-group">
          <label for="ket">Keterangan</label>
          <input type="text" class="form-control" id="ket" name="ket" required>
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
    // googleStreets.addTo(map);

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
        $('#tipe').val('line'); //untuk mengganti combobox
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



    L.control.layers(baseMaps).addTo(map);
</script>
@endsection