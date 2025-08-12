<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\Modelberita;
use App\Models\Modelfoto;
use App\Models\Modelgallery;
use App\Models\Modelstaf;
use App\Models\Modelmapel;
use App\Models\Modelguru;
use App\Models\Modelkategori;
use App\Models\Modelsiswa;
use App\Models\Modelkelas;
use App\Models\Modelkonfigurasi;
use App\Models\Modelpengumuman;
use App\Models\Modeluser;
use App\Models\Modelekstrakurikuler;


class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'Tgl_indo'];
    protected $konfigurasi;
    protected $kategori;
    protected $gallery;
    protected $berita;
    protected $foto;
    protected $pengumuman;
    protected $siswa;
    protected $guru;
    protected $mapel;
    protected $session;
    protected $staf;
    protected $kelas;
    protected $user;
    protected $ekstrakurikuler;
    protected $db;

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        $this->session = \Config\Services::session();
        $this->staf = new Modelstaf;
        $this->mapel = new Modelmapel;
        $this->guru = new Modelguru;
        $this->siswa = new Modelsiswa($request);
        $this->kelas = new Modelkelas;
        $this->kategori = new Modelkategori;
        $this->berita = new Modelberita;
        $this->gallery = new Modelgallery;
        $this->foto = new Modelfoto;
        $this->pengumuman = new Modelpengumuman;
        $this->konfigurasi = new Modelkonfigurasi;
        $this->user = new Modeluser;
        $this->ekstrakurikuler = new Modelekstrakurikuler;
    }
}
