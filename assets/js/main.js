import RibsApi from "ribs-api";

const api = new RibsApi('');
const ribsForms = document.querySelectorAll('form.ribs-form');

ribsForms.forEach((form) => {
  const autocompleteFields = form.querySelectorAll('.input-autocomplete');

  autocompleteFields.forEach((autocompleteField) => {
    autocompleteField.addEventListener('keyup', (event) => {
      const field = event.currentTarget;
      if (field.value.length > 2) {
        api.post(field.dataset.url, {autocomplete: field.value}, 'html').then((data) => {
          console.log(data);
        });
      }
    });
  });
});
