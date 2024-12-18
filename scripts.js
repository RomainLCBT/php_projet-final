document.getElementById("searchBtn").addEventListener("click", function() {
    // Simuler les résultats
    const results = [
        { nom: "Dr. Jean Dupont", specialite: "Cardiologue", dispo: "12/12/2024 à 14h" },
        { nom: "Dr. Marie Durant", specialite: "Dermatologue", dispo: "15/12/2024 à 10h" },
        { nom: "Dr. Jacques Martin", specialite: "Généraliste", dispo: "17/12/2024 à 9h" }
    ];

    const doctorList = document.getElementById("doctorList");
    doctorList.innerHTML = "";  // Effacer les anciens résultats

    results.forEach(doctor => {
        const li = document.createElement("li");
        li.innerHTML = `<span>${doctor.nom} - ${doctor.specialite}</span> <button class="prendre-rdv-btn">Prendre Rendez-vous</button>`;
        doctorList.appendChild(li);
    });

    document.getElementById("results").classList.remove("hidden");
});
