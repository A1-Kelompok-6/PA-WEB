const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");

signupBtn.onclick = (() => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (() => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
});
signupLink.onclick = (() => {
  signupBtn.click();
  return false;
});


let akun = []
if (localStorage.getItem("akun")) {
  akun = JSON.parse(localStorage.getItem("akun"));
}


function daftar() {
  const nama = document.getElementById("daf_nama").value;
  const email = document.getElementById("daf_email").value;
  const pass = document.getElementById("daf_pass").value;
  const ulang = document.getElementById("ulang_pass").value;
  if (pass == ulang) {
    akun.push({
      nama: nama,
      email: email,
      pass: pass
    })
    localStorage.setItem("akun", JSON.stringify(akun));
    alert("regis berhasil")
  } else {
    alert("regis Gagal")
  }
}

function masuk() {
  const mail = document.getElementById("mail").value;
  const pass = document.getElementById("pass").value;
  const login = false;
  for (var i = 0; i < akun.length; i++) {
      if (mail == akun[i]["email"] && pass == akun[i]["pass"]) {
          localStorage.setItem("username", akun[i]["nama"]);
          window.location.href = "/konten/home.html";
          alert("Login Berhasil");
          login = true;
          break;
      }
  }
  if (login == false) {
      alert("Login gagal");
  }
}

