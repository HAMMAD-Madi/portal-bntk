const $ = s => document.querySelector(s);

const video    = $('#video');
const canvas   = $('#canvas');
const btnCap   = $('#capture');
const btnClear = $('#clear');
const upload   = $('#upload');
const selectC  = $('#category');
const result   = $('#result');
const spinner  = $('#spinner');
const modal    = $('#modal');
const closeBtn = $('#closeModal');

const modalName        = $('#modalName');
const modalType        = $('#itemType');
const modalCategory    = $('#modalCategory');
const modalId          = $('#modalId');
const modalUrl         = $('#modalUrl');
const completenessWrap = $('#completenessGroup');
const stockRoomWrap    = $('#stockRoomIdGroup');
const isStockRoom      = $('#isStockRoom');

let streamTracks = [];

// Handle SET type to show completeness group
modalType.addEventListener('change', () => {
  if (modalType.value === 'SET') {
    completenessWrap.classList.remove('hidden');
  } else {
    completenessWrap.classList.add('hidden');
  }
});

// Handle isStockRoom checkbox
isStockRoom.addEventListener('change', () => {
  stockRoomWrap.classList.toggle('hidden', !isStockRoom.checked);
});

// Start camera
navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    video.srcObject = stream;
    streamTracks = stream.getTracks();
  })
  .catch(err => {
    result.textContent = 'Cannot start camera: ' + err.message;
  });

// Clean up on unload
window.addEventListener('beforeunload', () => {
  streamTracks.forEach(track => track.stop());
});

// Spinner toggle
function setLoading(isLoading) {
  spinner.classList.toggle('hidden', !isLoading);
  btnCap.disabled   = isLoading;
  btnClear.disabled = isLoading;
  upload.disabled   = isLoading;
}

// Clear result area
function clearResults() {
  result.innerHTML = `
    <div class="placeholder">
      <p>Click Capture or upload an image to start.</p>
    </div>
  `;
  upload.value = '';
}

// Upload file preview
upload.addEventListener('change', () => {
  const file = upload.files[0];
  if (!file) return;

  const url = URL.createObjectURL(file);
  result.innerHTML = `<img id="preview" class="preview" src="${url}" alt="Uploaded image preview">`;
  setLoading(false);
  sendImage(file);
});

// Send image to Brickognize
async function sendImage(blob) {
  setLoading(true);
  result.textContent = '';

  const ENDPOINT = 'https://api.brickognize.com/predict/';
  const form = new FormData();
  form.append('query_image', blob, 'upload.png');

  try {
    const res = await fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Accept': 'application/json' },
      body: form
    });

    const data = await res.json();

    if (!res.ok) throw new Error(data.detail || data.error || `HTTP ${res.status}`);

    if (!Array.isArray(data.items)) {
      result.innerHTML = `<pre>Unexpected response:\n${JSON.stringify(data, null, 2)}</pre>`;
      return;
    }

    const mapType = { parts: 'part', minifig: 'minifig', set: 'set' };
    const desired = mapType[selectC.value] || selectC.value;
    const hits = data.items.filter(i => i.type === desired);

    if (!hits.length) {
      result.textContent = `No matches for “${selectC.value}”.`;
      return;
    }

    renderResults(hits);
  } catch (err) {
    console.error(err);
    const msg = err.message.startsWith('HTTP 5')
      ? 'Server error; try later.'
      : 'Check your internet connection.';
    result.textContent = msg;
  } finally {
    setLoading(false);
  }
}

// Capture from webcam
btnCap.addEventListener('click', () => {
  const ctx = canvas.getContext('2d');
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
  canvas.toBlob(sendImage, 'image/png');
});

// Clear button
btnClear.addEventListener('click', clearResults);

// Render Brickognize results
function renderResults(items) {
  result.innerHTML = '';
  items.forEach(item => {
    const pct = Math.round(item.score * 100);
    const card = document.createElement('div');
    card.className = 'card';
    card.dataset.name = item.name || '';
    card.dataset.type = item.type || '';
    card.dataset.id   = item.id   || '';
    card.dataset.url  = item.img_url || '';

    const linkUrl = item.external_sites?.[0]?.url || '#';

    card.innerHTML = `
      <img src="${item.img_url}" alt="${item.name}">
      <div class="title">${item.name}</div>
      <div class="subtitle">${item.type.charAt(0).toUpperCase() + item.type.slice(1)} (ID: ${item.id})</div>
      <div class="score">Match: ${pct}%</div>
      <a class="link" href="${linkUrl}" target="_blank">→ View on Bricklink</a>
    `;

    card.addEventListener('click', () => {
      modalName.value     = item.name || '';
      modalType.value     = item.type || '';
      modalCategory.value = item.category || '';
      modalId.value       = item.id || '';
      modalUrl.value      = item.img_url || '';

      // Trigger visibility changes
      modalType.dispatchEvent(new Event('change'));
      isStockRoom.checked = false;
      isStockRoom.dispatchEvent(new Event('change'));

      modal.classList.remove('hidden');
    });

    result.appendChild(card);
  });
}

// Close modal
closeBtn.addEventListener('click', () => {
  modal.classList.add('hidden');
});

// Initial UI state
clearResults();
setLoading(false);
