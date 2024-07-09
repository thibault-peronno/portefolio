const form = {
    init: function () {
        let updateImageText = document.getElementById('updateImageText');
        let updateImageInput = document.getElementById('updateImageInput');
        updateImageText.addEventListener('click', ()=> form.handleUpdateImage(updateImageText, updateImageInput));
        let cancelUpdateImageInput = document.getElementById('cancelUpdateImageInput');
        cancelUpdateImageInput.addEventListener('click', ()=>form.handleUpdateImage(updateImageText, updateImageInput))
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