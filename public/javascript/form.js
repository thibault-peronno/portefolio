const form = {
    init: function () {
        let selectTechno = document.getElementById('selectTechnos');
        console.log(selectTechno);
        selectTechno.addEventListener('click', form.handleSelectTechno);

        let updateImageText = document.getElementById('updateImageText');
        let updateImageInput = document.getElementById('updateImageInput');
        updateImageText.addEventListener('click', ()=> form.handleUpdateImage(updateImageText, updateImageInput));
        let cancelUpdateImageInput = document.getElementById('cancelUpdateImageInput');
        cancelUpdateImageInput.addEventListener('click', ()=>form.handleUpdateImage(updateImageText, updateImageInput))
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

    handleUpdateImage: function (text, input) {
        console.log('handleUpdateImage', text, input);

        let updateImageTextDiv = document.getElementById('updateImageTextDiv');
        let classListInput = input.classList.value;

        if (classListInput.includes('hidden')) {
            input.classList.remove('hidden');
            input.classList.add('block');
            updateImageTextDiv.classList.add('hidden');
        } else {
            input.classList.remove('block');
            input.classList.add('hidden');
            updateImageTextDiv.classList.remove('hidden');
            updateImageTextDiv.classList.add('block');
        }
    },

}