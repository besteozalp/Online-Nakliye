<?php

class Site extends Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        @session_start(); //modelleri ilk başta almadığımızdan burada kullanıyoruz.
    }
    
    public function giris() {
        $data['login']  = 0;
        $data['yetki']  = 0;
        if(isset($_SESSION['kullanici_adi'])) {
            die('<meta http-equiv="refresh" content="0;URL=\''.SITE_URL.'\'" /> ');
        }
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Giris");
        $data["durum"] = -1;
        if(isset($_POST['submit'])) {
            $kullanici_adi  = $this->controlREQ($_REQUEST['kullanici_adi']);
            $sifre          = $this->controlREQ($_REQUEST['sifre']);
            $data["durum"] = $m->kontrol($kullanici_adi,md5($sifre));
        }
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "Giriş - ".$data["sitebilgileri"]["title"];
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("giris",$data);

    }
    
    public function cikisyap() {
        $data['login']  = 1;
        $data['yetki']  = 0;
        session_destroy();
        die('<meta http-equiv="refresh" content="0;URL=\''.SITE_URL.'\'" /> ');
        
    }
    
    public function index() {
        $data['login']  = 0;
        $data['yetki']  = 0;
        $data['bildirim'] = 0;
        $m = $this->load->model("Index");
        if(isset($_SESSION['kullanici_adi'])){
            $data['kullanici_adi']     = $_SESSION['kullanici_adi'];
            $data['id']     = $_SESSION['id'];
            $data['yetki']  = $_SESSION['yetki'];
            $data['login']  = 1;
            $data['profil_resmi'] = $m->profil_resmi($data['id']);
            $data['bildirim'] = $m->bildirim($data['id']);
        }
        $data['SITE_URL']   = SITE_URL;
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "Anasayfa - ".$data["sitebilgileri"]["title"];
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("index",$data);

        //$this->load->view("index",$data);
        
    }
    public function ilandetay() {
        $data['login']  = 0;
        $data['yetki']  = 0;
        $data['bildirim'] = 0;
        $m = $this->load->model("IlanDetay");
        if(isset($_SESSION['kullanici_adi'])){
            $data['kullanici_adi']     = $_SESSION['kullanici_adi'];
            $data['id']     = $_SESSION['id'];
            $data['yetki']  = $_SESSION['yetki'];
            $data['login']  = 1;
            $data['profil_resmi'] = $m->profil_resmi($data['id']);
            $data['bildirim'] = $m->bildirim($data['id']);
        }else {
            die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        }   
        $data['SITE_URL']   = SITE_URL;
        if(!isset($_GET['id'])) die("Geçersiz istek");
        $id                 = (integer) $this->controlREQ($_REQUEST['id']);
        
        $data['bilgiler']   = $m->getir($id);
        if(sizeof($data['bilgiler'])<6) die("Böyle bir ilan yok!");
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"]      = $data['bilgiler']['nereden_il_id']." - ".$data['bilgiler']['nereden_ilce_id'].
                                " > ".$data['bilgiler']['nereye_il_id']." - ".$data['bilgiler']['nereye_ilce_id']." İlan Detayı - ".$data["sitebilgileri"]["title"];
        $data["nereden"]    = $data['bilgiler']['nereden_il_id']." - ".$data['bilgiler']['nereden_ilce_id'];
        $data["nereye"]    = $data['bilgiler']['nereye_il_id']." - ".$data['bilgiler']['nereye_ilce_id'];
        $data["kendiilani"] = ($data['bilgiler']['kullanici_id'] == $data["id"]) ? 1 : 0;
        $data['durum']      = -1;
        if(isset($_POST['kapasite']) and $data['login']==1) {
            $kapasite = (integer) $this->controlREQ($_REQUEST['kapasite']);
            $ilan_id        = $id;
            $gonderen_id    = $data['id'];
            $alan_id        = $data['bilgiler']['kullanici_id'];
            $data['durum']  = $m->teklifver($ilan_id,$alan_id,$gonderen_id,$kapasite);
        }
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("ilandetay",$data);
    }
    public function ilanlistesi() {
        $data['login']  = 0;
        $data['yetki']  = 0;
        $data['bildirim'] = 0;
        $m = $this->load->model("IlanListesi");
        if(isset($_SESSION['kullanici_adi'])){
            $data['kullanici_adi']     = $_SESSION['kullanici_adi'];
            $data['id']     = $_SESSION['id'];
            $data['yetki']  = $_SESSION['yetki'];
            $data['login']  = 1;
            $data['profil_resmi'] = $m->profil_resmi($data['id']);
            $data['bildirim'] = $m->bildirim($data['id']);
        }
        $data['SITE_URL']   = SITE_URL;
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "İlan Listesi - ".$data["sitebilgileri"]["title"];
        
        $tarih              = (isset($_REQUEST['tarih']))?$this->controlREQ($_REQUEST['tarih']):"";
        $nereden            = (isset($_REQUEST['nereden']))?$this->controlREQ($_REQUEST['nereden']):"";
        $nereye             = (isset($_REQUEST['nereye']))?$this->controlREQ($_REQUEST['nereye']):"";
        $data['tarih'] = $tarih;
        $data['nereden'] = $nereden;
        $data['nereye'] = $nereye;
        $data['kisi'] = 0; 
        if(isset($_REQUEST['sil'])) {
                $data['sil'] = $m->sil( (integer) $this->controlREQ($_REQUEST['sil']));
                die('<meta http-equiv="refresh" content="0;URL=\'ilanlistesi?kisi\'" /> ');
        }
        // kendi ilanları için
        if(isset($_REQUEST['kisi'])) {
                $data['liste'] = $m->kisigetir($data['id']);
                $data['baslik'] = "Sizin vermiş olduğunuz ilanlar";
                $data['durum'] = 0;
                $data['kisi'] = 1;
        } else {
            if($tarih!="" or $nereden!="" or $nereden!="") {
                $data['liste'] = $m->getir(urldecode($tarih),urldecode($nereden),urldecode($nereye));
                if($data['liste']==FALSE) {
                    $data['durum'] = 1;
                } else {
                    $data['durum'] = 0;
                }
                $data['baslik'] = "$tarih tarihli $nereden > $nereye Nakliye İlanları";
                
                
                
            } else {
                $data['baslik'] = "Arama kriterleri hatalı";
                $data['durum'] = 1;
                $data['liste'] = array();
            }
        }

        
        
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("ilanlistesi",$data);

        //$this->load->view("index",$data);
        
    }
    public function ilanver() {
        if(!isset($_SESSION['kullanici_adi'])) {
            die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        }
        $m = $this->load->model("IlanVer");
        
        $data['yetki']          = $_SESSION['yetki'];
        $data['id']             = $_SESSION['id'];
        $data['bilgiler']       = $m->getir($data['id']);
        $data['arac_id']        = $data['bilgiler']['arac_id'];
        $data['profil_resmi']   = $m->profil_resmi($data['id']);
        $data['login']          = 1;
        $data['SITE_URL']       = SITE_URL;
        $data['bildirim'] = $m->bildirim($data['id']);

        $data["durum"] = -1;
        
        if(isset($_POST['submit'])) {
            
            $kullanici_id  = $data['id'];
            $arac_id        = $_SESSION['arac_id'];
            $nereden        = $this->controlREQ($_REQUEST['nereden']);
            $nereye         = $this->controlREQ($_REQUEST['nereye']);
            $tarih          = $this->controlREQ($_REQUEST['tarih']);
            $kapasite       = $this->controlREQ($_REQUEST['kapasite']);
            $fiyat          = $this->controlREQ($_REQUEST['fiyat']);
            $aciklama       = $this->controlREQ($_REQUEST['aciklama']);
            if($nereden!="" and $nereye!="" and $tarih!="" and $kapasite!="" and $fiyat!="") {
                $data["durum"]      = $m->ekle($kullanici_id,$arac_id,$nereden,$nereye,$tarih,$kapasite,$fiyat,$aciklama);
            } else {
                $data["durum"]      = 2;
            }
            
        }
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "İlan Ver - ".$data["sitebilgileri"]["title"];
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("ilanver",$data);
    }
    
    public function lokasyoncek() {
        if(!isset($_GET['lokasyon'])) die('');
        $m = $this->load->model("LokasyonCek");
        $lokasyon = $this->controlREQ(urldecode($_GET['lokasyon']));
        $secim = $this->controlREQ(urldecode($_GET['secim']));
        $m->lokasyoncek($lokasyon, $secim);
    }
    
    public function kayit() {
        $data['login']  = 0;
        $data['yetki']  = 0;
        if(isset($_SESSION['kullanici_adi'])) die('<meta http-equiv="refresh" content="0;URL=\''.SITE_URL.'\'" /> ');
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Kayit");
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "Kayıt - ".$data["sitebilgileri"]["title"];
        $durum = 0;
        $data["aractipi"] = $m->aracTipi();
        if(isset($_POST['kullanici_adi'])) {
            $kullanici_adi  = $this->controlREQ($_REQUEST['kullanici_adi']);
            $mail           = $this->controlREQ($_REQUEST['mail']);
            $sifre          = $this->controlREQ($_REQUEST['sifre']);
            $adi            = $this->controlREQ($_REQUEST['adi']);
            $soyadi         = $this->controlREQ($_REQUEST['soyadi']);
            $cinsiyet       = $this->controlREQ($_REQUEST['cinsiyet']);
            $dogumyil       = $this->controlREQ($_REQUEST['dogumyil']);
            $adres          = $this->controlREQ($_REQUEST['adres']);
            $arac_id        = $this->controlREQ($_REQUEST['arac_id']);
            $telefon        = $this->controlREQ($_REQUEST['telefon']);
            if($kullanici_adi!="" and $mail!="" and $sifre!="" and $adi!=""
                     and $soyadi!="" and $cinsiyet!="" and $dogumyil!="" and $adres!=""
                     and $arac_id!="" and $telefon!="") {
                $durum = $m->ekle($kullanici_adi,$mail,md5($sifre),$adi,$soyadi,$cinsiyet,$dogumyil,$adres,$arac_id,$telefon);
            } else {
                $durum = 3;
            }
        }
        $data['durum'] = $durum;
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("kayit",$data);
    }   
    public function resimYukle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if(isset($_POST['id'])) {
            $id = $this->controlREQ($_REQUEST['id']);
            $m = $this->load->model("ResimYukle");
            $m->yukle($id);
        }
    }
    public function profil() {
        if(!isset($_SESSION['kullanici_adi'])) {
            die('<meta http-equiv="refresh" content="0;URL=\''.SITE_URL.'\'" /> ');
        }
        $m = $this->load->model("Profil");
        $data['yetki']          = $_SESSION['yetki'];
        $data['id']             = $_SESSION['id'];
        $data['bilgiler']       = $m->getir($data['id']);
        $data['profil_resmi']   = $m->profil_resmi($data['id']);
        $data['login']          = 1;
        $data['SITE_URL']       = SITE_URL;
        $data['bildirim'] = $m->bildirim($data['id']);

        $data["durum"] = -1;
        if(isset($_POST['submit'])) {
            $kullanici_adi  = $this->controlREQ($_REQUEST['kullanici_adi']);
            $mail           = $this->controlREQ($_REQUEST['mail']);
            $sifre          = $this->controlREQ($_REQUEST['sifre']);
            $adi            = $this->controlREQ($_REQUEST['adi']);
            $soyadi         = $this->controlREQ($_REQUEST['soyadi']);
            $cinsiyet       = $this->controlREQ($_REQUEST['cinsiyet']);
            $dogumyil       = $this->controlREQ($_REQUEST['dogumyil']);
            $adres          = $this->controlREQ($_REQUEST['adres']);
            $arac_id        = $this->controlREQ($_REQUEST['arac_id']);
            $aktif          = $this->controlREQ($_REQUEST['aktif']);
            $telefon        = $this->controlREQ($_REQUEST['telefon']);

            $id             =  $_SESSION['id'];
            $kullanici_adi   = ($kullanici_adi=='') ? $_SESSION['kullanici_adi'] : $kullanici_adi;
            $mail           = ($mail=='') ? $_SESSION['mail'] : $mail;
            $sifre          = ($sifre=='') ? $_SESSION['sifre'] : md5($sifre);
            $adi            = ($adi=='') ? $_SESSION['adi'] : $adi;
            $soyadi         = ($soyadi=='') ? $_SESSION['soyadi'] : $soyadi;
            $cinsiyet       = ($cinsiyet=='') ? $_SESSION['cinsiyet'] : $cinsiyet;
            $dogumyil       = ($dogumyil=='') ? $_SESSION['dogumyil'] : $dogumyil;
            $adres          = ($adres=='') ? $_SESSION['adres'] : $adres;
            $arac_id        = ($arac_id=='') ? $_SESSION['arac_id'] : $arac_id;
            $aktif          = ($aktif=='') ? $_SESSION['aktif'] : $aktif;
            $telefon        = ($telefon=='') ? $_SESSION['telefon'] : $telefon;

            $data["durum"]      = $m->guncelle($id,$kullanici_adi,$sifre,$adi,$soyadi,$cinsiyet,$dogumyil,$telefon,$mail,$adres,$arac_id,$aktif);
            if($data["durum"]==1) {
                $_SESSION['sifre'] = $sifre;
                $_SESSION['adi'] = $adi;
                $_SESSION['soyadi'] = $soyadi;
                $_SESSION['cinsiyet'] = $cinsiyet;
                $_SESSION['dogumyil'] = $dogumyil;
                $_SESSION['adres'] = $adres;
                $_SESSION['arac_id'] = $arac_id;
                $_SESSION['aktif'] = $aktif;
                $_SESSION['telefon'] = $telefon;
            }
            $data['bilgiler']   = $m->getir($data['id']);
        }
        $data["sitebilgileri"] = $m->sitebilgileri();
        $data["title"] = "Profil - ".$data["sitebilgileri"]["title"];
        $this->load->viewAdd("template",$data);
        $this->load->viewAdd("profilsol",$data);
        if(isset($_GET['alan'])) {
            switch ($_GET['alan']) {
                case "fotograf": $this->load->viewAdd("profil_fotograf",$data);
                    break;
                case "arac": 
                    $data["aractipi"] = $m->aracTipi();
                    $this->load->viewAdd("profil_arac",$data);
                    break;
                case "bildirimler": 
                    if(isset($_GET['kabul'])) $m->kabul((integer)$_GET['kabul'],$data['id']);
                    if(isset($_GET['red'])) $m->red((integer)$_GET['red'],$data['id']);
                    $bildirimler = $m->bildirimler($data['id']);
                    $data["bekleyengelenteklifler"] = $bildirimler["bekleyengelenteklifler"];
                    $data["kabulgelenteklifler"]    = $bildirimler["kabulgelenteklifler"];
                    $data["redgelenteklifler"]      = $bildirimler["redgelenteklifler"];
                    $data["kabultekliflerim"]       = $bildirimler["kabultekliflerim"];
                    $data["redtekliflerim"]         = $bildirimler["redtekliflerim"];
                    $this->load->viewAdd("profil_bildirimler",$data);
                    break;    
                case "sifre": $this->load->viewAdd("profil_sifre",$data);
                    break; 
                case "sil": $this->load->viewAdd("profil_sil",$data);
                    break; 
                
                default: $this->load->viewAdd("profil",$data);
                    break;
            }
        }else {
            $this->load->viewAdd("profil",$data);
        }


    }
}
   
?>