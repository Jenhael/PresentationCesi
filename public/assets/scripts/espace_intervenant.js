const selectMenu = document.querySelector('#position_intervenant_formations');

selectMenu.addEventListener('change', async () => {
    const selectedValue = selectMenu.value;
    const espace_intervenant_position_intervenant = document.querySelector('.espace_intervenant_position_intervenant');

    try {
        const response = await fetch('/test', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_formation: selectedValue })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();

        let espace_intervenant_position_modules = document.querySelector('.espace_intervenant_position_modules');

        if (!espace_intervenant_position_modules) {
            espace_intervenant_position_modules = document.createElement('div');
            espace_intervenant_position_modules.classList.add("espace_intervenant_position_modules");
            espace_intervenant_position_intervenant.appendChild(espace_intervenant_position_modules);
        }

        espace_intervenant_position_modules.innerHTML = "";

        data.forEach((module) => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.value = module.id;
            checkbox.setAttribute('name', 'position_intervenant[modules][]');
            checkbox.classList.add('module');
            espace_intervenant_position_modules.appendChild(checkbox);

            const label = document.createElement('label');
            label.textContent = module.nom;
            label.setAttribute('for', 'module');
            espace_intervenant_position_modules.appendChild(label);
        });

        const existingButton = document.querySelector('.espace_intervenant_position_intervenant .position_button');
        if (!existingButton && data.length > 0) {
            const button = document.createElement('button');
            button.classList.add('position_button');
            button.innerText = "Se positioner";
            espace_intervenant_position_intervenant.appendChild(button);
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

function return_intervenants_card() {
    const gerer_intervenant_list = document.querySelector('.gerer_intervenant_list');
    gerer_intervenant_list.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('gerer_intervenant_form')) {
            const gerer_intervenant_form = event.target.closest('form');
            gerer_intervenant_form.classList.toggle('gerer_intervenant_form_returned');

            const gerer_intervenant_backface = gerer_intervenant_form.querySelector('.gerer_intervenant_backface');

            if (gerer_intervenant_form.classList.contains('gerer_intervenant_form_returned')) {
                gerer_intervenant_backface.style.backfaceVisibility = 'visible';
                gerer_intervenant_form.style.overflowY = "scroll";
            } else {
                gerer_intervenant_backface.style.backfaceVisibility = 'hidden';
                gerer_intervenant_form.style.overflowY = "hidden";
            }
        }
    });
}


