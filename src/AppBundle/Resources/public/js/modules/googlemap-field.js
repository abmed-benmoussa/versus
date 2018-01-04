(function($){
    String.prototype.format = function() {
        var str = this;
        for (var i = 0; i < arguments.length; i++) {
            var reg = new RegExp("\\{" + i + "\\}", "gm");
            str = str.replace(reg, arguments[i]);
        }
        return str;
    };
    var GoogleMapField = function() {
        this.$els = $('input.google-map-field');
        this.apikey = "AIzaSyBEOth-YKnddRxUQ4DQ7X7RZmUL1DSpsLg";
        this.scripturl = "//maps.googleapis.com/maps/api/js?v=3&key={0}&libraries=places";
        this.addressUrl = "//maps.googleapis.com/maps/api/geocode/json?address={0}&key={1}";
        this.markerIcon = "//maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png";
        this
            .includeScript()
            .init()
        ;
    };
    GoogleMapField.prototype.includeScript = function() {
        $('<script/>', {src: this.scripturl.format(this.apikey), type: "text/javascript"}).appendTo('head');
        return this;
    };
    GoogleMapField.prototype.init = function() {
        var self = this;
        this.$els.each(function(){
            var el = this,
                $el = $(this),
                $form = $(el.form),
                $parent = $el.parent(),
                $map = $('<div/>', {id: $el.attr('id') + '-mapcontainer', css:{height: '200px'}})
            ;
            $form.attr('onkeypress', 'return event.keyCode != 13;');
            if ($parent.find('.help-block').length) {
                $parent.find('.help-block').eq(0).before($map);
            } else {
                $el.after($map);
            }

            (function(){
                if (!window.google || !window.google.maps || !window.google.maps.places) {
                    return setTimeout(arguments.callee, 1000);
                }
                var mapValue = function() {
                    var valueFormat = "{0}|{1}|{2}",
                        mapCenter = el.map.getCenter(),
                        mapZoom = el.map.getZoom(),
                        varlue = valueFormat.format(mapCenter.lat(),mapCenter.lng(), mapZoom)
                    ;
                    $el.val(varlue);
                };
                el.map = new google.maps.Map($map.get(0), self.getInputConfig($el));
                el.map.markers = [];
                el.map.isLoaded = false;
                el.searchBox = self.addSearchBox(el.map);
                el.map.addListener('center_changed', mapValue);
                el.map.addListener('zoom_changed', mapValue);
                el.map.addListener('tilesloaded', function(){
                    if (!el.map.isLoaded) {
                        el.map.isLoaded = true;
                        $('[data-geocode="#'+el.id+'"]').on('blur', function(event){
                            var data = [];
                            $('[data-geocode="#'+el.id+'"]').each(function(){
                                data.push(this.value);
                            });
                            self.centerMapWithAddress(el.map, data.join(', '));
                        });
                        $el.trigger('map_field.loaded',[self, el.map, el.searchBox]);
                    } else {
                        $el.trigger('map_field.refresh',[self, el.map, el.searchBox]);
                    }
                });
                el.resetMap = function() {
                    $('#' + el.id + '-mapcontainer').remove();
                    el.value = "0|0|1";
                    self.init();
                };
                self.centerMarker(el.map, el.map.getCenter());
            })();
        });
        return this;
    };
    GoogleMapField.prototype.getInputConfig = function($input) {
        var inputVal = $input.val().split('|'),
            lat = inputVal[0]||0,
            log = inputVal[1]||0,
            zoom = parseInt(inputVal[2])||1
        ;
        // console.log(inputVal);
        return {
            center:new google.maps.LatLng(lat,log),
            zoom:zoom,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
    };
    GoogleMapField.prototype.addSearchBox = function(map) {
        var self = this,
            input = $(
                '<input/>',
                {
                    type:'text',
                    class: 'form-control'
                }
            ).appendTo('body') .get(0),
            searchBox = new google.maps.places.SearchBox(input)
        ;
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length === 0) {
                return;
            }
            self.removeAllMakers(map);
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    },
                    marker = new google.maps.Marker({
                        map: map,
                        icon: self.getMarkerIcon(),
                        title: place.name,
                        position: place.geometry.location,
                        draggable:true
                    })
                ;
                map.markers.push(marker);
                self.addressWithcenterMap(map, marker.getPosition());
                google.maps.event.addListener(marker, 'dragend', function() {
                    map.panTo(marker.getPosition());
                    self.addressWithcenterMap(map, marker.getPosition());
                });
                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
        return input;
    };
    GoogleMapField.prototype.getMarkerIcon = function($input) {
        return {
            url: this.markerIcon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };
    };
    GoogleMapField.prototype.centerMapWithAddress = function(map, address) {
        var self = this, geocoder = new google.maps.Geocoder();
        geocoder.geocode({address: address, partialmatch: true}, function (results, status) {
            if(results && results.length > 0) {
                map.setZoom(14);
                self
                    .removeAllMakers(map)
                    .centerMarker(map, results[0].geometry.location)
                ;
            }
        });
    };
    GoogleMapField.prototype.addressWithcenterMap = function(map, location) {
        var self = this, geocoder = new google.maps.Geocoder();
        geocoder.geocode({location: location}, function (results, status) {
            if(results && results.length > 0) {
                console.log(location.lat(), location.lng(), results);
                $('[data-geocode]').val(results[0].formatted_address);
            }
        });
    };
    GoogleMapField.prototype.getAddressUrl = function(address) {
        return this.addressUrl.format(address, this.apikey);
    };
    GoogleMapField.prototype.removeAllMakers = function(map) {
        map.markers.forEach(function(marker) {
            marker.setMap(null);
        });
        map.markers = [];
        return this;
    };
    GoogleMapField.prototype.centerMarker = function(map, location) {
        var self = this, marker = new google.maps.Marker({
            map: map,
            icon: this.getMarkerIcon(),
            position: location,
            draggable:true
        });
        map.markers.push(marker);
        map.panTo(marker.getPosition());
        google.maps.event.addListener(marker, 'dragend', function() {
            map.panTo(marker.getPosition());
            self.addressWithcenterMap(map, marker.getPosition());
        });
    };

    var GoogleStaticMap = function() {
        this.$els = $('div.google-static-map');
        this.apikey = "AIzaSyBEOth-YKnddRxUQ4DQ7X7RZmUL1DSpsLg";
        this.imgUrl = "https://maps.googleapis.com/maps/api/staticmap?center={0},{1}&zoom={2}&size={3}x{4}&markers={0},{1}&key={5}";
        this
            .init()
        ;
    };
    GoogleStaticMap.prototype.init = function() {
        var self = this;
        this.$els.each(function(){
            var $el = $(this),
                lat = $el.data('lat'),
                lng = $el.data('lng'),
                zoom = $el.data('zoom'),
                width = $el.data('width'),
                heigth = $el.data('heigth'),
                imgUrl = self.imgUrl.format(lat, lng, zoom, width, heigth, self.apikey)
            ;
            $('<img>', {src:imgUrl, class:'img-responsive'}).appendTo($el);
        });
        return this;
    };

    $(function(){
        if ($('input.google-map-field').length > 0) {
                new GoogleMapField();
        }
        if ($('div.google-static-map').length > 0) {
            new GoogleStaticMap();
        }
    });
})(jQuery);
