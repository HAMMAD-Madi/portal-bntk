// brickognize.js

const $ = s => document.querySelector(s);

// Elementen
const video    = $('#video');
const canvas   = $('#canvas');
const btnCap   = $('#capture');
const btnClear = $('#clear');
const upload   = $('#upload');
const selectC  = $('#category');
const result   = $('#result');
const spinner  = $('#spinner');

let streamTracks = [];

// Mappings (let op: keys in lowercase om case‐issues te voorkomen)
const endpointMap = {
  parts:      'parts',
  minifigure: 'figs',
  set:        'sets'
};

// Start camera
navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    video.srcObject = stream;
    streamTracks = stream.getTracks();
  })
  .catch(err => {
    result.textContent = 'Cannot start camera: ' + err.message;
  });

// Stop camera bij verlaten pagina
window.addEventListener('beforeunload', () => {
  streamTracks.forEach(t => t.stop());
});

// Spinner & knoppen
function setLoading(loading) {
  spinner.classList.toggle('hidden', !loading);
  btnCap.disabled   = loading;
  btnClear.disabled = loading;
  upload.disabled   = loading;
}

// Reset view
function clearResults() {
  result.innerHTML = `
    <div class="placeholder">
      <p>Click Capture or upload an image to start.</p>
    </div>`;
  upload.value = '';
}

// Upload preview + auto-send
upload.addEventListener('change', () => {
  const file = upload.files[0];
  if (!file) return;
  const url = URL.createObjectURL(file);
  result.innerHTML = `<img class="preview" src="${url}" alt="preview">`;
  setLoading(false);
  sendImage(file);
});

// Foto van webcam → sendImage
btnCap.addEventListener('click', () => {
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
  canvas.toBlob(sendImage, 'image/png');
});

// Clear-knop
btnClear.addEventListener('click', clearResults);

// Core: bouw URL, verstuur, vang 404 of andere errors
async function sendImage(blob) {
  setLoading(true);
  result.textContent = '';

  // 1) Bepaal welke suffix we nodig hebben
  const rawLabel = selectC.value.trim().toLowerCase();    // bv. "parts"
  const suffix   = endpointMap[rawLabel];

  // 2) Fallback naar algemene endpoint als mapping faalt
  const apiUrl = suffix
    ? `https://api.brickognize.com/predict/${suffix}/`
    : `https://api.brickognize.com/predict/`;

  console.log('POST naar:', apiUrl, 'label:', rawLabel);

  // 3) Zorg dat we altijd een File hebben
  const file = blob instanceof File
    ? blob
    : new File([blob], 'upload', { type: blob.type || 'image/png' });

  // 4) Bouw multipart/form-data body
  const form = new FormData();
  form.append('query_image', file);

  try {
    const res = await fetch(apiUrl, {
      method:  'POST',
      headers: { 'Accept': 'application/json' },
      body:    form
    });

    // 5) 404 of andere HTTP errors expliciet afhandelen
    if (res.status === 404) {
      throw new Error(`Endpoint niet gevonden (404). Controleer suffix map.`);
    }
    if (!res.ok) {
      const err = await res.text();
      throw new Error(`HTTP ${res.status}: ${err}`);
    }

    const data = await res.json();

    // 6) Toon resultaten of melding bij leeg
    const items = data.items || [];
    if (items.length === 0) {
      result.textContent = `Geen resultaten voor “${selectC.value}”.`;
    } else {
      renderResults(items);
    }

  } catch (err) {
    console.error(err);
    result.textContent = `Error: ${err.message}`;
  } finally {
    setLoading(false);
  }
}

// Render cards
function renderResults(items) {
  result.innerHTML = '';
  items.forEach(item => {
    const pct = Math.round(item.score * 100);
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <img src="${item.img_url}" alt="${item.name}">
      <div class="title">${item.name}</div>
      <div class="subtitle">
        ${item.type.charAt(0).toUpperCase() + item.type.slice(1)} (ID: ${item.id})
      </div>
      <div class="score">Match: ${pct}%</div>
      <a class="link" href="${item.external_sites?.[0]?.url}" target="_blank">
        → View on Bricklink
      </a>`;
      
    card.addEventListener('click', () => {
      $('#modalName').value = item.name || '';
      
      const completenessGroup = document.getElementById('completenessGroup');
      completenessGroup.classList.add('hidden');
        
      const type = item.type || '';
      if (type.toLowerCase() === 'fig') {
        $('#modalType').value = 'MINIFIG';
      } else {
          if(type.toLowerCase() === 'set'){
              const completenessGroup = document.getElementById('completenessGroup');
              completenessGroup.classList.remove('hidden');
          }
        $('#modalType').value = type || '';
      }
        
      $('#modalId').value   = item.id || '';
      const categorySelect = document.getElementById('modalCategory');
const categoryText = (item.category || '').trim().toLowerCase();
let found = false;

for (let opt of categorySelect.options) {
  if (opt.textContent.trim().toLowerCase() === categoryText) {
    categorySelect.value = opt.value;
    found = true;
    break;
  }
}

if (!found) {
  // fallback: add a new temporary option with text
  const newOption = new Option(item.category, '', true, true);
  categorySelect.add(newOption);
}

    //   $('#modalUrl').value  = item.img_url || '';
      modal.classList.remove('hidden');
    });
    
    result.appendChild(card);
  });
}

// Init
clearResults();
setLoading(false);