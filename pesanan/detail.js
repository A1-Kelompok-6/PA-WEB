import { currency } from '/assets/js/utils.js';

$('.double-click').on('dblclick', async function () {
  const id = $(this).data('id');
  const invoice = $(this).data('name');
  const res = await fetch(`/api/order/detail.php?id=${id}`, {
    method: 'GET',
    headers: {
      "Accept": "*/*"
    }
  });

  const {
    success,
    message,
    data
  } = await res.json();

  if (success) {
    const html = data.map((d) => `
        <p>
          ${d.name}  
          ${currency(d.price)} x <span id='amount-text-${d.id}'>${d.amount}</span> = <b id="total-text-${d.id}">${currency(d.total)}</b>
          </p>`);
    Swal.fire({
      title: `Detail Pesanan ${invoice}`,
      html: html.join('')
    })
    console.log(data);
  }
});