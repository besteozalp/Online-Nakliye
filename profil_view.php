@section('content')
<section class="ortayazi">
  <div class="container">
    <div class="card border-0">
      <div class="row">
         <div class="col-md-3">
            @get('profilsol')
        </div>
        <div class="col-md-9">
            <div class="card" style="margin-top:50px;">
              <h5 class="card-header">Kişisel Bilgiler</h5>
              <div class="card-body">
                {{? {{durum}}==1}} 
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> Profil başarıyla güncellendi.
                </div>
                {{endif}}
                {{? {{durum}}==0}}
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-warning"></i> Herhangi bir güncelleme yapılmadı.
                </div>
                {{endif}}   
                  <form action="#" id="" role="form" data-toggle="validator" method="post" accept-charset="utf-8">
                      {{__token}}
                  <div id="" role="form" data-toggle="validator">
                            <div class="form-group">
                            <label for="adi">Adı:</label>
                            <input type="text" class="form-control" name="adi" id="adi" placeholder="Adı" value="{{bilgiler->adi}}" required>
                            <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label for="soyadi">Soyadi:</label>
                            <input type="text" class="form-control" name="soyadi" id="soyadi" placeholder="Soyadı" value="{{bilgiler->soyadi}}" required>
                            <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                            <label for="cinsiyet">Cinsiyet:</label>
                            <select name="cinsiyet" id="cinsiyet" class="form-control">
                                <option value="0" {{{bilgiler->cinsiyet==0}}:selected}>Kadın</option>
                                <option value="1" {{{bilgiler->cinsiyet==1}}:selected}>Erkek</option>
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="dogumyili">Doğum Yılı:</label>
                            <input type="number" class="form-control" name="dogumyil" id="dogumyili" value="{{bilgiler->dogumyil}}" placeholder="Doğum Yılı" min="1900" max="2018" required>
                            <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                            <label for="telefon">Telefon:</label>
                            <input type="text" class="form-control" name="telefon" id="dogumyili" value="{{bilgiler->telefon}}" placeholder="Telefon" required>
                            <div class="help-block with-errors"></div>
                            </div>
                            <input name="submit" type="submit" class="btn btn-success pull-right" value="Düzenle" />
                  </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@sectionend


