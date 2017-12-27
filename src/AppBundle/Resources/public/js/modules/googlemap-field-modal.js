(function($){
    String.prototype.format = function() {
        var str = this;
        for (var i = 0; i < arguments.length; i++) {
            var reg = new RegExp("\\{" + i + "\\}", "gm");
            str = str.replace(reg, arguments[i]);
        }
        return str;
    };
    var GoogleMapFieldModal = function() {
        this.$els = $('.google-map-field-modal');
        this.apikey = "AIzaSyBEOth-YKnddRxUQ4DQ7X7RZmUL1DSpsLg";
        this.scripturl = "//maps.googleapis.com/maps/api/js?v=3&key={0}&libraries=places";
        this.addressUrl = "//maps.googleapis.com/maps/api/geocode/json?address={0}&key={1}";
        this.markerIcon = "//maps.gstatic.com/mapfiles/place_api/icons/geocode-71.png";
        this
            .includeScript()
            .init()
        ;
    };
    GoogleMapFieldModal.prototype.includeScript = function() {
        $('<script/>', {src: this.scripturl.format(this.apikey), type: "text/javascript"}).appendTo('head');
        return this;
    };
    GoogleMapFieldModal.prototype.init = function() {
        var self = this;
        this.$els.each(function(){
            var el = this,
                $el = $(this),
                $modal = $el.closest('.modal'),
                $adresses = $('input.map-addresses'),
                $addButton = $modal.find('a').eq(0),
                $list = $modal.find('ul.list-group').eq(0)
            ;
            $el.html('');
            $modal.on('shown.bs.modal', function(event){
                self.openMap(el, $el)
            });
            $modal.on('hide.bs.modal', function(event){
                var len = $list.find('li').length,
                    valformat = len == 0 ? '' : len == 1 ? '{0} Dirección' : '{0} Direcciones'
                ;
                $adresses.val(valformat.format(len));
            }).trigger('hide.bs.modal');
            $addButton.on('click', function(event){
                event.preventDefault();
                var center =el.map.getCenter(),
                    lat = center.lat(),
                    lng = center.lng(),
                    zoom = el.map.getZoom()
                ;
                self.addAddress(el, $el, $list, lat, lng, zoom);
            });
            // $resetButton.on('click', function(event){
            //     $modal.modal('hide');
            //     el.value = "0|0|1";
            //     $geocodeField.val('');
            //     $('#' + el.id + '-mapcontainer').remove();
            // });
            // $select.on('change', function(event){
            //     var lat = 0, lng = 0, zoom = 1;
            //     if ($(this).val()!=='') {
            //         var parts = $(this).val().split('|');
            //         lat = parts[0];
            //         lng = parts[1];
            //         zoom = 14;
            //     }
            //     // else {
            //     //     el.value = "0|0|1";
            //     // }
            //     self.addressWithcenterMap(el.map, new google.maps.LatLng(lat, lng));
            //     el.map.setZoom(zoom);
            // })
        });
        return this;
    };
    GoogleMapFieldModal.prototype.addAddress = function(el, $el, $list, lat, lng, zoom) {
        console.log($list);
        var index = $list.data('index'),
            geocoder = new google.maps.Geocoder(),
            liContent = '<a class="btn btn-danger btn-xs pull-right">Eliminar</a>TEXT',
            prototype = $el.data('prototype').replace(/__name__/g, index)
            $li = $('<li/>', {class:'list-group-item'}),
            isValidAddress = (function() {
                var isValid = true, items = $list.find('li').get(), hash = btoa(lat+''+lng);
                for (var inx in items) {
                    var $item = $(items[inx]);
                    if ($item.data('hash') == hash) {
                        isValid = false;
                        break;
                    }
                }
                return isValid;
            })()
        ;
        if ((lat == 0 && lng ==0) || !isValidAddress) {
            return;
        }
        geocoder.geocode({location: el.map.getCenter()}, function (results, status) {
            if(results && results.length > 0) {
                var text = $.trim(results[0].formatted_address.split(',').filter(function(item){return item != 'Unnamed Road'}).join(','));
                $li.append([liContent.replace(/TEXT/g, text), prototype]);
                $li.find('input').eq(0).val(text);
                $li.find('input').eq(1).val(lat);
                $li.find('input').eq(2).val(lng);
                $li.find('input').eq(3).val(zoom);
                $list.append($li.data('hash', btoa(lat+''+lng))).data('index', index + 1);
            }
        });
        return this;
    };
    GoogleMapFieldModal.prototype.openMap = function(el, $el) {
        if ($el.parent().find('.map-container').length> 0) {
            return this
        }
        var $map = $('<div/>', {
            id: $el.attr('id') + '-mapcontainer',
            class: "map-container",
            css:{height: '200px'}
        }).insertAfter($el);
        var mapValue = function(el, $el) {
            var valueFormat = "{0}|{1}|{2}",
                mapCenter = el.map.getCenter(),
                mapZoom = el.map.getZoom(),
                varlue = valueFormat.format(mapCenter.lat(),mapCenter.lng(), mapZoom)
            ;
            $el.val(varlue);
        }
        var $geocodeField = $('[data-geocode=#{0}]'.format(el.id)),
            geocodeVal = $.trim($geocodeField.val())
        ;

        el.map = new google.maps.Map($map.get(0), this.getInputConfig($el));
        el.map.geocodeField = $geocodeField
        el.map.select = $el.closest('.modal').find('select').eq(0)
        el.map.markers = [];
        el.map.isLoaded = false;
        el.searchBox = this.addSearchBox(el.map);
        el.map.addListener('center_changed', function(){mapValue(el, $el)});
        el.map.addListener('zoom_changed', function(){mapValue(el, $el)});
        el.map.addListener('tilesloaded', function(){
            if (!el.map.isLoaded) {
                el.map.isLoaded = true;
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

        if (geocodeVal.length > 0 ) {
            this.centerMapWithAddress(el.map, geocodeVal)
        } else {
            this.centerMarker(el.map, el.map.getCenter());
        }

        return this
    };
    GoogleMapFieldModal.prototype.getInputConfig = function($input) {
        var inputVal = $input.val().split('|'),
            lat = inputVal[0]||0,
            log = inputVal[1]||0,
            zoom = parseInt(inputVal[2])||1
        ;
        return {
            center:new google.maps.LatLng(lat,log),
            zoom:zoom,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
    };
    GoogleMapFieldModal.prototype.addSearchBox = function(map) {
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
                    // map.select.prop('selectedIndex',0);
                    // self.addressWithcenterMap(map, marker.getPosition());
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
    GoogleMapFieldModal.prototype.getMarkerIcon = function($input) {
        return {
            url: this.markerIcon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };
    };
    GoogleMapFieldModal.prototype.centerMapWithAddress = function(map, address) {
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
    GoogleMapFieldModal.prototype.addressWithcenterMap = function(map, location) {
        var self = this, geocoder = new google.maps.Geocoder();
        geocoder.geocode({location: location}, function (results, status) {
            if(results && results.length > 0) {
                // $('[data-geocode]').val(results[0].formatted_address);
            }
        });
    };
    GoogleMapFieldModal.prototype.getAddressUrl = function(address) {
        return this.addressUrl.format(address, this.apikey);
    };
    GoogleMapFieldModal.prototype.removeAllMakers = function(map) {
        map.markers.forEach(function(marker) {
            marker.setMap(null);
        });
        map.markers = [];
        return this;
    };
    GoogleMapFieldModal.prototype.centerMarker = function(map, location) {
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
            // map.select.prop('selectedIndex',0);
            // self.addressWithcenterMap(map, marker.getPosition());
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
        if ($('.google-map-field-modal').length > 0) {
                new GoogleMapFieldModal();
        }
        if ($('div.google-static-map').length > 0) {
            new GoogleStaticMap();
        }
    });
})(jQuery);
