document.getElementById('ratesForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  
  const payload = {
    "Unit Name": document.getElementById('unitName').value,
    "Arrival": document.getElementById('arrival').value,
    "Departure": document.getElementById('departure').value,
    "Occupants": parseInt(document.getElementById('occupants').value),
    "Ages": document.getElementById('ages').value.split(',').map(a => parseInt(a.trim()))
  };

  const output = document.getElementById('output');
  output.textContent = 'Sending request...';

  try {
    const response = await fetch('http://localhost:8000/api/rates', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify(payload)
    });

    const data = await response.json();
    output.textContent = JSON.stringify(data, null, 2);
  } catch (err) {
    output.textContent = 'Error: ' + err;
    console.error(err);
  }
});
