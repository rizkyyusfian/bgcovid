@extends('layouts.conquer')
@section('title')
KABUPATEN
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
      <a href="{{ url('kabupaten/create') }}" class="btn btn-success btn-sm">Add</a>
      <a href="" class="btn btn-info btn-sm">Edit (?)</a>
      <a href="" class="btn btn-danger btn-sm">Delete (?)</a>
    </div>
</div>

KABUPATEN
<div id="rumahpeta" style="background-color: red; height: 720px;">
    ini adalah rumah peta
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
  kab_id_{{ $d->id }}.addTo(map);
@endforeach



L.control.layers(baseMaps).addTo(map);

</script>
@endsection