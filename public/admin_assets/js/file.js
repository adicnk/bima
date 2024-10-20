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
    var y1 = document.getElementById("formBox_vokasi");
    var y2 = document.getElementById("formBox_mahasiswa");
    var z = document.getElementById("formBox_substansi");
    var z1 = document.getElementById("formBox_substansi_pb");
    var z2 = document.getElementById("formBox_luaran");
    var r = document.getElementById("formBox_rab");
    var s = document.getElementById("formBox_mitra");
    var s1 = document.getElementById("formbox_file_mitra");
    var t = document.getElementById("formBox_iku");
    var u = document.getElementById("formBox_sdgs");
    
    switch(name){
        case 'dosen' :
            x.removeAttribute("hidden");
            break;
        case 'non dosen':
            y.removeAttribute("hidden");
            break;
        case 'vokasi':
            y1.removeAttribute("hidden");
            break;
        case 'mahasiswa':
            y2.removeAttribute("hidden");
            break;
        case 'substansi':
            z.removeAttribute("hidden");
            break;
        case 'substansi_pb':
            z1.removeAttribute("hidden");
            break;
        case 'luaran':
            z2.removeAttribute("hidden");
            break;
        case 'rab':
            r.removeAttribute("hidden");
            break;
        case 'mitra':
            s.removeAttribute("hidden");
            break;
        case 'file_mitra':
            s1.removeAttribute("hidden");
        break;
        case 'iku':
            t.removeAttribute("hidden");
        break;
        case 'sdgs':
            u.removeAttribute("hidden");
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