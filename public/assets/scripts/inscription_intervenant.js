function add_more_diplome() {
    const diplomeContainer = document.querySelector('.diplome');
    const firstChild = diplomeContainer.firstChild;
    
    const newDiplomeInput = document.createElement('input');
    
    newDiplomeInput.setAttribute('type', 'text');
    newDiplomeInput.setAttribute('name', 'registration_form[diplomes][]');
    newDiplomeInput.setAttribute('placeholder', 'Votre diplome');
    newDiplomeInput.setAttribute('required', 'required');
    
    diplomeContainer.insertBefore(newDiplomeInput, firstChild);
}
