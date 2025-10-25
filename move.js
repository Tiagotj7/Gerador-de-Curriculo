// move.js
const inputFoto = document.querySelector('input[name="foto"]');
const preview = document.createElement('img');
preview.className = 'foto-preview';
inputFoto.insertAdjacentElement('afterend', preview);

inputFoto.addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) {
    preview.src = URL.createObjectURL(file);
  } else {
    preview.src = '';
  }
});

