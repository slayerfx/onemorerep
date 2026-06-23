const badges = {
    "Débutant": "beginner",
    "Intermédiaire": "intermediate",
    "Avancé": "advanced"
};

const container = document.getElementById("exercises-container");
const select = document.getElementById("exercise-select");
const btnAdd = document.getElementById("btn-add-exercise");

let exerciseIndex = container.querySelectorAll(".program-exercise-card").length;

function createExerciseCard(exerciseId, name, group, difficulty, index) {
    const badgeClass = badges[difficulty];

    const card = document.createElement("div");
    card.className = "program-exercise-card";
    card.setAttribute("data-index", index);

    card.innerHTML = `<div class="program-exercise-card-header">
        <h3>${name}</h3>
        <div class="program-exercise-card-meta">
            <span class="exercise-group">${group}</span>
            <span class="badge badge-${badgeClass}">${difficulty}</span>
        </div>
    </div>
    <input type="hidden" name="exercises[${index}][exercise_id]" value="${exerciseId}">
    <div class="program-exercise-card-inputs">
        <fieldset>
            <label for="exercises-${index}-sets">Séries</label>
            <input id="exercises-${index}-sets" type="number" name="exercises[${index}][sets]" value="4" min="1" required>
        </fieldset>
        <fieldset>
            <label for="exercises-${index}-reps">Répétitions</label>
            <input id="exercises-${index}-reps" type="number" name="exercises[${index}][reps]" value="10" min="1" required>
        </fieldset>
        <fieldset>
            <label for="exercises-${index}-weight">Poids (kg)</label>
            <input id="exercises-${index}-weight" type="number" name="exercises[${index}][weight]" min="0" step="0.5">
        </fieldset>
        <fieldset>
            <label for="exercises-${index}-rest_time">Repos (s)</label>
            <input id="exercises-${index}-rest_time" type="number" name="exercises[${index}][rest_time]" value="90" min="0" required>
        </fieldset>
    </div>
    <button type="button" class="btn btn-delete btn-remove-exercise">Supprimer</button>`;

    return card;
}

btnAdd.addEventListener("click", () => {
    const selectedOption = select.options[select.selectedIndex];

    if (!selectedOption.value) {
        return;
    }

    const exerciseId = selectedOption.value;
    const name = selectedOption.getAttribute("data-name");
    const group = selectedOption.getAttribute("data-group");
    const difficulty = selectedOption.getAttribute("data-difficulty");

    const card = createExerciseCard(exerciseId, name, group, difficulty, exerciseIndex);
    container.appendChild(card);

    const removeBtn = card.querySelector(".btn-remove-exercise");
    removeBtn.addEventListener("click", () => {
        card.remove();
    });

    exerciseIndex++;
    select.value = "";
});

const existingButtons = document.querySelectorAll(".btn-remove-exercise");
existingButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
        const card = btn.parentElement;
        card.remove();
    });
});
