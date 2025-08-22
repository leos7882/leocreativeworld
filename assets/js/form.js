document.getElementById('contact-form').addEventListener('submit', function(event) {
  event.preventDefault();
  const form = this;
  const alertDiv = document.getElementById('st-alert');

  fetch(form.action, {
    method: 'POST',
    body: new FormData(form),
    headers: { 'Accept': 'application/json' }
  })
  .then(response => response.json())
  .then(data => {
    alertDiv.innerHTML = `<p style="color: ${data.status === 'success' ? 'green' : 'red'}">${data.message}</p>`;
    if (data.status === 'success') {
      form.reset();
    }
  })
  .catch(error => {
    alertDiv.innerHTML = `<p style="color: red">Error: ${error.message}</p>`;
  });
});