/**
 * Created by Orhan Gazi on 31.12.2016.
 */
$(function(){
    //////////////////////////////////////////////////////
    //hayvanların bilgilerini kadeder/düzenler ve hb no oluşturur//
    //////////////////////////////////////////////////////
    $("#kaydet").click(function () {
        veriler = {
            "bilgileri_kaydet":true,
            "isim":$("#isim").val(),
            "telefon":$("#telefon").val(),
            "eposta":$("#eposta").val(),
            "facebook":$("#facebook").val(),
            "twitter":$("#twitter").val(),
            "instagram":$("#instagram").val(),
            "googleplus":$("#googleplus").val(),
            "adres":$("#adres").val(),
            "hb_no":$("#duzenleme-modu-hb-no").val()
        };

        $.ajax({
            url: "php/islemler.php",
            type: 'post',
            dataType: 'json',
            data: veriler,
            beforeSend:function () {
                $(".hb-no").html("<img src='img/bekleniyor.gif' class='bekleniyor'>");
            }
        }).done(function(data) {
            console.log(data);
            $(".hb-no").html(data.mesaj);
        }).fail(function(data) {
            console.log("error",data);
        });
    });

    //hb no ile arama yapar
    $("#arama-formu").submit(function (e) {
        e.preventDefault();
        veriler = {
            "arama_yap":true,
            "hb_no":$("#hb-no").val()
        };

        $.ajax({
            url: "php/islemler.php",
            type: 'post',
            dataType: 'json',
            data: veriler
        }).done(function(data) {
            console.log(data);
            if(!data.hata){
                $(".adi").html(data.sahip_adi);
                $(".adres").html(data.sahip_adres);
                $(".telefon").html(data.sahip_tel);
                $(".eposta").html(data.sahip_eposta);
                $(".facebook").html("<a href='"+data.facebook+"' target='_blank'>"+data.facebook+"</a>");
                $(".twitter").html("<a href='https://twitter.com/"+data.twitter+"' target='_blank'>"+data.twitter+"</a>");
                $(".instagram").html("<a href='https://www.instagram.com/"+data.instagram+"' target='_blank'>"+data.instagram+"</a>");
                $(".googleplus").html("<a href='"+data.googleplus+"' target='_blank'>"+data.googleplus+"</a>");
                karekod_json = {
                    "adi":data.sahip_adi,
                    "adres":data.sahip_adres,
                    "telefon":data.sahip_tel,
                    "eposta":data.sahip_eposta,
                    "facebook":data.facebook,
                    "twitter":data.twitter,
                    "instagram":data.instagram,
                    "googleplus":data.googleplus,
                    "hb_no":data.hb_no
                };
                console.log(karekod_json);
                karekod_url = "https://chart.googleapis.com/chart?chs=300&cht=qr&chl="+JSON.stringify(karekod_json)+"&choe=UTF-8";
                $("#karekod").html("<img src='"+karekod_url+"' alt='kare kod' >");
            }else {
                $(".bilgilendirme").modal('show');
            }
        }).fail(function(data) {
            console.log("error",data);
        });
    });

    //düzenleme düğmesinin üzerine gelince gerekli açıklamayı yapmak için popoverı açar/kapatır
    $("#duzenle").popover({
        placement:"top",
        title:"Düzenle",
        content:"Eskiden yaptığınız bir kaydı düzenlemek için sadece eposta girmeniz yeterlidir.",
        html:true,
        trigger:"hover"
    });

    //düzenlemek için kayıtları geririr
    $("#duzenle").click(function () {
        veriler = {
            "duzenlenecek_kayitlari_goster":true,
            "eposta":$("#eposta").val()
        };

        $.ajax({
            url: "php/islemler.php",
            type: 'post',
            dataType: 'json',
            data: veriler
        }).done(function(data) {
            console.log(data);
            $(".duzenlenecek-kayitlar").html(data.mesaj);
        }).fail(function(data) {
            console.log("error",data);
        });
    });

    //düzenlemek için seçilen bilgileri kaydetme/düzenleme formuna gönderir
    $(document).on('click','.panel-heading-dugme',function () {
        console.log($(this));
        adi = $(this).data("adi");
        telefon = $(this).data("tel");
        eposta = $(this).data("eposta");
        adres = $(this).data("adres");
        facebook = $(this).data("facebook");
        twitter = $(this).data("twitter");
        instagram = $(this).data("instagram");
        googleplus = $(this).data("googleplus");

        $("#isim").val(adi);
        $("#telefon").val(telefon);
        $("#eposta").val(eposta);
        $("#adres").val(adres);
        $("#facebook").val(facebook);
        $("#twitter").val(twitter);
        $("#instagram").val(instagram);
        $("#googleplus").val(googleplus);
        $("#duzenleme-modu-hb-no").val(hb_no);
    });

    //düzenleme modunu kapatır
    $(document).on('click','.duzenlemeyi-kapat',function () {
        $(".duzenlenecek-kayitlar").html("");
        $("#duzenleme-modu-hb-no").val("");
    });
});