document.addEventListener('DOMContentLoaded', function() {
  var message = document.querySelector("#formkegiatan .warning");
  var form = document.querySelector("#formkegiatan");

  form.addEventListener('submit', function(event) {
    var namakegiatan = document.getElementById("namakegiatan").value;
    var tanggalmulai = document.getElementById("tanggalmulai").value;
    var tanggalselesai = document.getElementById("tanggalselesai").value;
    var jamkegiatan = document.getElementById("jamkegiatan").value;
    var durasi = document.getElementById("durasi").value;
    var lokasi = document.getElementById("lokasi").value;
    var gambar = document.getElementById("gambar").value;

    message.innerHTML = "";

    if (namakegiatan === "") {
      message.innerHTML += "Nama kegiatan is still empty<br>";
    }
    if (tanggalmulai === "") {
      message.innerHTML += "Tanggal mulai is still empty<br>";
    }
    if (tanggalselesai === "") {
      message.innerHTML += "Tanggal selesai is still empty<br>";
    }
    if (jamkegiatan === "") {
      message.innerHTML += "Jam kegiatan is still empty<br>";
    }
    if (durasi === "") {
      message.innerHTML += "Durasi is still empty<br>";
    }
    if (lokasi === "") {
      message.innerHTML += "Lokasi is still empty<br>";
    }
    if (gambar === "") {
      message.innerHTML += "Gambar is not uploaded<br>";
    }

    // Validasi tanggal mulai dan tanggal selesai
    if (tanggalmulai !== "" && tanggalselesai !== "") {
      var startDate = new Date(tanggalmulai);
      var endDate = new Date(tanggalselesai);
      var currDate = new Date();

      if (startDate >= endDate) {
        message.innerHTML += "Perhatikan tanggal mulai harus sebelum atau tidak boleh sama dengan tanggal selesai<br>";
      }

      if (currDate > startDate && currDate > endDate){
        message.innerHTML += "Perhatikan tidak bisa menambah kegiatan sebelum tanggal hari ini<br>";
      }
    }

    if (message.innerHTML !== "") {
      message.hidden = false;
      event.preventDefault(); // Mencegah pengiriman data jika ada kesalahan
    } else {
      message.hidden = true;
    }
  });
});