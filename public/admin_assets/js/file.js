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

function showForm(name) {
    var x = document.getElementById("formBox");
    var y = document.getElementById("formBox_nondosen");
    switch(name){
        case 'dosen' :
            x.removeAttribute("hidden");
            break;
        case 'non dosen':
            y.removeAttribute("hidden");
            break;
    }
}

function deleteAnggota(id){
    var x = document.getElementById("anggotaID");
    x.value = id;
}