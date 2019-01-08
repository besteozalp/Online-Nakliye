@section('content')
<section class="login">
  <div class="container">
      <div class="row">
      	<div class="col-md-8 offset-md-2">
             <div class="card" style="margin-top:50px;">
              <div class="card-header text-center"><i class="fa fa-comment-o"></i>  <strong>Zaten üye misiniz?</strong></div>
              <div class="card-body">
                <div id="accordion">
                  <div class="card">
                    <div id="headingOne">
                        <button class="btn btn-link w-100 text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fa fa-sign-in"></i>  Evet, giriş yap
                        </button>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                            {{? {{durum}}==0}}
                            <div class=" mt-2 alert alert-danger  mb-3" role="alert">
                                <i class="fa fa-warning"></i> Kullanıcı Adı/Şifre Hatalı!
                            </div>
                            {{endif}}  
                            <form class="form-auth-small" action="?" method="post">
                                {{__token}}
                              <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><span class="fa fa-user"></span>  Kullanıcı Adı</span>
                              </div>
                              <input name="kullanici_adi" type="text" class="form-control" placeholder="Kullanıcı Adı" value="">
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><span class="fa fa-lock"></span>  Şifre</span>
                              </div>
                              <input name="sifre" type="password" class="form-control" placeholder="Şifre" value="">
                            </div>  
                            <a href="#" class="btn pull-left">Şifremi Unuttum</a>  
                            <button name="submit" type="submit" class="btn btn-success pull-right" style="margin-bottom:7px;"><i class="fa fa-user-o"></i>  Giriş Yap</button>
                            </form>
                      </div>
                    </div>
                  </div>
                  <div class="card" style="padding:11px; margin-top:5px;">
                  <a class="btn-btn-link" href="kayit"><i class="fa fa-user-plus"></i>  Hayır, kaydol</a>
                  </div>

                </div>

              </div>
            </div>
      	</div>
      </div>
  </div>
</section>
@sectionend


@section('head')
<style>
	
	.login {
		margin-bottom: 100px;
	}
	
    .input-group-text {
        min-width:118px; 
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