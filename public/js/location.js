document.addEventListener('DOMContentLoaded', function() {
    
    // Inisialisasi map, default center Indonesia
    var map = L.map('map').setView([-0.789275, 113.921327], 5);

    // Set provider peta menggunakan OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Mengambil data lokasi dari database yang dilempar oleh controller
    var locations = window.locationConfig ? window.locationConfig.locations : [];
    var bounds = [];

    if(locations.length > 0) {
        
        // Menambahkan penanda (marker) untuk setiap lokasi
        locations.forEach(function(loc) {
            var lat = parseFloat(loc.latitude);
            var lng = parseFloat(loc.longitude);
            
            if(!isNaN(lat) && !isNaN(lng)) {
                var marker = L.marker([lat, lng]).addTo(map);
                
                // Isi popup
                var popupContent = '<b>' + loc.name + '</b>';
                if(loc.address) {
                    popupContent += '<br>' + loc.address;
                }
                popupContent += '<br><a href="https://www.google.com/maps/dir/?api=1&destination=' + lat + ',' + lng + '" target="_blank" class="btn btn-sm btn-primary mt-2 py-1 px-2" style="font-size: 12px;">Rute (Google Maps)</a>';
                
                marker.bindPopup(popupContent);
                
                // Menambahkan titik ke array bounds
                bounds.push([lat, lng]);
            }
        });

        // Sesuaikan zoom dan tengah map agar semua penanda terlihat
        if(bounds.length > 0) {
            map.fitBounds(bounds, {padding: [50, 50], maxZoom: 16});
        }
    } else {
        // Default ke Samarinda jika tidak ada data sama sekali tapi map diload
        map.setView([-0.502106, 117.153709], 13);
    }

});
