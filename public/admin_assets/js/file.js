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

function usulan(){
    var checkbox = document.getElementById("usulan");
    var yesno = document.getElementById("yesno");
        if (checkbox.checked == true) {
            yesno.removeAttribute("hidden");
            checkbox.disabled = true;
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
    var s1 = document.getElementById("formBox_file_mitra");
    var t = document.getElementById("formBox_iku");
    var u = document.getElementById("formBox_sdgs");
    var v = document.getElementById("formBox_pendukung");
    
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
        case 'pendukung':
            v.removeAttribute("hidden");
        break;
    
    }
}

function insertValue(name){
    var x = document.getElementById("tahunRAB");
    var t = document.getElementById("tambahTahun");
    var u = document.getElementById("tahunSelect");

    var p = document.getElementById("fileMitra");
    var q = document.getElementById("tambahFile");
    var r = document.getElementById("mitraSelect");

    
    switch(name){
        case "rab":
            if (u.value==""){
                return
            } else {
                t.removeAttribute("hidden");
                x.value = u.value;
            }
        break;
        case "mitra":
            if (r.value==""){
                return
            } else {
                q.removeAttribute("hidden");
                p.value = r.value;
            }
        break;
    }    
}

function deleteAnggota(id){
    var x = document.getElementById("anggotaID");
    x.value = id;
}