<?php

class Panel extends Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        @session_start(); //modelleri ilk başta almadığımızdan burada kullanıyoruz.
    }
    
    public function giris() {
        if(isset($_SESSION['yetki'])) {
            if($_SESSION['yetki']==1) {
                die('<meta http-equiv="refresh" content="0;URL=\'index\'" /> ');
            }
        }
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/Giris");
        $data["durum"] = -1;
        if(isset($_POST['submit'])) {
            $kullanici_adi  = $this->controlREQ($_REQUEST['kullanici_adi']);
            $sifre          = $this->controlREQ($_REQUEST['sifre']);
            $data["durum"] = $m->kontrol($kullanici_adi,md5($sifre));
        }
        $data["title"] = "Yönetim - Giriş Ekranı";
        $this->load->viewAdd("Panel/giris",$data);

    }
    
    public function cikisyap() {
        session_destroy();
        die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        
    }
    
    public function index() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/Index");
        $data['bilgiler'] = $m->getir();
        $data["title"] = "Anasayfa - Yönetim Paneli";
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/index",$data);

        //$this->load->view("index",$data);
        
    }

    
    public function NakliyeListesi() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/NakliyeListesi");
        $data["title"] = "Nakliye Listesi - Yönetim Paneli";
        $data['durum'] = -1;
        if(isset($_GET['sil'])) {
            $data['durum'] = $m->sil((integer)$_GET['sil']);
        } 
        $data['liste'] = $m->listele();
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/nakliyelistesi",$data);
    }
    
    public function siteAyarlari() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/SiteAyarlari");
        $data['durum'] = -1; 
        if(isset($_POST['submit'])) {
                $title          = $this->controlREQ($_REQUEST['title']);
                $facebook       = $this->controlREQ($_REQUEST['facebook']);
                $twitter        = $this->controlREQ($_REQUEST['twitter']);
                $instagram      = $this->controlREQ($_REQUEST['instagram']);
                $data['durum']  = $m->guncelle($title,$facebook,$twitter,$instagram);

        }
        $data['bilgiler'] = $m->getir();
        $data["title"] = "Site Ayarları - Yönetim Paneli";
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/siteayarlari",$data);
    }    
    
    public function NakliyeDuzenle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/NakliyeDuzenle");
        $data["title"] = "Nakliye Düzenle - Yönetim Paneli";
        if(isset($_GET['id'])) {
            $id = (integer)$_GET['id'];
            $data['bilgiler']   = $m->getir($id);
            $data['durum']      = -1;
            if(isset($_POST['submit'])) {
                $kullanici_id   = $this->controlREQ($_REQUEST['kullanici_id']);
                $arac_id        = $this->controlREQ($_REQUEST['arac_id']);
                $nereden_il_id  = $this->controlREQ($_REQUEST['nereden_il_id']);
                $nereden_ilce_id= $this->controlREQ($_REQUEST['nereden_ilce_id']);
                $nereye_il_id   = $this->controlREQ($_REQUEST['nereye_il_id']);
                $nereye_ilce_id = $this->controlREQ($_REQUEST['nereye_ilce_id']);
                $tarih          = $this->controlREQ($_REQUEST['tarih']);
                $kapasite       = $this->controlREQ($_REQUEST['kapasite']);
                $fiyat          = $this->controlREQ($_REQUEST['fiyat']);
                $aciklama       = $this->controlREQ($_REQUEST['aciklama']);
                $data['durum']  = $m->guncelle($id,$kullanici_id,$arac_id,$nereden_il_id,$nereden_ilce_id,$nereye_il_id,$nereye_ilce_id,$tarih,$kapasite,$fiyat,$aciklama);
                if($data['durum']==1) { // güncelleme başarılıyla yeni bilgileri verelim.
                    $data['bilgiler']['kullanici_id'] = $kullanici_id;
                    $data['bilgiler']['arac_id'] = $arac_id;
                    $data['bilgiler']['nereden_il_id'] = $nereden_il_id;
                    $data['bilgiler']['nereden_ilce_id'] = $nereden_ilce_id;
                    $data['bilgiler']['nereye_il_id'] = $nereye_il_id;
                    $data['bilgiler']['nereye_ilce_id'] = $nereye_ilce_id;
                    $data['bilgiler']['tarih'] = $tarih;
                    $data['bilgiler']['kapasite'] = $kapasite;
                    $data['bilgiler']['fiyat'] = $fiyat;
                    $data['bilgiler']['aciklama'] = $aciklama;
                    

                }
            }
        } else {
            die("düzenlenecek id bilgisine ulaşılamadı.");
        }
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/nakliyeduzenle",$data);
    }
    
    public function AracTipiEkle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/AracTipiEkle");
        $data["title"] = "Araç Tipi Ekle - Yönetim Paneli";
        $durum = 0;
        if(isset($_POST['submit'])) {
            $aractipi  = $this->controlREQ($_REQUEST['aractipi']);
            $uzunluk    = $this->controlREQ($_REQUEST['uzunluk']);
            $genislik   = $this->controlREQ($_REQUEST['genislik']);
            $yukseklik  = $this->controlREQ($_REQUEST['yukseklik']);
            $m3         = $this->controlREQ($_REQUEST['m3']);
            if($aractipi!="" and $uzunluk!="" and $genislik!="" and $yukseklik!="" and $m3!="") {
                $durum = $m->ekle($aractipi,$uzunluk,$genislik,$yukseklik,$m3);
            } else {
                $durum = 3;
            }
        }
        $data['durum'] = $durum;
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/aractipiekle",$data);
    }    

    public function AracTipiListesi() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/AracTipiListesi");
        $data["title"] = "Araç Tipi Listesi - Yönetim Paneli";
        $data['durum'] = -1;
        if(isset($_GET['sil'])) {
            $data['durum'] = $m->sil((integer)$_GET['sil']);
        } 
        $data['liste'] = $m->listele();
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/aractipilistesi",$data);
    }

    public function AracTipiDuzenle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/AracTipiDuzenle");
        $data["title"] = "Araç Tipi Duzenle - Yönetim Paneli";
        if(isset($_GET['id'])) {
            $id = (integer)$_GET['id'];
            $data['bilgiler']   = $m->getir($id);
            $data['durum']      = -1;
            if(isset($_POST['submit'])) {
                $aractipi  = $this->controlREQ($_REQUEST['aractipi']);
                $uzunluk    = $this->controlREQ($_REQUEST['uzunluk']);
                $genislik   = $this->controlREQ($_REQUEST['genislik']);
                $yukseklik  = $this->controlREQ($_REQUEST['yukseklik']);
                $m3         = $this->controlREQ($_REQUEST['m3']);
                $data['durum'] = $m->guncelle($id,$aractipi,$uzunluk,$genislik,$yukseklik,$m3);
                if($data['durum']==1) { // güncelleme başarılıyla yeni bilgileri verelim.
                    $data['bilgiler']['aractipi'] = $aractipi;
                    $data['bilgiler']['uzunluk'] = $uzunluk;
                    $data['bilgiler']['genislik'] = $genislik;
                    $data['bilgiler']['yukseklik'] = $yukseklik;
                    $data['bilgiler']['m3'] = $m3;
                }
            }
        } else {
            die("düzenlenecek id bilgisine ulaşılamadı.");
        }
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/aractipiduzenle",$data);
    }
    
    public function kullaniciekle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/KullaniciEkle");
        $data["title"] = "Kullanıcı Ekle - Yönetim Paneli";
        $durum = 0;
        if(isset($_POST['submit'])) {
            $kullanici_adi  = $this->controlREQ($_REQUEST['kullanici_adi']);
            $mail           = $this->controlREQ($_REQUEST['mail']);
            $sifre          = $this->controlREQ($_REQUEST['sifre']);
            $yetki          = $this->controlREQ($_REQUEST['yetki']);
            if($kullanici_adi!="" and $mail!="" and $sifre!="" and $yetki!="") {
                $durum = $m->ekle($kullanici_adi,$sifre,$mail,$yetki);
            } else {
                $durum = 3;
            }
        }
        $data['durum'] = $durum;
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/kullaniciekle",$data);
    }    
    
    public function kullaniciListesi() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/KullaniciListesi");
        $data["title"] = "Kullanıcı Listesi - Yönetim Paneli";
        $data['durum'] = -1;
        if(isset($_GET['sil'])) {
            $data['durum'] = $m->sil((integer)$_GET['sil']);
        } 
        $data['liste'] = $m->listele();
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/kullanicilistesi",$data);
    }
    
    public function resimYukle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        if(isset($_POST['id'])) {
            $id = $this->controlREQ($_REQUEST['id']);
            $m = $this->load->model("ResimYukle");
            $m->yukle($id);
        }
    }
    
    public function kullaniciDuzenle() {
        if(!isset($_SESSION['yetki'])) die('<meta http-equiv="refresh" content="0;URL=\'giris\'" /> ');
        if($_SESSION['yetki']!=1) die('yetkisiz giriş');
        $data['kullanici'] = $_SESSION['kullanici_adi'];
        $data['SITE_URL']   = SITE_URL;
        $m = $this->load->model("Panel/KullaniciDuzenle");
        $data["title"] = "Kullanıcı Duzenle - Yönetim Paneli";
        if(isset($_GET['id'])) {
            $id = (integer)$_GET['id'];
            $data['bilgiler']   = $m->getir($id);
            $data['profil_resmi']   = $m->profil_resmi($id);
            $data['durum']      = -1;
            if(isset($_POST['submit'])) {
                $eskiSifre = $data['bilgiler']['sifre'];
                $kullanici_adi = $this->controlREQ($_REQUEST['kullanici_adi']);
                $sifre = $this->controlREQ($_REQUEST['sifre']);
                $sifre = ($sifre=="")?$eskiSifre:md5($sifre);
                $adi = $this->controlREQ($_REQUEST['adi']);
                $soyadi = $this->controlREQ($_REQUEST['soyadi']);
                $cinsiyet = $this->controlREQ($_REQUEST['cinsiyet']);
                $dogumyil = $this->controlREQ($_REQUEST['dogumyil']);
                $telefon = $this->controlREQ($_REQUEST['telefon']);
                $mail = $this->controlREQ($_REQUEST['mail']);
                $adres = $this->controlREQ($_REQUEST['adres']);
                $yetki = $this->controlREQ($_REQUEST['yetki']);
                $data['durum'] = $m->guncelle($id,$kullanici_adi,$sifre,$adi,$soyadi,$cinsiyet,$dogumyil,$telefon,$mail,$adres,$yetki);
                if($data['durum']==1) { // güncelleme başarılıyla yeni bilgileri verelim.
                    $data['bilgiler']['kullanici_adi'] = $kullanici_adi;
                    $data['bilgiler']['sifre'] = $sifre;
                    $data['bilgiler']['adi'] = $adi;
                    $data['bilgiler']['soyadi'] = $soyadi;
                    $data['bilgiler']['cinsiyet'] = $cinsiyet;
                    $data['bilgiler']['dogumyil'] = $dogumyil;
                    $data['bilgiler']['telefon'] = $telefon;
                    $data['bilgiler']['mail'] = $mail;
                    $data['bilgiler']['adres'] = $adres;
                    $data['bilgiler']['yetki'] = $yetki;
                }
            }
        } else {
            die("düzenlenecek id bilgisine ulaşılamadı.");
        }
        $this->load->viewAdd("Panel/template",$data);
        $this->load->viewAdd("Panel/kullaniciduzenle",$data);
    }
    
   
}
    
?>