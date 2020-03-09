import RibsApi from "ribs-api";

const api = new RibsApi('');
const ribsForms = document.querySelectorAll('form.ribs-form');

ribsForms.forEach((form) => {
  const autocompleteFields = form.querySelectorAll('.input-autocomplete');

  const div = document.createElement('div');
  div.classList.add('result-autocomplete');
  document.querySelector('.input-autocomplete').after(div);

  autocompleteFields.forEach((autocompleteField) => {
    autocompleteField.addEventListener('keyup', (event) => {
      const field = event.currentTarget;
      if (field.value.length > 2) {
        api.post(field.dataset.url, {autocomplete: field.value}, 'html').then((data) => {
          const autocompleteResult = autocompleteField.parentNode.querySelector('.result-autocomplete');
          autocompleteResult.innerHTML = data;
        });
      }
    });
  });
});
