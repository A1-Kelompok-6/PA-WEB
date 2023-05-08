$('.status-btn').on('click', function () {
  const id = $(this).data('id');
  const status = $(this).data('status');

  Swal.fire({
    title: `Yakin ingin Mengubah Status Menjadi '${status === 'success' ? 'Sukses' : 'Gagal'}'`,
    text: 'Status yang sudah diubah tidak dapat dikembalikan',
    icon: 'warning',
    confirmButtonText: 'Ya, Ubah Status',
    showDenyButton: true,
    denyButtonText: `Tidak, Ntar Duls`,
  }).then(async (result) => {
    if (result.isConfirmed) {
      const formData = new FormData();
      formData.append('id', id);
      formData.append('status', status);
  
      const res = await fetch('/api/order/change-status.php', {
        method: "POST",
        headers: {
          "Accept": "*/*"
        },
        body: formData,
      });
  
      const data = await res.json()
  
      if (data.success) {
        Swal.fire({
          title: data.message,
          icon: 'success'
        }).then(() => window.location.reload());
  
      } else {
        Swal.fire({
          title: data.message,
          icon: 'error'
        })
      }
      console.log(data);
    }
  })
});