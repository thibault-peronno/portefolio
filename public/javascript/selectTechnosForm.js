const selectTechnosForm = {
    init: function () {
        let selectTechno = document.getElementById('selectTechnos');
        console.log(selectTechno);
        selectTechno.addEventListener('click', form.handleSelectTechno);
    },

    handleSelectTechno: function () {
        console.log('handleSelectTechnos');
        let boxesTechnos = document.getElementById('checklanguages');
        console.log(boxesTechnos.classList.value);
        let classList = boxesTechnos.classList.value;

        if(classList.includes('hidden')) {
            boxesTechnos.classList.remove('hidden');
            boxesTechnos.classList.add('block');
        }else if (classList.includes('block')) {
            boxesTechnos.classList.remove('block');
            boxesTechnos.classList.add('hidden');
        }
    },

}