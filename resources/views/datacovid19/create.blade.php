@extends('layouts.conquer')
@section('title')
ADD DATA COVID-19
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
            <a href="{{ url('datacovid19') }}">Peta Penyebaran</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Add</a>
        </li>
    </ul>
</div>

DATA COVID-19
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
    <form role="form" method="POST" action="{{ url('datacovid19') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-body">

      <div class="form-group">
          <label for="jenis">Jenis COVID-19</label>
          <select class="form-control" id="jenis" name="jenis">
            <option value="">Choose :</option>
            <option value="suspect">Suspect</option>
            <option value="penderita">Penderita</option>
          </select>
        </div>

        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id='nama' name='nama' placeholder="isi nama" required>
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
          <label for="kabupaten">Kabupaten/Kota</label>
          <select class="form-control" id="kabupaten" name="kabupaten">
            <option value="">Choose :</option>
            @foreach($kab as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kab }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="geom">Geom</label>
          <textarea class="form-control " rows="3" id="geom" name="geom" placeholder="geom koordinat" readonly required></textarea>
        </div>

      </div>
      <div class="form-actions">
        <button type="submit"  onclick="simpan_geom();" class="btn btn-success">Submit</button>
        <a href="{{ url('datacovid19') }}" class="btn btn-default">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  //view awal (    center view     ) zoom level(makin kecil makin jauh)
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

  //ICON
  var IconSuspect = L.icon({
    iconUrl: "{{ asset('icons_leaflet/health-medical.png') }}",
    iconSize: [30, 40],
    iconAnchor: [15, 40],
  });
  var IconPenderita = L.icon({
    iconUrl: "{{ asset('icons_leaflet/toys-store.png') }}",
    iconSize: [30, 40],
    iconAnchor: [15, 40],
  });

  var PointDataCovid19 = L.layerGroup([]);

  //TAMPILKAN DATA POINT MASTER_COVID19
  @foreach($data as $d)
  //CREATE WKT POINT
  var pasien_id_{{ $d->id }} = '{{ $d->geom }}';
  var wkt = new Wkt.Wkt();
  wkt.read(pasien_id_{{ $d->id }});

  var point_pasien_id_{{ $d->id }}
  var jenis = '{{$d->jenis}}';
  if(jenis == 'suspect')
  {
    point_pasien_id_{{ $d->id }} = wkt.toObject({icon: IconSuspect});
  } else if(jenis == 'penderita') {
    point_pasien_id_{{ $d->id }} = wkt.toObject({icon: IconPenderita});
  }
  @can('modify-permission')
  point_pasien_id_{{ $d->id }}.addTo(map);

  //WKT POPUP ON CLICK
  point_pasien_id_{{ $d->id }}.on('click', function (e) { 
    var pop = L.popup();
    pop.setLatLng(e.latlng);
    pop.setContent("<div><div style='text-align:center; font-weight: bold; font-size: 16px;'>{{$d->nama}}<br><img src='{{asset('res/foto_covid/'.$d->foto)}}' height='150px' width='125px'></div><br><div><b>Informasi Tambahan</b><br><b>Jenis : </b>{{$d->jenis}}<br><b>No. KTP : </b>{{$d->ktp}}<br><b>Alamat : </b>{{$d->alamat}}<br><b>Keluhan Sakit : </b>{{$d->keluhan_sakit}}<br><b>Riwayat Perjalanan : </b>{{$d->riwayat_perjalanan}}<br><b>Kabupaten : </b>{{$d->kabupaten->nama_kab}}</div></div>");
    map.openPopup(pop);
  });
  @endcan
  PointDataCovid19.addLayer(point_pasien_id_{{ $d->id }}); //MASUKKAN KE DALAM LAYER GRUP
  @endforeach

  //TAMPILKAN LAYER GROUP DI MAP
  @can('modify-permission')
  PointDataCovid19.addTo(map);
  @endcan



  //DRAW CONTROL
  var drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems); 
  map.addControl(new L.Control.Draw({
    draw: {
      polyline: false,
      polygon: false,
      circle: false,
      rectangle: false,
      marker: true
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

    //KOORDINAT MARKER (POINT)
    var res = "";
    if (x['geometry']['type'] == "Point") 
    {
      res = "POINT("; 
      res += x['geometry']['coordinates'][0] + " " + x['geometry']['coordinates'][1];
      res += ")";
    }
    document.getElementById("geom").value = res;
    drawnItems.addLayer(layer);
  });


  //GEOJSON INDONESIA_KAB
  //fungsi untuk warna
  function warnagradasi(feature) {
    @foreach($datajumlah as $j)
    if('{{$j->nama_kab}}' == feature.properties.NAMA_KAB) {
      if({{$j->jumlah}} == 0) {
        return {weight:1, color:'black', fillColor:"green",fillOpacity:0.5 };
      }
      else if ({{$j->jumlah}} > 0 && {{$j->jumlah}} <=3) {
        return {weight:1, color:'black', fillColor:"yellow",fillOpacity:0.5 };
      } else if ({{$j->jumlah}} > 3) {
        return {weight:1, color:'black', fillColor:"red",fillOpacity:0.5 };
      }
    }
    @endforeach
    else {
      return {weight:1, color:'black', fillColor:"green",fillOpacity:0.5 };
    }
  }

  //fungsi ppopup detail
  function popupdetail(feature,layer) {
    @foreach($datajumlah as $j)
    if('{{$j->nama_kab}}' == feature.properties.NAMA_KAB) {
      return layer.bindPopup("Kabupaten : "+ feature.properties.NAMA_KAB + "<br>Jumlah Pengidap: {{$j->jumlah}}");
    }
    @endforeach
    else if ('{{$j->nama_kab}}' != feature.properties.NAMA_KAB) {
      return layer.bindPopup("Kabupaten : "+ feature.properties.NAMA_KAB + "<br>Jumlah Pengidap: 0");
    }
  }
  //PANGGIL GEOJSON
  var kabupaten = L.geoJson.ajax("{{ asset('res_leaflet/indonesia_kab.geojson') }}",{style:warnagradasi,onEachFeature:popupdetail}).addTo(map);

  var grup_layer = {
    "Point Lokasi Covid-19" : PointDataCovid19,
    "Polygon Warna Kabupaten" : kabupaten
  }
  L.control.layers(baseMaps, @can('modify-permission')grup_layer @endcan).addTo(map);
</script>
@endsection