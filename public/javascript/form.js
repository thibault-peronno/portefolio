const form = {
    init: function () {
        let selectTechno = document.getElementById('selectTechnos');
        console.log(selectTechno);
        selectTechno.addEventListener('click', form.handleSelectTechno);
    },

    handleSelectTechno: function () {
        console.log('handleSelectTechnos');
        let boxesTEchnos = document.getElementById('checkTechnos');
        console.log(boxesTEchnos.classList.value);
        let classList = boxesTEchnos.classList.value;

        if(classList.includes('hidden')) {
            boxesTEchnos.classList.remove('hidden');
            boxesTEchnos.classList.add('block');
        }else if (classList.includes('block')) {
            boxesTEchnos.classList.remove('block');
            boxesTEchnos.classList.add('hidden');
        }
    },
}