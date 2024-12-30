document.getElementById("searchBtn").addEventListener("click", function () {
    const search = document.getElementById("search").value;
    const location = document.getElementById("location").value;

    fetch("search_rdv.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `search=${encodeURIComponent(search)}&location=${encodeURIComponent(location)}`
    })
    .then(response => response.json())
    .then(data => {
        const doctorList = document.getElementById("doctorList");
        doctorList.innerHTML = ""; // Effacer les anciens résultats

        if (data.error) {
            alert(data.error);
            return;
        }

        data.forEach(doctor => {
            const li = document.createElement("li");
            li.innerHTML = `<span>${doctor.medecin_nom} ${doctor.medecin_prenom} - ${doctor.specialite} (${doctor.etablissement_nom}, ${doctor.Ville})</span>
                            <button class="prendre-rdv-btn">Prendre Rendez-vous</button>`;
            doctorList.appendChild(li);
        });

        document.getElementById("results").classList.remove("hidden");
    })
    .catch(error => console.error("Erreur:", error));
});
