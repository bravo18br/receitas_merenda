function displayFileName(spanId, input) {
    const fileName = input.files[0].name;
    document.getElementById(spanId).textContent = fileName;

    const inputGroup = input.parentElement;
    if (fileName.trim() !== '') {
        inputGroup.classList.add('filled-field');
        inputGroup.classList.remove('empty-field');
    } else {
        inputGroup.classList.add('empty-field');
        inputGroup.classList.remove('filled-field');
    }
}