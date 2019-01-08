@section('content')
<div class="container-fluid">
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index">Anasayfa</a>
            </li>
            <li class="breadcrumb-item active">
              Araç Tipi Ekle
            </li>
    </ol>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Araç Tipi Ekle
              </div>
              <div class="card-body">
                    {{? {{durum}}==1}}
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> Araç tipi başarıyla eklenmiştir.
                    </div>
                    {{endif}}
                    {{? {{durum}}==2}}
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-warning"></i> Var olan araç tipi tekrar eklenemez.
                    </div>
                    {{endif}}                                        
                    {{? {{durum}}==3}}
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-warning"></i> Alanlar boş bırakılamaz.
                    </div>
                    {{endif}}    

                    <form class="form-auth-small" action="?" method="post">
                    {{__token}}
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="kuladi"><span class="fa fa-truck"></span>  Araç Tipi</span>
                      </div>
                      <input name="aractipi" type="text" class="form-control" placeholder="Araç Tipi" value="">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="kuladi"><span class="fa fa-arrows-h"></span>  Uzunluk</span>
                      </div>
                      <input name="uzunluk" type="text" class="form-control" placeholder="Uzunluk" value="">
                    </div>    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="kuladi"><span class="fa fa-arrows"></span>  Genişlik</span>
                      </div>
                      <input name="genislik" type="text" class="form-control" placeholder="Genişlik" value="">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="kuladi"><span class="fa fa-arrows-v"></span>   Yükseklik</span>
                      </div>
                      <input name="yukseklik" type="text" class="form-control" placeholder="Yükseklik" value="">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" id="kuladi"><span class="fa fa-cube"></span>  m3</span>
                      </div>
                      <input name="m3" type="text" class="form-control" placeholder="m3" value="">
                    </div>
                    <button name="submit" type="submit" class="btn btn-success btn-md pull-right" style="margin-top:10px;"><i class="fa fa-truck"></i>+ Ekle</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>    

@sectionend


@section('head')
<style>
    .input-group-text {
        min-width:140px; 
        text-align: left;
        font-size: 14px;
    }
    .input-group input {
        font-size: 14px;
    }
</style>
@sectionend

@section('js')
@sectionend