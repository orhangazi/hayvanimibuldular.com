<?php
/**
 * Created by PhpStorm.
 * User: Orhan Gazi
 * Date: 31.12.2016
 * Time: 00:10
 */
include "baglan.php";

$hb_no_uret = $_POST['hb-no-uret'];

$bilgileri_kaydet = $_POST['bilgileri_kaydet'];
if($bilgileri_kaydet){
	$sahip_tel = mysqli_real_escape_string($baglan,$_POST['telefon']);
	$sahip_adi = mysqli_real_escape_string($baglan,$_POST['isim']);
	$sahip_eposta = mysqli_real_escape_string($baglan,$_POST['eposta']);
	$facebook = mysqli_real_escape_string($baglan,$_POST['facebook']);
	$twitter = mysqli_real_escape_string($baglan,$_POST['twitter']);
	$instagram = mysqli_real_escape_string($baglan,$_POST['instagram']);
	$googleplus = mysqli_real_escape_string($baglan,$_POST['googleplus']);
	$sahip_adres = mysqli_real_escape_string($baglan,$_POST['adres']);
	$hb_no = mysqli_real_escape_string($baglan,$_POST['hb_no']);

	if($hb_no==""){
		do{
			$rastgele_sayi = rand(100000,999999);
			$kontrol_et_sql = mysqli_query($baglan,"select id from hayvan_bilgileri where hb_no='$rastgele_sayi'");
		}
		while(mysqli_num_rows($kontrol_et_sql)>0);

		if(!empty($sahip_eposta)){
			$kaydet_sql = mysqli_query($baglan,"insert into hayvan_bilgileri(hb_no,sahip_tel,sahip_adres,sahip_adi,sahip_eposta,facebook,twitter,instagram,googleplus) values('$rastgele_sayi','$sahip_tel','$sahip_adres','$sahip_adi','$sahip_eposta','$facebook','$twitter','$instagram','$googleplus')");
			if($kaydet_sql){
				$json_dizi = ["mesaj"=>"HB NO: $rastgele_sayi","hata"=>false];
			}else{
				$json_dizi = ["mesaj"=>"hb no kaydedilmedi","hata"=>true];
			}
		}else{
			$json_dizi = ["mesaj"=>"Epostanı girmelisin.","hata"=>true];
		}
	}
	else{
		$duzenle_sql = mysqli_query($baglan,"update hayvan_bilgileri set sahip_adi = '$sahip_adi', sahip_tel = '$sahip_tel', sahip_eposta = '$sahip_eposta', facebook = '$facebook', twitter = '$twitter', instagram = '$instagram', googleplus = '$googleplus', sahip_adres = '$sahip_adres' where hb_no='$hb_no'");
		if($duzenle_sql){
			$json_dizi = ["mesaj"=>"Bilgilerin güncellendi","hata"=>false];
		}
		else{
			$json_dizi = ["mesaj"=>"Bilgilerin güncellenmedi","hata"=>true];
		}
	}
	echo json_encode($json_dizi);
}

//arama yapar
$arama_yap = $_POST['arama_yap'];
if($arama_yap){
	$hb_no = mysqli_real_escape_string($baglan,$_POST['hb_no']);

	$arama_yap_sql = mysqli_query($baglan,"select * from hayvan_bilgileri where hb_no='$hb_no'");

	if(mysqli_num_rows($arama_yap_sql)>0){
		$arama_sonuc = mysqli_fetch_object($arama_yap_sql);
		$sahip_tel = $arama_sonuc->sahip_tel;
		$sahip_adres = $arama_sonuc->sahip_adres;
		$sahip_adi = $arama_sonuc->sahip_adi;
		$sahip_eposta = $arama_sonuc->sahip_eposta;
		$facebook = $arama_sonuc->facebook;
		$twitter = $arama_sonuc->twitter;
		$instagram = $arama_sonuc->instagram;
		$googleplus = $arama_sonuc->googleplus;
		$hb_no = $arama_sonuc->hb_no;

		$json_dizi = ["sahip_tel"=>$sahip_tel,"sahip_adres"=>$sahip_adres,"sahip_adi"=>$sahip_adi,"sahip_eposta"=>$sahip_eposta,"facebook"=>$facebook,"twitter"=>$twitter,"instagram"=>$instagram,"googleplus"=>$googleplus,"hb_no"=>$hb_no,"hata"=>false];
	}else{
		$json_dizi = ["mesaj"=>"Aramada hiçbir bilgi bulunamadı. HB NO'yu kontrol edin.","hata"=>true];
	}
	echo json_encode($json_dizi);
}

$duzenlenecek_kayitlari_goster = $_POST['duzenlenecek_kayitlari_goster'];
if($duzenlenecek_kayitlari_goster){
	$eposta = mysqli_real_escape_string($baglan,$_POST['eposta']);
	//$telefon = mysqli_real_escape_string($baglan,$_POST['telefon']);
	if(!empty($eposta)){
		$kontrol_et_sql = mysqli_query($baglan,"select * from hayvan_bilgileri where sahip_eposta='$eposta'");

		if(mysqli_num_rows($kontrol_et_sql)>0){
			$jumbo = "<div class='jumbotron' style='padding: 30px;'><strong>Yeni kayıt</strong> yapacağın zaman burayı muhakkak kapatmalısın<button type='button' class='close duzenlemeyi-kapat' aria-label='Close'><span aria-hidden='true' style='font-size:40px;top: -11px;position: relative;'>&times;</span></button>";
			$accordion = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
			$liste = "";
			while($bilgiler_nesne = mysqli_fetch_object($kontrol_et_sql)){
				$adi = $bilgiler_nesne->sahip_adi;
				$telefon = $bilgiler_nesne->sahip_tel;
				$eposta = $bilgiler_nesne->sahip_eposta;
				$adres = $bilgiler_nesne->sahip_adres;
				$hb_no = $bilgiler_nesne->hb_no;
				$facebook = $bilgiler_nesne->facebook;
				$twitter = $bilgiler_nesne->twitter;
				$instagram = $bilgiler_nesne->instagram;
				$googleplus = $bilgiler_nesne->googleplus;

				$karekod_dizi = ["adi"=>$adi,
					"telefon"=>$telefon,
					"eposta"=>$eposta,
					"adres"=>$adres,
					"hb_no"=>$hb_no,
					"facebook"=>$facebook,
					"twitter"=>$twitter,
					"instagram"=>$instagram,
					"googleplus"=>$googleplus,
				];

				//json encode için unicode karakterler ve / ı değiştirmemesini söyledim
				$karekod_json = json_encode($karekod_dizi,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

				$karekod_url = "https://chart.googleapis.com/chart?chs=300&cht=qr&chl=$karekod_json&choe=UTF-8";

				$liste .= "<div class='panel panel-default'>
				<div class='panel-heading panel-heading-duzenle' role='tab' id='headingOne'>
				  <h4 class='panel-title pull-left'>
					<a role='button' data-toggle='collapse' data-parent='#accordion' href='#$hb_no' aria-expanded='true' aria-controls='collapseOne'>
						$adi - HB NO: $hb_no
					</a>
				  </h4>
				  <button class='btn btn-success panel-heading-dugme' data-adi='$adi' data-tel='$telefon' data-eposta='$eposta' data-adres='$adres' data-hb-no='$hb_no' data-facebook='$facebook' data-twitter='$twitter' data-instagram='$instagram' data-googleplus='$googleplus'>Düzenle</button>
				</div>
				<div id='$hb_no' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'>
				  <div class='panel-body'>
					<table class='table table-hover'>
						<tr>
							<th>Adı</th>
							<td><span class='adi'>$adi</span></td>
						</tr>
						<tr>
							<th>Telefon num</th>
							<td><span class='telefon'>$telefon</span></td>
						</tr>
						<tr>
							<th>Eposta</th>
							<td><span class='eposta'>$eposta</span></td>
						</tr>
						<tr>
							<th>Adresi</th>
							<td><span class='adres'>$adres</span></td>
						</tr>
						<tr>
							<th>Facebook</th>
							<td><span class='facebook'>$facebook</span></td>
						</tr>
						<tr>
							<th>Twitter</th>
							<td><span class='twitter'>$twitter</span></td>
						</tr>
						<tr>
							<th>İnstagram</th>
							<td><span class='instagram'>$instagram</span></td>
						</tr>
						<tr>
							<th>Google plus</th>
							<td><span class='googleplus'>$googleplus</span></td>
						</tr>
						<tr>
							<th>Kare Kod</th>
							<td><span class='karekod'><img src='$karekod_url' alt='kare kod'></span></td>
						</tr>
					</table>
				  </div>
				</div>
			  </div>";
			}

			$html = $jumbo.$accordion.$liste."</div></div>";

			echo json_encode(["mesaj"=>$html]);
		}else{
			$mesaj = "<div class='panel panel-default'>
				  <div class='panel-body'>bu epostayla eşleşen bir kayıt bulamadık.</div>
				</div>";
			echo json_encode(["mesaj"=>$mesaj]);
		}
	}
	else{
		$mesaj = "<div class='panel panel-default'>
				  <div class='panel-body'>Kayıtlarını bulmak için epostanı girmelisin.</div>
				</div>";
		echo json_encode(["mesaj"=>$mesaj]);
	}
}