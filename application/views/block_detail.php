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
        <div class="coin-overview detail-overview">
            <dl>
                <dt>Block Height:</dt>
                <dd><b><?php echo $raw_block["height"]; ?></b></dd>
            </dl>
            <dl>
                <dt>Block Time:</dt>
                <dd><?php echo $raw_block["time"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Version</dt>
                <dd><?php echo $raw_block["flags"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Size</dt>
                <dd><?php echo $raw_block["size"]; ?>B</dd>
            </dl>
            <dl>
                <dt>Mint Value</dt>
                <dd><?php echo $raw_block["mint"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Bits</dt>
                <dd><?php echo $raw_block["bits"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Nonce</dt>
                <dd><?php echo $raw_block["nonce"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Difficulty</dt>
                <dd><?php echo $raw_block["difficulty"]; ?></dd>
            </dl>
            <dl>
                <dt>Merkle Root</dt>
                <dd><?php echo $raw_block["merkleroot"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Hash</dt>
                <dd>
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?block_hash='.$raw_block['hash'] ?>" title="View Block Details">
                    <?php echo $raw_block['hash']; ?>
                    </a>
                </dd>
            </dl>
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



