document.getElementById('ratesForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const payload = {
    "Unit Name": document.getElementById('unitName').value,
    "Arrival": document.getElementById('arrival').value,
    "Departure": document.getElementById('departure').value,
    "Occupants": parseInt(document.getElementById('occupants').value),
    "Ages": document.getElementById('ages').value.split(',').map(a => parseInt(a.trim()))
  };

  const response = await fetch('/api/rates', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  });

  const data = await response.json();
  document.getElementById('output').textContent = JSON.stringify(data, null, 2);
});
