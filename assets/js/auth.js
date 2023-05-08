const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");

const btnLogin = document.querySelector('form[name="login"] button');
const btnDaftar = document.querySelector('form[name="daftar"] button');

signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
  btnLogin.setAttribute("type", "button");
  btnDaftar.setAttribute("type", "submit");
};
loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
  btnLogin.setAttribute("type", "submit");
  btnDaftar.setAttribute("type", "button");
};
signupLink.onclick = () => {
  signupBtn.click();
  return false;
};

async function daftar(e) {
  e.preventDefault();
  e.stopPropagation();

  const name = document.querySelector("#daf_nama").value;
  const email = document.querySelector("#daf_email").value;
  const pass = $('#daf_pass').val();
  const conf_pass = $('#ulang_pass').val();

  const formData = new FormData();
  formData.append('name', name);
  formData.append('email', email);
  formData.append('pass', pass);

  if (pass !== conf_pass) {
    swal({
      title: 'Password dan Konfirmasi Password tidak Sama',
      icon: 'error',
    });
    return;
  }

  const response = await fetch('/api/auth/register.php', {
    method: 'POST',
    headers: {
      'Accept': '*/*',
    },
    body: formData
  });

  const res = await response.json();

  if (res.success) {
    console.log(res);
    swal({
      title: res.message,
      icon: "success",
    }).then(() => {
      $('input[type="radio"]#login').prop('checked', true);
      loginForm.style.marginLeft = "0%";
      loginText.style.marginLeft = "0%";
      btnLogin.setAttribute("type", "submit");
      btnDaftar.setAttribute("type", "button");
    });
  } else {
    swal({
      title: res.message,
      icon: "error",
    });
  }
}

async function masuk(e) {
  e.preventDefault();
  e.stopPropagation();

  const formData = new FormData()
  formData.append('email', $('#mail').val())
  formData.append('pass', $('#pass').val())

  const response = await fetch('/api/auth/login.php', {
    method: 'POST',
    headers: {
      'Accept': '*/*',
    },
    body: formData
  });

  const res = await response.json();

  if (res.success) {
    swal({
      title: res.message,
      text: `Selamat Datang ${res.name} 👋`,
      icon: "success",
    }).then(() => {
      $('input[name="name"]').val(res.name);
      $('input[name="role"]').val(res.role);
      $('input[name="id"]').val(res.id);

      document.forms['login'].submit();
    });
  } else {
    swal({
      title: res.message,
      text: "Pastikan Email dan Password sesuai",
      icon: "error",
    });
  }

}
