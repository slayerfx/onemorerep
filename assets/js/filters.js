const badges = {
    "Débutant": "beginner",
    "Intermédiaire": "intermediate",
    "Avancé": "advanced"
};

function createExerciseCard(exercise) {
    const badgeClass = badges[exercise.difficulty];

    return `<a href="index.php?route=show-exercise&id=${exercise.id}" class="exercise-card">
        <div class="exercise-card-img">
            <img src="assets/images/exercises/${exercise.image}" alt="${exercise.name}" loading="lazy">
        </div>
        <div class="exercise-card-text">
            <h3>${exercise.name}</h3>
            <div class="exercise-card-meta">
                <span class="exercise-group">${exercise.muscleGroup}</span>
                <span class="badge badge-${badgeClass}">${exercise.difficulty}</span>
            </div>
        </div>
    </a>`;
}

const filterButtons = document.querySelectorAll(".filter-btn");
const grid = document.querySelector(".exercises-grid");

filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
        filterButtons.forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");

        const group = button.getAttribute("data-group");
        let url = "index.php?route=api-exercises";
        if (group !== "all") {
            url += "&group=" + group;
        }

        fetch(url)
            .then((response) => response.json())
            .then((exercises) => {
                let html = "";
                exercises.forEach((exercise) => {
                    html += createExerciseCard(exercise);
                });
                grid.innerHTML = html;
            })
            .catch((error) => console.error(error));
    });
});
