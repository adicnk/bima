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
    var z = document.getElementById("formBox_substansi");
    var r = document.getElementById("formBox_rab");
    
    switch(name){
        case 'dosen' :
            x.removeAttribute("hidden");
            break;
        case 'non dosen':
            y.removeAttribute("hidden");
            break;
        case 'substansi':
            z.removeAttribute("hidden");
            break;
        case 'rab':
            r.removeAttribute("hidden");
            break;

    }
}

function insertValue(name){
    var x = document.getElementById("tahunRAB");
    var t = document.getElementById("tambahTahun");
    var u = document.getElementById("tahunSelect");
    switch(name){
        case "rab":
            if (u.value==""){
                return
            } else {
                t.removeAttribute("hidden");
                x.value = u.value;
            }
        break;
    }    
}

function deleteAnggota(id){
    var x = document.getElementById("anggotaID");
    x.value = id;
}