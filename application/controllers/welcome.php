<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{  
        //
        $this->load->library('ppc_daemon');

        $data['page_title'] = 'Block Viewer';

        //  If a block hash was provided the block detail is shown
        if (isset ($_REQUEST["block_hash"])) {
            $data['page_title'] = 'Block Detail Page';
            $this->load->view('block_detail', $data);

        //  If a block height is provided the block detail is show
        } elseif (isset ($_REQUEST["block_height"])) {
            $data['page_title'] = 'Block Detail Page';
            $this->load->view('block_detail', $data);

        //  If a TXid was provided the TX Detail is shown
        }elseif (isset ($_REQUEST["transaction"])) {
            $data['page_title'] = 'Transaction Detail Page';
            $this->load->view('tx_detail', $data);

        //  If there were no request parameters the menu is shown
        }else {
            $data['network_info'] = $this->ppc_daemon->getinfo();
		    $this->load->view('welcome', $data);
        }
        
	}
}