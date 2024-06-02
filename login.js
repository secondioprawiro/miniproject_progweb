//fungsi cek apakah username dan password field masih kosong atau tidak
function validasi() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;		
  if (username != "" && password!="") {
    return true;
  }else{
    alert('Username dan Password harus di isi !');
    return false;
  }
}
