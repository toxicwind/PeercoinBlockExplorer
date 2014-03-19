<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>

    <?php include('resource.php'); ?>
</head>
<body>
    <?php include('head.php'); ?>
    
    <div id="page_wrap">
        <div class="block_banner">

            <div class="blockbanner_left">
                Block Height: <?php echo $raw_block["height"]; ?>
            </div>

            <div class="blockbanner_right">
                Block Time: <?php echo $raw_block["time"]; ?>
            </div>

        </div>

        <div class="blockdetail">

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Block Version</div>     
                <div class="blockdetail_content">
                    <?php echo $raw_block["flags"]; ?>
                </div>      
            </div>

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Block Size</div>        
                <div class="blockdetail_content">
                    <?php echo $raw_block["size"]; ?>
                </div>      
            </div>

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Mint Value</div>        
                <div class="blockdetail_content">
                    <?php echo $raw_block["mint"]; ?>
                </div>      
            </div>

        </div>

        <div class="blockdetail">

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Block Bits</div>        
                <div class="blockdetail_content">
                    <?php echo $raw_block["bits"]; ?>
                </div>      
            </div>

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Block Nonce</div>       
                <div class="blockdetail_content">
                    <?php echo $raw_block["nonce"]; ?>
                </div>      
            </div>

            <div class="blockdetail_detail">
                <div class="blockdetail_header">Block Difficulty</div>      
                <div class="blockdetail_content">
                    <?php echo $raw_block["difficulty"]; ?>
                </div>      
            </div>

        </div>
        
        <div class="detail_display">
            <div class="detail_title">Merkle Root</div>
            <div class="detail_data"><?php $raw_block["merkleroot"]; ?></div>
        </div>
        <div class="detail_display">
            <div class="detail_title">Block Hash</div>
            <div class="detail_data">
                <a href="" title="View Block Details">
                    <?php $raw_block["block_hash"]; ?>
                </a>
            </div>
        </div>

        <div class="blocknav">

            <div class="blocknav_prev">
                <?php if ($raw_block["previousblockhash"]) { ?>
                <a href="?block_hash=<?php echo $raw_block["previousblockhash"]; ?>" title="View Previous Block"><- Previous Block</a>
                <?php } ?>
            </div>


            <div class="blocknav_news">
                Block Time: <?php echo $raw_block["time"]; ?>
            </div>


            <div class="blocknav_next">
                <?php if ($raw_block["nextblockhash"]) { ?>
                <a href="<?php echo $_SERVER["PHP_SELF"] . "?block_hash=" . $raw_block["nextblockhash"]; ?>" title="View Next Block">Next Block -></a>
                <?php } ?>
            </div>


        </div>


        <div class="txlist_header">
            Transactions In This Block
        </div>


        <div class="txlist_wrap">

        <?php foreach ($raw_block["tx"] as $index => $tx): ?>

            <div class="txlist_tx" >
                <a href="?transaction=<?php echo $tx; ?>" title="Transaction Details">
                    <?php echo $tx; ?>
                </a>
            </div>

        <?php endforeach; ?>

        </div>
    </div>

    <?php include('foot.php'); ?>
</body>
</html>



