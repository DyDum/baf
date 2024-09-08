(function($) {
    "use strict";

    var map;
    var markers = [];
    var newMarker;

    // Options de la carte
    var options = {
        zoom: 7,
        center: [46.6087, 2.4623],
        zoomControl: false,
        attributionControl: false
    };

    // Style de la carte
    var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    });

    // Fonction pour ajouter les marqueurs sur la carte
    var addMarkers = function(props, map) {
        $.each(props, function(i, prop) {
            var marker = L.marker([prop.latitude, prop.longitude], {
                draggable: false
            }).addTo(map);

            var popupContent = '<div class="infoW">' +
                                    // '<div class="propImg">' +
                                    //     '<img src="images/prop/' + prop.image + '">' +
                                    //     '<div class="propBg">' +
                                    //         '<div class="propPrice">' + prop.price + '</div>' +
                                    //         '<div class="propType">' + prop.type + '</div>' +
                                    //     '</div>' +
                                    // '</div>' +
                                    '<div class="paWrapper">' +
                                        '<div class="propTitle">' + prop.name + '</div>' +
                                        '<div class="propAddress">' + prop.address + '</div>' +
                                    '</div>' +
                                    '<div class="propRating">' +
                                        '<span class="fa fa-star"></span>' +
                                        '<span class="fa fa-star"></span>' +
                                        '<span class="fa fa-star"></span>' +
                                        '<span class="fa fa-star"></span>' +
                                        '<span class="fa fa-star-o"></span>' +
                                    '</div>' +
                                    // '<ul class="propFeat">' +
                                    //     '<li><span class="fa fa-moon-o"></span> ' + prop.bedrooms + '</li>' +
                                    //     '<li><span class="icon-drop"></span> ' + prop.bathrooms + '</li>' +
                                    //     '<li><span class="icon-frame"></span> ' + prop.area + '</li>' +
                                    // '</ul>' +
                                    '<div class="clearfix"></div>' +
                                    '<div class="infoButtons">' +
                                        '<a class="btn btn-sm btn-round btn-gray btn-o closeInfo">Close</a>' +
                                        '<a href="single.html" class="btn btn-sm btn-round btn-green viewInfo">View</a>' +
                                    '</div>' +
                                 '</div>';

            marker.bindPopup(popupContent);
            markers.push(marker);
        });
    }

    setTimeout(function() {
        $('body').removeClass('notransition');

        map = L.map('mapView', options);
        tileLayer.addTo(map);

        if ($('#address').length > 0) {
            var newMarkerIcon = L.icon({
                iconUrl: 'images/marker-new.png',
                iconSize: [36, 36]
            });

            newMarker = L.marker([46.6087, 2.4623], {
                draggable: true,
                icon: newMarkerIcon
            }).addTo(map);

            newMarker.on('dragend', function(event) {
                var position = newMarker.getLatLng();
                $('#latitude').text(position.lat);
                $('#longitude').text(position.lng);

                reverseGeocode(position.lat, position.lng);
            });
        }

        addMarkers(props, map);
    }, 300);

    // Fonctionnalité pour l'icône de manipulation de la carte sur les appareils mobiles
    $('.mapHandler').click(function() {
        if ($('#mapView').hasClass('mob-min') || 
            $('#mapView').hasClass('mob-max') || 
            $('#content').hasClass('mob-min') || 
            $('#content').hasClass('mob-max')) {
                $('#mapView').toggleClass('mob-max');
                $('#content').toggleClass('mob-min');
        } else {
            $('#mapView').toggleClass('min');
            $('#content').toggleClass('max');
        }

        setTimeout(function() {
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

            if (map) {
                map.invalidateSize();
            }

            $('.commentsFormWrapper').width($('#content').width());
        }, 300);

    });

    // Fonction pour l'autocomplétion d'adresse
    function autocompleteAddress(input) {
        var minLength = 4;
        
        input.addEventListener('input', function() {
            var address = this.value;
            
            if (address.length >= minLength) {
                var position = newMarker.getLatLng();
                fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(address)}&limit=5&lat=${position.lat}&lon=${position.lng}`)
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        return json()})
                    .then(data => {
                        var results = data.features;
                        if (results.length === 0) {
                            $('#autocomplete-error').html('Erreur: Aucune adresse trouvée pour cette saisie');
                        }else{
                            $('#autocomplete-error').html('');
                        }
                        displayResults(results);
                    });
            }
        });
    }

    function reverseGeocode(lat, lon) {
        fetch(`https://api-adresse.data.gouv.fr/reverse/?lon=${lon}&lat=${lat}`)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    var address = data.features[0].properties.label;
                    $('#address').val(address);
                    $('#autocomplete-error').html('');
                } else {
                    console.log('Aucune adresse trouvée pour ces coordonnées');
                    $('#address').val('');
                    $('#autocomplete-error').html('Erreur: Aucune adresse trouvée pour ces coordonnées');
                }
            })
            .catch(error => {
                console.error('Erreur lors du reverse geocoding:', error);
            });
    }

    // Fonction pour afficher les résultats de l'autocomplétion
    function displayResults(results) {
        var resultsContainer = document.getElementById('autocomplete-results');
        resultsContainer.innerHTML = '';
        
        results.forEach(result => {
            var item = document.createElement('div');
            item.textContent = result.properties.label;
            item.addEventListener('click', function() {
                document.getElementById('address').value = result.properties.label;
                resultsContainer.innerHTML = '';
                
                // Mise à jour de la carte
                var latlng = L.latLng(result.geometry.coordinates[1], result.geometry.coordinates[0]);
                newMarker.setLatLng(latlng);
                map.panTo(latlng);
                $('#latitude').text(latlng.lat);
                $('#longitude').text(latlng.lng);
            });
            resultsContainer.appendChild(item);
        });
    }

    // Initialisation de l'autocomplétion
    if ($('#address').length > 0) {
        var addressInput = document.getElementById('address');
        autocompleteAddress(addressInput);
    }

    $('input, textarea').placeholder();

})(jQuery);