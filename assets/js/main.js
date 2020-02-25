import RibsApi from "ribs-api";

const api = new RibsApi('');
const ribsForms = document.querySelectorAll('form.ribs-form');

ribsForms.forEach((form) => {
  const autocompleteFields = form.querySelectorAll('.input-autocomplete');

  autocompleteFields.forEach((autocompleteField) => {
    console.log(autocompleteField);
  });
});
