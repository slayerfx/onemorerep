const defaultLat = 48.1173;
const defaultLon = -1.6778;

const map = L.map("map").setView([defaultLat, defaultLon], 13);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap"
}).addTo(map);

// Adds a marker for each gyms
function loadGyms(lat, lon) {
    const query = `[out:json];
        nwr["leisure"="fitness_centre"](around:5000,${lat},${lon});
        out center;`;

    const url = "https://overpass-api.de/api/interpreter?data=" + encodeURIComponent(query);

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            data.elements.forEach((gym) => {
                const gymLat = gym.lat || gym.center.lat;
                const gymLon = gym.lon || gym.center.lon;
                const name = gym.tags.name || "Salle de sport";

                L.marker([gymLat, gymLon])
                    .addTo(map)
                    .bindPopup(name);
            });
        })
        .catch((error) => console.error(error));
}

// Center the map on the user
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        (position) => {

            const userLat = position.coords.latitude;
            const userLon = position.coords.longitude;
            map.setView([userLat, userLon], 13);
            loadGyms(userLat, userLon);
        },
        () => {
            console.log("Géolocalisation indisponible, position par défaut utilisée.");
            loadGyms(defaultLat, defaultLon);
        }
    );
} else {
    loadGyms(defaultLat, defaultLon);
}
