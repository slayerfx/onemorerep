// Mapping difficulty labels to CSS class names
const badges = {
    "Débutant": "beginner",
    "Intermédiaire": "intermediate",
    "Avancé": "advanced"
};

// Builds the HTML for one exercise card (same structure as the PHP template)
function createExerciseCard(exercise) {
    const badgeClass = badges[exercise.difficulty];

    return '<a href="index.php?route=show-exercise&id=' + exercise.id + '" class="exercise-card">'
        + '<div class="exercise-card-img">'
        + '<img src="assets/images/exercises/' + exercise.image + '" alt="' + exercise.name + '" loading="lazy">'
        + '</div>'
        + '<div class="exercise-card-text">'
        + '<h3>' + exercise.name + '</h3>'
        + '<div class="exercise-card-meta">'
        + '<span class="exercise-group">' + exercise.muscleGroup + '</span>'
        + '<span class="badge badge-' + badgeClass + '">' + exercise.difficulty + '</span>'
        + '</div>'
        + '</div>'
        + '</a>';
}

// Select DOM elements
const filterButtons = document.querySelectorAll(".filter-btn");
const grid = document.querySelector(".exercises-grid");

// Listen for click events on each filter button
filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
        // Toggle active state: remove from all, add to clicked
        filterButtons.forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");

        // Build the API URL based on the selected muscle group
        const group = button.getAttribute("data-group");
        let url = "index.php?route=api-exercises";
        if (group !== "all") {
            url += "&group=" + group;
        }

        // Fetch exercises from the server (async, no page reload)
        fetch(url)
            .then((response) => response.json())
            .then((exercises) => {
                // Rebuild the grid with the filtered exercises
                let html = "";
                exercises.forEach((exercise) => {
                    html += createExerciseCard(exercise);
                });
                grid.innerHTML = html;
            });
    });
});
