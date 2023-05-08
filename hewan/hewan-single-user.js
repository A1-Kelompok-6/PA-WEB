const animal_id = $('input[name="animal-id"]').val();
const user_id = $('input[name="user-id"]').val();

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

$('select[name="filter"]').on('change', function () {

  document.forms['filter-select'].submit();
})

$('#fav').on('click', async () => {

  // Add Loading Bar
  $('#fav').toggleClass('is-loading');
  const formData = new FormData();
  formData.append('animalID', animal_id);
  formData.append('userID', user_id);

  const response = await fetch('/api/animal/add-fav.php', {
    method: 'POST',
    headers: {
      'Accept': '*/*',
    },
    body: formData
  });

  const res = await response.json();

  if (res.success) {
    $('#fav').toggleClass('is-loading');
    if (!$('#fav').hasClass('is-light')) {
      $('#fav').addClass('is-light');
      $('#fav').html(`<span class="icon-text"><span class="icon"><i class="fa-solid fa-heart"></i></span><span>Favorit</span></span>`);
    } else {
      $('#fav').removeClass('is-light');
      $('#fav').html(`<span class="icon-text"><span class="icon"><i class="fa-regular fa-heart"></i></span><span>Tambah Favorit</span></span>`);
    }
  } else {
    Toast.fire({
      icon: 'error',
      title: res.message,
    });
  }


})