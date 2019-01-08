@section('content')
<section class="ortayazi">
  <div class="container">
    <div class="card border-0">
      <div class="row">
         <div class="col-md-3">
            <div class="card" style="margin-top:50px;">
              <div class="card-header">
                Arama Detayı
              </div>
              <div class="card-body">
                  <form method="get" action="?">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" style="background-color:#FFFFFF; border-right:0px;" id=""><span class="fa fa-map-marker"></span></span>
                          </div>
                            <input id="nereden" name="nereden" autocomplete="off" type="text" class="form-control" style="border-left:0px;" placeholder="Kalkış Yeri" value="{{nereden}}">
                            <div id="nereden-box" class="rounded bg-light"></div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" style="background-color:#FFFFFF; border-right:0px;" id=""><span class="fa fa-map-marker"></span></span>
                          </div>
                            <input id="nereye" name="nereye" autocomplete="off" type="text" class="form-control" style="border-left:0px;" placeholder="Varış Noktası" value="{{nereye}}">
                            <div id="nereye-box" class="rounded bg-light"></div>                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" style="background-color:#FFFFFF; border-right:0px;" id=""><span class="fa fa-calendar-check-o"></span></span>
                          </div>
                            <input name="tarih" type="text" class="form-control datepicker-here" data-language='tr' style="border-left:0px;" placeholder="Tarih" value="{{tarih}}">
                        </div>
                  <button type="submit" class="btn btn-info w-100">Ara</button>
                  </form>
             </div>
            </div>
            
        </div>
        <div class="col-md-9">
            <div class="card" style="margin-top:50px;">
              <div class="card-header">
                {{baslik}}
              </div>
              <div class="card-body">
                  
                                        {{? {{durum}}==1}}
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <i class="fa fa-warning"></i> Herhangi bir sonuç bulunamamıştır, lütfen tekrar arayınız...
                                        </div>
                                        {{endif}}    
    {{@liste}}
                    
                    <div class="card" style="margin-bottom:20px;">
                            <div class="card-body cardx">
                            <div class="row">
                                <div class="col-3">
                                <div class="pull-left">
                                        <img src="{{v.resim}}" class="img-thumbnail rounded-circle" style="width:60px; height:60px;" /><span class="caret"></span>
                                </div>
                                <div class="text-center" style=" height:100%; line-height:16px; padding-top:15px; border-right:1px solid; border-right-color:#D5BCBC;">
                                        <b>{{v.adi}}</b><br />
                                    {{v.yas}}
                                </div>
                                </div>
                                
                                <div class="col-6">
                                    <a href="ilandetay?id={{v.id}}">
                                     <div class="text-center" style=" height:100%; line-height:16px; padding-top:15px;  border-right:1px solid; border-right-color:#D5BCBC;">
                                        <b>{{v.tarih}}</b><br />
                                    {{v.nereden_il_id}}, {{v.nereden_ilce_id}} > {{v.nereye_il_id}}, {{v.nereye_ilce_id}}
                                        </div>
                                    </a>
                                </div>
                                    
                                <div class="col-3">
                                     <div class="text-center" style=" height:100%; line-height:16px; padding-top:5px;">
                                         {{? {{kisi}}==1}}
                                        <a class="btn btn-danger pull-right" style="padding:2px 10px 2px 10px; color: #FFFFFF;" onclick="sil({{v.id}})" href="#" aria-label="Settings">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                         {{endif}}
                                    <b>Fiyat (kg)</b><br />
                                    <h3>{{v.fiyat}} TL</h3>
                                   
                                        </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    
    {{liste@}}                

                
                
                
                
                
                
                
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
        .card-body a {
            color: #002752;
        }
        .card-body a:Hover {
            text-decoration: none;
            color: #005cbf;
        }
        .cardx:Hover {
            background-color: #FBF8F8;
        }
        .card-body input {
            font-size:14px;
            padding-top: 10px;
            padding-bottom: 7px;
            
        }
        #nereden-box, #nereye-box  {
            position: absolute;
            display: block;
            width: 210px;
            z-index: 1;
            font-size: 14px;
            line-height: 20px;
            background-color: #FFFFFF;
            color: #004085;
            border: 1px solid;
            border-color: #002752;
            padding-top: 10px;
        }
        #nereden-box li, #nereye-box li {
            text-align: left;
            list-style: none;
            padding: 0;
        }
        #nereden-box li:Hover, #nereye-box li:Hover {
            background-color: #8ad5f4;
        }
    </style>
    </style>
@sectionend

@section('js')
<script src="{{SITE_URL}}/template/js/datepicker.min.js"></script>
<script src="{{SITE_URL}}/template/js/i18n/datepicker.tr.js"></script>
<script>
function getOffset(el) {
  el = el.getBoundingClientRect();
  return {
    left: el.left + window.scrollX,
    top: el.top + window.scrollY,
    width: el.width,
    height: el.height
  }
}
$(document).ready(function(){
        $("#nereden-box").hide();
        $("#nereye-box").hide();
	$("#nereden").keyup(function(){
		$.ajax({
		type: "GET",
		url: "lokasyoncek",
		data:'lokasyon='+$(this).val()+'&secim=secNereden',
		beforeSend: function(){
			$("#nereden").css("background","#FFF url(img/yukleniyor.gif) 97% 50% no-repeat");
		},
		success: function(data){
                        var neredenbox = document.getElementById("nereden");
                        var neredenbox1 = document.getElementById("nereden1");
                        $("#nereden-box").css("top",getOffset(neredenbox).height+2);
                        //$("#nereden-box").css("left",getOffset(neredenbox).width+getOffset(neredenbox1).width);
			$("#nereden-box").show();
			$("#nereden-box").html(data);
			$("#nereden").css("background","#FFF");
		}
		});
	});
	$("#nereye").keyup(function(){
		$.ajax({
		type: "GET",
		url: "lokasyoncek",
		data:'lokasyon='+$(this).val()+'&secim=secNereye',
		beforeSend: function(){
			$("#nereye").css("background","#FFF url(img/yukleniyor.gif) 97% 50% no-repeat");
		},
		success: function(data){
                        var neredenbox = document.getElementById("nereden");
                        var neredenbox1 = document.getElementById("nereden1");
                        $("#nereye-box").css("top",getOffset(neredenbox).height+2);
                        //$("#nereye-box").css("left",getOffset(neredenbox).width+getOffset(neredenbox1).width);
			$("#nereye-box").show();
			$("#nereye-box").html(data);
			$("#nereye").css("background","#FFF");
		}
		});
	});
});
//To select country name
function secNereden(val) {
$("#nereden").val(val);
$("#nereden-box").hide();
}    
function secNereye(val) {
$("#nereye").val(val);
$("#nereye-box").hide();
}  
    
 $('.datepicker-here').datepicker({
     autoClose: true,
     position: "bottom left"
 });
</script>

<script>
    function sil(id) {
        if (confirm('[ '+id+' ] id`li ilanı silmek istediğinizden emin misiniz?')) {
            window.location.href="?sil="+id;
        }
    }
</script>
@sectionend