$(document).ready(function() {
    bsCustomFileInput.init()
})

function myFile() {
    var checkBox = document.getElementById("isFile");
    var gambar = document.getElementById("fileUpload");
    if (checkBox.checked == false) {
        gambar.disabled = true;
    } else {
        gambar.disabled = false;
    }

}

function showForm() {
    var x = document.getElementById("formBox");
    x.removeAttribute("hidden");
}

function deleteAnggota(id){
    var x = document.getElementById("anggotaID");
    x.value = id;
}