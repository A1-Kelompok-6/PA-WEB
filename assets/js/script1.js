if (document.getElementById("username")) {
    // document.getElementById("username").innerHTML = localStorage.getItem("username");
}

var dataTiket = [];
if (sessionStorage.getItem("dataTiket")) {
    dataTiket = JSON.parse(sessionStorage.getItem("dataTiket"));
}

if (document.getElementById("data-Tiket")) {
    var rows = "";
    console.log(dataTiket.length);
    if (dataTiket.length == 0) {
        console.log("aaa");
        var row = '<tr><td  colspan = "6"> <b>Data Kosong</b> </td><tr>';
        rows = rows + row;
    } else {
        dataTiket.map((row) => {
            var row = '<tr><td>' + row.name + '</td><td>' + row.email + '</td><td>' + row.jenisKelamin + '</td><td>' + row.jenisTiket + '</td><td>' + row.jumlahTiket + '</td><td>' + row.alamat + '</td></tr>';
            rows = rows + row;
        })
    }
    console.log("aaaa");
    console.log(dataTiket);
    var tbody = document.getElementById("data-Tiket");
    tbody.innerHTML = rows;
}

function beli() {
    var inputName = document.getElementById("name").value;
    var jenisKelamin = document.querySelector('input[name="jenis-kelamin"]:checked').value;
    var email = document.getElementById("email").value;
    var jenisTiket = document.getElementById("jenis-tiket").value;
    var jumlahTiket = document.getElementById("tiket").value
    var alamat = document.getElementById("alamat").value
    dataTiket.push({
        name: inputName,
        email: email,
        jenisTiket: jenisTiket,
        jenisKelamin: jenisKelamin,
        jumlahTiket: jumlahTiket,
        alamat: alamat
    })
    sessionStorage.setItem("dataTiket", JSON.stringify(dataTiket));
    alert("Data anda sudah terkirim");
}

