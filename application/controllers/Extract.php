<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class Extract extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('upload');
    }

    public function index()
    {
        $this->load->view('upload_gambar');
    }

    public function proses()
    {
        $num_results        = (!empty($_POST['num_results'])) ? $_POST['num_results'] : 24;
        $delta              = (!empty($_POST['delta'])) ? $_POST['delta'] : 255;
        $reduce_brightness  = (isset($_POST['reduce_brightness'])) ? $_POST['reduce_brightness'] : 0;
        $reduce_gradients   = (isset($_POST['reduce_gradients'])) ? $_POST['reduce_gradients'] : 0;

        $this->load->library('Color_extract');
        $color = new Color_extract();

        $name_post = 'imgFile';
        $path_file = 'assets/upload';
        $new_file  = 'assets/upload/thumb';
        $width     = '500';
        $height    = '500';
        // $upload = upload_photo($name_post, 10024, false, $path_file, $width, $height, FALSE, $path_file);
        $upload = upload_files($name_post,10024, false, 'jpg|jpeg|png|gif|jpg2|bmp', $path_file);
        if ($upload['respons']) {
            $getColor = $color->Get_Color(FCPATH.$path_file.'/'.$upload['data'], $num_results, $reduce_brightness, $reduce_gradients, $delta);

            $data = array(
                'getColor'  => $getColor,
                'file'      => $upload['data']
            );
        } else {
            $getColor = false;

            $data = array(
                'getColor'  => $getColor
            );
        }

        

        $this->load->view('hasil_extract', $data);
    }
}
