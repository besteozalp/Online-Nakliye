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
              <h5 class="card-header">Bildirimler</h5>
            <div class="card-body">
                <div class="card">
                	<div class="card-header">Size Gelen Teklifler</div>
                    	<ul class="list-group" style="margin:5px;">
                                    
                            {{@bekleyengelenteklifler}}
                            
                            <li class="list-group-item list-group-item-warning" style="margin:5px;">
                            <span class="tarihh"><i class="fa fa-calendar"></i> <strong>{{v.tarih}}</strong></span>
                            <span class="lokasyonn"> <i class="fa fa-map-marker"></i> <a class="text-muted" href="ilandetay?id={{v.id}}"> {{v.nereden_il_id}} - {{v.nereden_ilce_id}} > {{v.nereye_il_id}} - {{v.nereye_ilce_id}}</a></span>
                            <span class="kabulred"> <i class="fa fa-check"></i><a href="?alan=bildirimler&kabul={{v.teklif_id}}"> Kabul Et</a>    <i class="fa fa-minus-circle"></i><a href="?alan=bildirimler&red={{v.teklif_id}}">  Reddet</a></span>
                            <hr>
                            <span class="tarihh"><i class="fa fa-user-circle"></i> <strong> {{v.gonderen_adi}}</strong> ({{v.gonderen_dogumyil}})</span>
                            <span class="lokasyonn"> <i class="fa fa-cubes"></i> Rezerve Etmek İstediği Miktar: <strong>{{v.teklif_kapasite}} kg</strong></span>
                            <span class="kabulred"> <i class="fa fa-phone-square"></i>  {{v.gonderen_telefon}}</span>
                            </li>
                            {{bekleyengelenteklifler@}}  
                            {{@kabulgelenteklifler}}
                            
                            <li class="list-group-item list-group-item-warning" style="margin:5px;">
                            <span class="tarihh"><i class="fa fa-calendar"></i> <strong>{{v.tarih}}</strong></span>
                            <span class="lokasyonn"> <i class="fa fa-map-marker"></i> <a class="text-muted" href="ilandetay?id={{v.id}}"> {{v.nereden_il_id}} - {{v.nereden_ilce_id}} > {{v.nereye_il_id}} - {{v.nereye_ilce_id}}</a></span>
                            <span class="kabulred"> <i class="fa fa-minus-circle"></i><a href="?alan=bildirimler&red={{v.teklif_id}}">  Reddet</a></span>
                            <hr>
                            <span class="tarihh"><i class="fa fa-user-circle"></i> <strong> {{v.gonderen_adi}}</strong> ({{v.gonderen_dogumyil}})</span>
                            <span class="lokasyonn"> <i class="fa fa-cubes"></i> Rezerve Etmek İstediği Miktar: <strong>{{v.teklif_kapasite}} kg</strong></span>
                            <span class="kabulred"> <i class="fa fa-phone-square"></i>  {{v.gonderen_telefon}}</span>
                            </li>
                            {{kabulgelenteklifler@}} 

                        </ul>
                </div>
                <div class="card">
                	<div class="card-header">Kabul Edilen Teklifleriniz</div>
                    	<ul class="list-group" style="margin:5px;">
                            {{@kabultekliflerim}}
                        	<li class="list-group-item list-group-item-info" style="margin:5px;">
                            <span class="tarihh"><i class="fa fa-calendar"></i> <strong>{{v.tarih}}</strong></span>
                            <span class="lokasyonn"> <i class="fa fa-map-marker"></i> <a class="text-muted" href="ilandetay?id={{v.id}}"> {{v.nereden_il_id}} - {{v.nereden_ilce_id}} > {{v.nereye_il_id}} - {{v.nereye_ilce_id}}</a></span>

                            </li>
                            {{kabultekliflerim@}} 
                            
                        </ul>
                </div>
                <div class="card">
                	<div class="card-header">Red Edilen Teklifleriniz</div>
                    	<ul class="list-group" style="margin:5px;">
                            {{@redtekliflerim}}
                            <li class="list-group-item list-group-item-secondary" style="margin:5px;">
                            <span class="tarihh"><i class="fa fa-calendar"></i> <strong>{{v.tarih}}</strong></span>
                            <span class="lokasyonn"> <i class="fa fa-map-marker"></i> <a class="text-muted" href="ilandetay?id={{v.id}}"> {{v.nereden_il_id}} - {{v.nereden_ilce_id}} > {{v.nereye_il_id}} - {{v.nereye_ilce_id}}</a></span>

                            </li>
                            {{redtekliflerim@}} 
                        </ul>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
@sectionend


