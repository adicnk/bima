<?php
namespace App\Controllers;

use App\Models\DosenMDL;
use App\Models\AnggotaPBMDL;
use App\Models\VokasiMDL;
use App\Models\MahasiswaMDL;
use App\Models\SubstansiPBMDL;
use App\Models\LuaranMDL;
use App\Models\SDGsMDL;
use App\Models\IKUMDL;
use App\Models\RabPBMDL;
use App\Models\RabDetailPBMDL;
use App\Models\MitraPBMDL;
use App\Models\PendukungMDL;
use App\Models\PengabdianMDL;


class DeletePB extends BaseController
{

    protected $dosenModel, $anggotaModel, $vokasiModel, $mahasiswaModel, $substansiModel, $luaranModel,
                $sdgsModel, $ikuModel, $rabModel, $rabDetailModel, $mitraModel, $pendukungModel, $pengabdianModel;

    public function __construct()
    {
        $this->dosenModel = new DosenMDL();
        $this->anggotaModel = new AnggotaPBMDL();
        $this->vokasiModel = new VokasiMDL();
        $this->mahasiswaModel = new MahasiswaMDL();
        $this->substansiModel = new SubstansiPBMDL();
        $this->luaranModel = new LuaranMDL();
        $this->sdgsModel = new SDGsMDL();
        $this->ikuModel = new IKUMDL();
        $this->rabModel = new RabPBMDL();
        $this->rabDetailModel = new RabDetailPBMDL();
        $this->mitraModel = new MitraPBMDL();
        $this->pendukungModel = new PendukungMDL();
        $this->pengabdianModel = new PengabdianMDL();
    }

    public function anggotaDosen($pengabdianID,$dosen_id,$anggotaID)
    {
        $this->anggotaModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);

    }

    public function anggotaVokasi($pengabdianID,$dosen_id,$anggotaID)
    {
        $this->vokasiModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function anggotaMahasiswa($pengabdianID,$dosen_id,$anggotaID)
    {
        $this->mahasiswaModel->delAnggota($anggotaID);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function substansi($pengabdianID,$dosen_id,$id)
    {
        $this->substansiModel->delAnggota($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function luaran($pengabdianID,$dosen_id,$id)
    {
        $this->luaranModel->delAnggota($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function sdgs($pengabdianID,$dosen_id,$id)
    {
        $this->sdgsModel->delAnggota($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function iku($pengabdianID,$dosen_id,$id)
    {
        $this->ikuModel->delAnggota($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function rab($pengabdianID,$dosen_id,$id)
    {
        $this->rabModel->where(['pengabdian_id'=>$pengabdianID, 'dosen_id'=>$dosen_id]);
        $query = $this->rabModel->findAll();
        foreach ($query as $qry) :
            $this->rabDetailModel->delRab($qry['id']);
        endforeach;
        $this->rabModel->delRab($pengabdianID,$dosen_id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function item($pengabdianID,$dosen_id,$id)
    {
        $this->rabDetailModel->delItem($id);

        $db = \Config\Database::connect();
        $query =$db->query(
            'SELECT SUM(rd.total) as total FROM rab_pb r '.
            'INNER JOIN rab_detail_pb rd ON r.id = rd.rab_id '.
            ' WHERE r.pengabdian_id='.$pengabdianID.' AND r.dosen_id='.$dosen_id
        )->getResultArray();
        $idx=1;
        foreach ($query as $qry) :
            if ($idx==1) :
                $total = $qry['total'];
        endif; endforeach;
        $db = \Config\Database::connect();
        $db->query('
            UPDATE rab_pb SET dana_direncanakan='.$total.
            ' WHERE pengabdian_id='.$pengabdianID.' AND dosen_id='.$dosen_id
        );        

        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function mitra($pengabdianID,$dosen_id,$id)
    {
        $this->mitraModel->delMitra($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function pendukung($pengabdianID,$dosen_id,$id)
    {
        $this->pendukungModel->delPendukung($id);
        $data = $this->dataAnggotaNon($pengabdianID,$dosen_id);
        return view('detail/inpb', $data);
    }

    public function dataAnggotaNon($pengabdianID,$dosen_id){
        $data = [
            'title' => "Input Data Pengabdian",
            'judul'=> $this->pengabdianModel->searchJudulPengabdian($pengabdianID),
            'id'=> $pengabdianID,
            'dosen_id'=>$dosen_id,
        ];
        return $data;
    }
    
}

