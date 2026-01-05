const $ = s => document.querySelector(s);

// Elements
const video    = $('#video');
const canvas   = $('#canvas');
const btnCap   = $('#capture');
const btnClear = $('#clear');
const upload   = $('#upload');
const selectC  = $('#category');
const result   = $('#result');
const spinner  = $('#spinner');
const saveBtn  = $('#modalSaveButton');
const modal    = $('#modal'); // FIXED (missing modal reference)

let streamTracks = [];

// Mappings
const endpointMap = {
  parts:      'parts',
  minifigure: 'figs',
  set:        'sets'
};

// CAMERA START
navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    video.srcObject = stream;
    streamTracks = stream.getTracks();
  })
  .catch(err => {
    result.textContent = 'Cannot start camera: ' + err.message;
  });

window.addEventListener('beforeunload', () => {
  streamTracks.forEach(t => t.stop());
});

// HELPERS
function setLoading(loading) {
  spinner.classList.toggle('hidden', !loading);
  btnCap.disabled   = loading;
  btnClear.disabled = loading;
  upload.disabled   = loading;
}

function clearResults() {
  result.innerHTML = `
    <div class="placeholder">
      <p>Click Capture or upload an image to start.</p>
    </div>`;
  upload.value = '';
}

function safeJsonParse(text) {
  try {
    return JSON.parse(text);
  } catch (e) {
    console.error("SERVER RETURNED NON-JSON:", text);
    return null;
  }
}

// Upload + auto send
upload.addEventListener('change', () => {
  const file = upload.files[0];
  if (!file) return;
  const url = URL.createObjectURL(file);
  result.innerHTML = `<img class="preview" src="${url}" alt="preview">`;
  setLoading(false);
  sendImage(file);
});

// Capture Photo
btnCap.addEventListener('click', () => {
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
  canvas.toBlob(sendImage, 'image/png');
});

btnClear.addEventListener('click', clearResults);

// ------------------------
// SEND IMAGE TO API
// ------------------------
async function sendImage(blob) {
  setLoading(true);
  result.textContent = '';

  const rawLabel = selectC.value.trim().toLowerCase();
  const suffix   = endpointMap[rawLabel];

  const apiUrl = suffix
    ? `https://api.brickognize.com/predict/${suffix}/`
    : `https://api.brickognize.com/predict/`;

  const file = blob instanceof File
    ? blob
    : new File([blob], 'upload', { type: blob.type || 'image/png' });

  const form = new FormData();
  form.append('query_image', file);

  try {
    const res = await fetch(apiUrl, {
      method:  'POST',
      headers: { 'Accept': 'application/json' },
      body:    form
    });

    const text = await res.text();
    const data = safeJsonParse(text);

    if (!data) {
      result.textContent = "Invalid response from API.";
      return;
    }

    const items = data.items || [];

    if (!items.length) {
      result.textContent = `No results for “${selectC.value}”.`;
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

// ------------------------
// CHECK PRODUCT IN DATABASE
// ------------------------
async function checkProductInDB(item_no, color, condition) {
  const url = `/check-product?item_no=${item_no}&color=${color}&condition=${condition}`;

  const res  = await fetch(url);
  const text = await res.text();       // raw server output
  const json = safeJsonParse(text);    // prevent crashing

  return json === true; // expected: true | false
}

// ------------------------
// RENDER API RESULT CARDS
// ------------------------
function renderResults(items) {
    console.log(items);
  result.innerHTML = '';

  items.forEach(item => {
    const pct = Math.round(item.score * 100);

    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
      <img src="${item.img_url}" alt="${item.name}">
      <div class="title">${item.name}</div>
      <div class="subtitle">${item.type.toUpperCase()} (ID: ${item.id})</div>
      <div class="score">Match: ${pct}%</div>
      <a class="link" href="${item.external_sites?.[0]?.url}" target="_blank">
        → View on Bricklink
      </a>`;

    card.addEventListener('click', async () => {
      console.log("Clicked Product Detail:", item); // 👈 Added line

      $('#modalName').value = item.name || '';
      $('#modalId').value   = item.id || '';

      const completenessGroup = document.getElementById('completenessGroup');
      completenessGroup.classList.add('hidden');

      const type = (item.type || '').toLowerCase();

      if (type === 'fig') {
        $('#modalType').value = 'MINIFIG';
      } else {
        if (type === 'set') completenessGroup.classList.remove('hidden');
        $('#modalType').value = item.type || '';
      }

      // CATEGORY MAPPING
      const categorySelect = document.getElementById('modalCategory');
      const categoryText   = (item.category || '').trim();
      const parts          = categoryText.split('/').map(p => p.trim().toLowerCase());

      let found = false;
      for (let opt of categorySelect.options) {
        const t = opt.textContent.trim().toLowerCase();
        if (parts.some(p => t === p)) {
          categorySelect.value = opt.value;
          found = true;
          break;
        }
      }
      if (!found) {
        for (let opt of categorySelect.options) {
          const t = opt.textContent.trim().toLowerCase();
          if (parts.some(p => t.includes(p))) {
            categorySelect.value = opt.value;
            found = true;
            break;
          }
        }
      }
      if (!found) categorySelect.value = '';

      // DATABASE CHECK
      const itemNo    = item.id;
      const color     = $('#modalColor')?.value || '';
      const condition = $('#modalCondition')?.value || '';

      const exists = await checkProductInDB(itemNo, color, condition);

      if (exists) {
        saveBtn.textContent = 'Update';
        saveBtn.dataset.action = 'update';
      } else {
        saveBtn.textContent = 'Save';
        saveBtn.dataset.action = 'save';
      }

      modal.classList.remove('hidden');
    });

    result.appendChild(card);
  });
}

// Init
clearResults();
setLoading(false);
