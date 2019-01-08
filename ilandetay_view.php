@section('content')
<section class="ortayazi">
  <div class="container">
	<div class="card" style="margin-top:20px; margin-bottom:10px;">
    	<div class="card-header">Kalkış Yeri > Varış Yeri İlan Detayları</div>
            <div class="card-body">
                {{? {{durum}}==1}}
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> Teklifiniz başarıyla ilan sahibine iletildi.
                </div>
                {{endif}}
                {{? {{durum}}==0}}
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> Teklifiniz iletilemedi.
                </div>
                {{endif}}
                <div class="row">
                    <div class="col-3">
                    <div class="pull-left">
                        <img src="{{bilgiler->resim}}" class="img-thumbnail rounded-circle" style="width:60px; height:60px;" /><span class="caret"></span>
                    </div>
                    <div class="text-center" style=" height:100%; line-height:16px; padding-top:15px; border-right:1px solid; border-right-color:#D5BCBC;">
                        <b>{{bilgiler->adi}}</b><br />
                        {{bilgiler->yas}} yaşında
                    </div>
                    </div>
                    <div class="col-6">
                         <div class="text-center" style=" height:100%; line-height:16px; padding-top:15px;  border-right:1px solid; border-right-color:#D5BCBC;">
                        <b>{{bilgiler->tarih}}</b><br />
                        {{nereden}} > {{nereye}}
                        </div>
                    </div>
                    <div class="col-3">
                         <div class="text-center" style=" height:100%; line-height:16px; padding-top:5px;">
                        <b>Fiyat (kg)</b><br />
                        <h3>{{bilgiler->fiyat}} TL</h3>
                        </div>
                    </div>
                </div>
        	</div>
    	</div>
        <div class="card">
        	<div class="card-body">
                <div class="row">
                    <div class="col-8">
                    	<b class="ozellik"><i class="fa fa-phone-square"></i>  Telefon</b>: {{bilgiler->telefon}}</br>
                    	<b class="ozellik"><i class="fa fa-truck"></i>  Araç Tipi</b>: {{bilgiler->aractipi}} </br>
                        <b class="ozellik"><i class="fa fa-list"></i>  Açıklama</b>: {{bilgiler->aciklama}}
                    </div>
                    <div id="rezerve" class="col-4 text-center">
                        {{? {{kendiilani}}!=1 and {{login}}==1}}
                        <form method="POST" action="?id={{bilgiler->nakliye_id}}">
                        {{__token}}
                    	<h3><i class="fa fa-cubes"></i> {{bilgiler->kapasite}} kg</h3>
                        <input id="k" name="k" type="hidden" value="{{bilgiler->kapasite}}" ></input>
                    	<input id="kapasite" name="kapasite" type="number" class="form-control form-control-lg text-right" placeholder="kg">
                    	<input id="rezerveb" type="submit" class="btn btn-success" style="font-size:25px;padding-right:15px;padding-left:15px; margin-top:10px;" value="Rezerve Et">
                        </form>
                        {{endif}}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@sectionend


@section('head')
<link href="{{SITE_URL}}/template/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <style>
    .ozellik {
                    display:inline-block;
                    width:140px;
                    line-height:30px;
            }
            #rezerve input {
                    width:200px;
                    display:block;
                    margin-left: auto;
                     margin-right: auto;

            }
    </style>
@sectionend

@section('js')
<script>
$(document).ready(function (e) {
    $('#rezerveb').prop('disabled', true);
    $( "#kapasite" ).keyup(function() {
        var kapasite1=parseInt($("#k").val());
        var kapasite2= parseInt($("#kapasite").val());
        if(kapasite1 < kapasite2 | kapasite2<1) {
            kapasite2= parseInt($("#kapasite").val());
            $('#rezerveb').prop('disabled', true);
        } else {
            kapasite2= parseInt($("#kapasite").val());
            $('#rezerveb').prop('disabled', false);
        }
    });
});
</script>
@sectionend