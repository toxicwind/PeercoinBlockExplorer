<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{  
        //
        $this->load->library('ppc_daemon');

        //  If a block hash was provided the block detail is shown
        if (isset ($_REQUEST["block_hash"])) {
            $this->load_block_detail($_REQUEST["block_hash"], TRUE);

        //  If a block height is provided the block detail is show
        } elseif (isset ($_REQUEST["block_height"])) {
            $block_height = $_REQUEST["block_height"];
            if(empty ($block_height))
            {
                $network_info = $this->ppc_daemon->getinfo ();
                // Default to the latest block
                $block_height = intval($network_info["blocks"]);
            }
            $this->load_block_detail($block_height);

        //  If a TXid was provided the TX Detail is shown
        }elseif (isset ($_REQUEST["transaction"])) {
            $data['page_title'] = 'Transaction Detail Page';
            $this->load->view('tx_detail', $data);

        //  If there were no request parameters the menu is shown
        }else {
            $this->loadWelcome();
        }
        
	}

    function loadWelcome() 
    {   
        $data['page_title'] = 'Block Viewer';

        $network_info = $this->ppc_daemon->getinfo();
        $difficulty_info = $this->ppc_daemon->getdifficulty ();

        // Total Coins
        $totalcoins = intval($network_info["moneysupply"]);
        $totalcoins = number_format($totalcoins, 0 , '.' , ',');

        //Minted Reward last 1h/24h
        $hours = 1;
        list ($POS1, $POW1, $POScoins1, $POWcoins1, $avgPOScoins1, $avgPOWcoins1) = $this->get_num_pos($hours);
        list ($POS24, $POW24, $POScoins24, $POWcoins24, $avgPOScoins24, $avgPOWcoins24) = $this->get_num_pos($hours * 24);

        // Total Blocks
        $totalblocks = intval($network_info["blocks"]);

        // POS:POW Ratio
        $ratio1 = $this->ratio($POS1, $POW1); 
        $ratio24 = $this->ratio($POS24, $POW24);

        $data['network_info'] = $network_info;
        $data['difficulty_info'] = $difficulty_info;
        $data['totalcoins'] = $totalcoins;
        
        $data['POS1'] = $POS1;
        $data['POW1'] = $POW1;
        $data['POScoins1'] = $POScoins1;
        $data['POWcoins1'] = $POWcoins1;
        $data['avgPOScoins1'] = $avgPOScoins1;
        $data['avgPOWcoins1'] = $avgPOWcoins1;
        $data['POS24'] = $POS24;
        $data['POW24'] = $POW24;
        $data['POScoins24'] = $POScoins24;
        $data['POWcoins24'] = $POWcoins24;
        $data['avgPOScoins24'] = $avgPOScoins24;
        $data['avgPOWcoins24'] = $avgPOWcoins24;
        $data['totalblocks'] = number_format($totalblocks, 0 , '.' , ',');
        $data['ratio1'] = $ratio1;
        $data['ratio24'] = $ratio24;

        $this->load->view('welcome', $data);
    }

    function load_block_detail($block_id, $hash=FALSE)
    {
        $data['page_title'] = 'Block Detail Page';

        //$raw_block
        if ($hash == TRUE) {
            $raw_block = $this->ppc_daemon->getblock ($block_id);
        }
        else {
            $block_hash = $this->ppc_daemon->getblockhash(intval ($block_id));
            $raw_block = $this->ppc_daemon->getblock($block_hash);
        }

        $data['raw_block'] = $raw_block;

        $this->load->view('block_detail', $data);
    }


    /**
    * Get the number of pos block in the last @param hours
    *
    * @param    int $hours
    *
    * @return   int
    */
    function get_num_pos($hours) 
    {
        $network_info = $this->ppc_daemon->getinfo ();

        $currentblock = $network_info["blocks"];
        
        $iblock = intval($currentblock) - 6*$hours;
        
        $POScoins = 0;
        $POWcoins = 0;
        $POS = 0;
        while ($iblock != intval($currentblock))
        {
            $flag = $this->block_flag($iblock);
            $coins = $this->block_mint($iblock);
            if ($flag == "proof-of-stake")
            {
                $POS++;
                $POScoins += $coins;
            }
            else {
                $POWcoins += $coins;
            }
            $iblock++;
        }
        return array($POS, $POScoins , $POWcoins);
        
    }
    
    //Find the flag for a block
    
    function block_flag($block_id)
    {
        $block_hash = $this->ppc_daemon->getblockhash($block_id);
        $raw_block = $this->ppc_daemon->getblock($block_hash);
        $flags = $raw_block["flags"];
        return $flags;
    }
    
    // Find the minted or mined coins
    function block_mint($block_id)
    {
        $block_hash = $this->ppc_daemon->getblockhash($block_id);
        $raw_block = $this->ppc_daemon->getblock($block_hash);
        $mint = $raw_block["mint"];
        return $mint;
    }
    
    function ratio($a, $b) {
        $_a = $a;
        $_b = $b;

        while ($_b != 0) {

            $remainder = $_a % $_b;
            $_a = $_b;
            $_b = $remainder;   
        }

        $gcd = abs($_a);

        return ($a / $gcd)  . ':' . ($b / $gcd);

    }
}