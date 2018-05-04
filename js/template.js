/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

(function ($) {
    $(document).ready(function () {
        $('*[rel=tooltip]').tooltip();

        // Turn radios into btn-group
        $('.radio.btn-group label').addClass('btn');

        $(".btn-group label:not(.active)").click(function () {
            var label = $(this);
            var input = $('#' + label.attr('for'));

            if (!input.prop('checked')) {
                label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
                if (input.val() == '') {
                    label.addClass('active btn-primary');
                } else if (input.val() == 0) {
                    label.addClass('active btn-danger');
                } else {
                    label.addClass('active btn-success');
                }
                input.prop('checked', true);
                input.trigger('change');
            }
        });
        $(".btn-group input[checked=checked]").each(function () {
            if ($(this).val() == '') {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
            } else if ($(this).val() == 0) {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
            } else {
                $("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
            }
        });

        $('#back-top').on('click', function (e) {
            e.preventDefault();
            $("html, body").animate({scrollTop: 0}, 1000);
        });


        $(".getTitle").click(function(){

            $title = $(this).attr("title");

            $(".contactus-lightbox-cap > h4").html($title);

            $curModTitle = $("input[name*='module_title']").val($title);

        });

/*
$(".aboutDescr>.uslugi >p").text(function(i, text) {
  if (text.length >= 200) {
    text = text.substring(0, 200);
    var lastIndex = text.lastIndexOf(" ");       // позиция последнего пробела
    text = text.substring(0, lastIndex) + '...'; // обрезаем до последнего слова
  }
  $(this).text(text);
});*/

		
$(window).load(function() {
           var carouselDefault = new floatingCarousel('#carousel-responsive', {
            autoScroll: true,
            autoScrollDirection: 'right',
            autoScrollSpeed: 100000,
            scrollSpeed: 'fast'
        });
});
		

    })
})(jQuery);

/*Инициализация гугл карты*/
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: new google.maps.LatLng(50.427980, 30.418119),
        mapTypeId: 'roadmap'
    });

    var iconBase = 'https://rak-legkogo.com.ua/img/';
    var icons = {
        parking: {
            icon: iconBase + 'parking_lot_maps.png'
        },
        library: {
            icon: iconBase + 'library_maps.png'
        },
        info: {
            icon: iconBase + 'mark.gif'
        }
    };

    var features = [
        {
            position: new google.maps.LatLng(50.425960, 30.418733),
            type: 'info',
            title:"Hello World!"
        }
    ];


    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<div id="bodyContent">'+
        '<p class="uk-margin-remove"><span class="uk-text-bold" style="color:#666;">"ДОБРЫЙ ПРОГНОЗ"</span><br>' +
        ' бульвар Вацлава Гавела, 40<br>'+
		'Київ <br>'+
		'03126</p>'+
		'<a href="https://www.dobro-clinic.com" tartget="_blank" s>dobro-clinic.com</a></div>'+
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    // Create markers.
    features.forEach(function(feature) {
        var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map,
            title: '«ДОБРЫЙ ПРОГНОЗ» - КЛИНИКА ВАШЕГО ДОВЕРИЯ'
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    });
}
/*Инициализация гугл карты*/
