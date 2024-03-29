@extends('layouts.conquer')
@section('title')
DATA COVID-19
@endsection

@section('content')
<h3 class="page-title">
  Inventarisasi Penyebaran COVID-19
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="/">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Peta Penyebaran</a>
        </li>
    </ul>

    <div class="page-toolbar">
    @can('modify-permission')
      <a href="{{ url('datacovid19/create') }}" class="btn btn-success btn-sm">Add Data</a>
    @endcan
    </div>
</div>

@if (session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if (session('error'))
  <div class="note note-danger">{{ session('error') }}</div>
@endif

<div id="rumahpeta" style="background-color: red; height: 720px; border: 1px solid black;">
    ini adalah rumah peta
</div>

@can('modify-permission')
<table class="table" id="myTable">
    <thead>
      <tr>
        <th>Id</th>
        <th>Jenis</th>
        <th>Nama</th>
        <th>Nomor KTP</th>
        <th>Alamat</th>
        <th>Keluhan Sakit</th>
        <th>Riwayat Perjalanan</th>
        <th>Lokasi Karantina</th>
        <th>Foto</th>
        <th>Detail</th>
        @can('modify-permission')
        <th>Edit</th>
        <th>Delete</th>
        @endcan
      </tr>
    </thead>
    <tbody>
    	@foreach($data as $d)
      <tr id="tr_{{ $d->id }}">
        <td>{{$d->id}}</td>
        <td>{{$d->jenis}}</td>
        <td>{{$d->nama}}</td>
        <td>{{$d->ktp}}</td>
        <td>{{$d->alamat}}</td>
        <td>{{$d->keluhan_sakit}}</td>
        <td>{{$d->riwayat_perjalanan}}</td>
        <td>{{$d->kabupaten->nama_kab}}</td>
        <td><img src="{{asset('res/foto_covid/'.$d->foto)}}" height='100px' width='100px'/></td>
        <td>
          <a class='btn btn-info btn-xs' href="{{route('datacovid19.show',$d->id)}}" data-target="#show{{$d->id}}" data-toggle='modal'>Detail</a>        
          <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
               <!-- put animated gif here -->
               <img src="{{ asset('res/loading.gif') }}">
              </div>
            </div>
          </div>
        </td>
        <td><a href="{{ url('datacovid19/'.$d->id.'/edit') }}" class="btn btn-xs btn-warning">Edit</a></td>
        <td>
          <form role="form" method="POST" action="{{ url('datacovid19/'.$d->id) }}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-xs btn-danger" onclick="if(!confirm('are you sure to delete this record ?')) return false">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endcan

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

  //STYLE BUFFER
  function styleBufferCovid(feature){
    return {
      fillColor: "purple",
      weight:0,
      fillOpacity:0.5
    };
  }

  var PointDataCovid19 = L.layerGroup([]);
  var BufferDataCovid19 = L.layerGroup([]);

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

  //BUFFER
  var point_id_{{ $d->id }} = turf.point([<?php echo str_replace("(", "", str_replace(")","", preg_replace('/\s+/', ',', substr($d->geom,5)))); ?>]);
  var buffered_id_{{ $d->id }} = turf.buffer(point_id_{{ $d->id }}, 2, {units: 'kilometers'});
  var bufferHasil_id_{{ $d->id }} = L.geoJson(buffered_id_{{ $d->id }}, {style: styleBufferCovid}).addTo(map);
  BufferDataCovid19.addLayer(bufferHasil_id_{{ $d->id }});
  @endforeach

  //TAMPILKAN LAYER GROUP DI MAP
  @can('modify-permission')
  PointDataCovid19.addTo(map);
  BufferDataCovid19.addTo(map);
  @endcan

  
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
    "Buffer Lokasi Covid-19 2km" : BufferDataCovid19,
    "Polygon Warna Kabupaten" : kabupaten
  }

  L.Control.geocoder().addTo(map);

  L.control.layers(baseMaps, @can('modify-permission')grup_layer @endcan).addTo(map);
</script>
@endsection