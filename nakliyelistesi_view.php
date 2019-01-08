@section('content')
<div class="container-fluid">
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index">Anasayfa</a>
            </li>
            <li class="breadcrumb-item active">
              Nakliye Listesi
            </li>
    </ol>
 
        
        
        
        
<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-truck"></i> Nakliye Listesi</div>
        <div class="card-body">
                                        {{? {{durum}}==1}}
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <i class="fa fa-check-circle"></i> Nakliye başarıyla silinmiştir.
                                        </div>
                                        {{endif}}
                                        {{? {{durum}}==0}}
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <i class="fa fa-warning"></i> Nakliye silme işlemi başarısız.
                                        </div>
                                        {{endif}}     
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tarih</th>
                  <th>Kullanıcı Adı</th>
                  <th>Nereden</th>
                  <th>Nereye</th>
                  <th>Fiyat</th>
                  <th><i class="fa fa-cogs"></i></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Tarih</th>
                  <th>Kullanıcı Adı</th>
                  <th>Nereden</th>
                  <th>Nereye</th>
                  <th>Fiyat</th>
                  <th><i class="fa fa-cogs"></i></th>
                </tr>
              </tfoot>
              <tbody>
    {{@liste}}
                                                        <tr>
                                                                <td>{{v.id}}</td>
                                                                <td>{{v.tarih}}</td>
                                                                <td>{{v.kullanici_adi}}</td>
                                                                <td>{{v.nereden_il_id}} - {{v.nereden_ilce_id}}</td>
                                                                <td>{{v.nereye_il_id}} - {{v.nereye_ilce_id}}</td>
                                                                <td>{{v.fiyat}} TL</td>

                                                            <td class="text-center">
                                                                <a class="btn btn-danger" style="padding:2px 10px 2px 10px;" onclick="sil({{v.id}})" href="#" aria-label="Settings">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                  </a>
                                                                  &nbsp 
                                                                  <a class="btn btn-success"style="padding:2px 10px 2px 10px;" href="nakliyeduzenle?id={{v.id}}" aria-label="Settings">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                </a> 
                                                           </td>
                                                        </tr>
    {{liste@}}
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
        
        
        
        
</div>
@sectionend


@section('head')
@sectionend

@section('js')
<script>
    function sil(id) {
        if (confirm('[ '+id+' ] numaralı nakliyeyi silmek istediğinizden emin misiniz?')) {
            window.location.href="?sil="+id;
        }
    }
</script>
@sectionend