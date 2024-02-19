function checkTextField() {
    const textField = document.getElementById('titulo_receita');
    const inputValue = textField.value.trim();

    const inputGroup = textField.closest('.input-group');
    if (inputValue !== '') {
        inputGroup.classList.add('filled-field');
        inputGroup.classList.remove('empty-field');
    } else {
        inputGroup.classList.add('empty-field');
        inputGroup.classList.remove('filled-field');
    }
}
document.getElementById('titulo_receita').addEventListener('input', checkTextField);