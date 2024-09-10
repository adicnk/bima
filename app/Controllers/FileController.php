<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\DownloadResponse;
use CodeIgniter\HTTP\Response;
use Rector\Caching\ValueObject\CacheFilePaths;

class FileController extends Controller
{
    public function download($filePath)
    {   
        return $this->response->download('file/'.$filePath, null);
    }
}