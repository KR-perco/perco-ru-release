if (!window.BX_GMapAddPlacemark) {
    window.BX_GMapAddPlacemark = function(arPlacemark, map_id) {
        var map = GLOBAL_arMapObjects[map_id];

        if (null == map)
            return false;

        if (!arPlacemark.LAT || !arPlacemark.LON)
            return false;

        // const svgMarker = {
        //     path: "M37.5,5.4C24,5.4,13.2,16,13.2,29.3c0,13.3,24.3,50.1,24.3,50.1s24.3-36.9,24.3-50.1C61.8,16,50.8,5.4,37.5,5.4 z M37.5,43.1c-7.7,0-14.1-6.2-14.1-13.9c0-7.6,6.3-13.9,14.1-13.9c7.7,0,14.1,6.2,14.1,13.9C51.6,36.9,45.2,43.1,37.5,43.1z",
        //     fillColor: "#214288",
        //     fillOpacity: 1,
        //     strokeWeight: 0,
        //     rotation: 0,
        //     scale: 1,
        // };
        console.log(arPlacemark.MARK);
        const imageMarker = {
            url: "/images/icons/geo-pointer.svg",
            // url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png", 
            size: new google.maps.Size(75, 85),
        };

        var obPlacemark = new google.maps.Marker({
            'position': new google.maps.LatLng(arPlacemark.LAT, arPlacemark.LON),
            'map': map,
            // 'icon': svgMarker
            'icon': imageMarker,
        });

        if (BX.type.isNotEmptyString(arPlacemark.TEXT)) {
            obPlacemark.infowin = new google.maps.InfoWindow({
                content: arPlacemark.TEXT.replace(/\n/g, '<br />')
            });

            google.maps.event.addListener(obPlacemark, 'click', function() {
                if (null != window['__bx_google_infowin_opened_' + map_id])
                    window['__bx_google_infowin_opened_' + map_id].close();

                this.infowin.open(this.map, this);
                window['__bx_google_infowin_opened_' + map_id] = this.infowin;
            });
        }
        // +
        resizeFullMap = map.getDiv();
        resizeFullMap.style.width = document.documentElement.clientWidth;
        resizeFullMap.style.height = document.documentElement.clientHeight;
        // -

        return obPlacemark;
    }
}

if (null == window.BXWaitForMap_view) {
    function BXWaitForMap_view(map_id) {
        if (null == window.GLOBAL_arMapObjects)
            return;

        if (window.GLOBAL_arMapObjects[map_id])
            window['BX_SetPlacemarks_' + map_id]();
        else
            setTimeout('BXWaitForMap_view(\'' + map_id + '\')', 300);
    }
}