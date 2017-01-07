<?php
/**
 * Created by PhpStorm.
 * User: Orhan Gazi
 * Date: 30.12.2016
 * Time: 22:08
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="js/islemler.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
	<title>hayvanimibuldular.com</title>
</head>
<body>
<div class="container">
	<h1>Kaybolmuş bir hayvan mı buldun?</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			Eğer tasmasında, küpesinde ya da bilekliğinde <a href="/">hayvanimibuldular.com</a> veya <a href="/">sahibimiara.com</a> ve <strong>hb no</strong>'su varsa hemen hb no ile ara ve sahibine ulaştır. Nasıl büyük bir iyilik yaptığını tahmin bile edemezsin!
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<form class="form-inline" id="arama-formu" style="margin-bottom:20px">
				<div class="input-group">
					<input type="text" class="form-control" id="hb-no" placeholder="HB NO'su ile ara">
					<span class="input-group-btn">
						<button class="btn btn-primary" id="ara"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> ARA</button>
					</span>
				</div>
			</form>
            <div class="jumbotron" style="padding: 30px;">
                <table class="table table-hover">
                    <tr>
                        <th>Adı</th>
                        <td><span class="adi"></span></td>
                    </tr>
                    <tr>
                        <th>Telefon num</th>
                        <td><span class="telefon"></span></td>
                    </tr>
                    <tr>
                        <th>Eposta</th>
                        <td><span class="eposta"></span></td>
                    </tr>
                    <tr>
                        <th>Adresi</th>
                        <td><span class="adres"></span></td>
                    </tr>
                    <tr>
                        <th>Facebook</th>
                        <td><span class="facebook"></span></td>
                    </tr>
                    <tr>
                        <th>Twitter</th>
                        <td><span class="twitter"></span></td>
                    </tr>
                    <tr>
                        <th>İnstagram</th>
                        <td><span class="instagram"></span></td>
                    </tr>
                    <tr>
                        <th>Google plus</th>
                        <td><span class="googleplus"></span></td>
                    </tr>
                    <tr>
                        <th>Kare Kod</th>
                        <td><span class='karekod' id='karekod'></span></td>
                    </tr>
                </table>
            </div>
		</div>
		<div class="col-md-6">
			<blockquote>
				Bilgilerini kaydederek hayvanın için HB no oluştur. HB no'ları benzersizdir ve hayvanın kaybolduğunda bulunmasını sağlayacak. Epostan ile de bilgilerini daha sonra güncelleyebilirsin.
			</blockquote>
            <form>
                <input type="text" class="form-control input-ust" id="isim" placeholder="Adın">
                <input type="email" class="form-control koseleri-duzlestir" id="eposta" placeholder="Epostan">
                <input type="text" class="form-control koseleri-duzlestir" id="telefon" placeholder="Telefon numaran">
                <input type="text" class="form-control koseleri-duzlestir" id="facebook" placeholder="Facebook profil linkin">
                <input type="text" class="form-control koseleri-duzlestir" id="twitter" placeholder="Twitter adın">
                <input type="text" class="form-control koseleri-duzlestir" id="instagram" placeholder="İnstagram adın">
                <input type="text" class="form-control koseleri-duzlestir" id="googleplus" placeholder="Googleplus profil linkin">
                <textarea name="adres" id="adres" class="form-control koseleri-duzlestir" placeholder="Adresin"></textarea>
                <input type="hidden" id="duzenleme-modu-hb-no" value="">
            </form>
            <div class="dugmeler">
                <div class="btn-group" style="width: 100%">
                    <button class="btn btn-success col-md-6 input-alt" id="kaydet">KAYDET</button>
                    <button class="btn btn-success col-md-6 input-alt" id="duzenle">DÜZENLE</button>
                </div>
                <span class="hb-no"></span>
            </div>
            <div class="duzenlenecek-kayitlar"></div>
		</div>
	</div>
</div>
<div class="modal fade bilgilendirme" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kayıtlı HB NO yok</h4>
            </div>
            <div class="modal-body">
                Aradığınız hb no ile kayıtlı bir hayvan yok. Lütfen hb no'sunu kontrol edin.
            </div>
        </div>
    </div>
</div>
</body>
</html>