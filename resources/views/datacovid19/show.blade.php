<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
  <h4 class="modal-title">{{$data->nama}}</h4>
</div>
<div class="modal-body">           
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>=</th>
        <th>{{$data->id}}</th>
      </tr>
      <tr>
        <th>Nama</th>
        <th>=</th>
        <th>{{$data->nama}}</th>
      </tr>
      <tr>
        <th>Nomor KTP</th>
        <th>=</th>
        <th>{{$data->ktp}}</th>
      </tr>
      <tr>
        <th>Alamat</th>
        <th>=</th>
        <th>{{$data->alamat}}</th>
      </tr>
      <tr>
        <th>Keluhan Sakit</th>
        <th>=</th>
        <th>{{$data->keluhan_sakit}}</th>
      </tr>
      <tr>
        <th>Riwayat Perjalanan</th>
        <th>=</th>
        <th>{{$data->riwayat_perjalanan}}</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
<div class="container">
  <div class="row">
    <div class="col-md-3" style="border: 1px solid black; margin: 5px; padding: 5px; border-radius: 10px;text-align: center; width: 160px; height: 190px;">
        <div class="judul">Foto</div>
        <img src="{{asset('res/foto_covid/'.$data->foto)}}" height="150px" width="150px"><br>
    </div>
  </div>
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>