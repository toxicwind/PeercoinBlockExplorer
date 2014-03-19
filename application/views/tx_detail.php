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
                <dt>Transaction:</dt>
                <dd><b><?php echo $raw_tx["txid"]; ?></b></dd>
            </dl>
            <dl>
                <dt>TX Version</dt>
                <dd><?php echo $raw_tx["version"]; ?></dd>
            </dl>
            <dl>
                <dt>TX Time</dt>
                <dd><?php echo date("F j, Y, H:i:s", $raw_tx["time"]); ?></dd>
            </dl>
            <dl>
                <dt>Lock Time</dt>
                <dd><?php echo $raw_tx["locktime"]; ?></dd>
            </dl>
            <dl>
                <dt>Confirmations</dt>
                <dd><?php echo $raw_tx["confirmations"]; ?></dd>
            </dl>
            <dl>
                <dt>Block Hash</dt>
                <dd>
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?block_hash='.$raw_tx['blockhash'] ?>" title="View Block Details">
                    <?php echo $raw_tx['blockhash']; ?>
                    </a></dd>
            </dl>
            <?php if (isset ($raw_tx["tx-comment"]) && $raw_tx["tx-comment"] != ""){ ?>
            <dl>
                <dt>TX Message</dt>
                <dd><?php echo htmlspecialchars ($raw_tx["tx-comment"]); ?></dd>
            </dl>
            <?php } ?>
            <dl>
                <dt>HEX Data</dt>
                <dd><?php echo $raw_tx["hex"]; ?></dd>
            </dl>
        </div>
        
        <div class="txlist_header">
            Transaction Inputs
        </div>
        <div>
            <?php
            foreach ($raw_tx["vin"] as $key => $txin)
            {
                echo $key;

                if (isset ($txin["coinbase"]))
                {
                    echo "Coinbase".$txin["coinbase"];
                    echo "Sequence".$txin["sequence"];
                }
                
                else
                {   
                    echo "TX ID".$txin["txid"];
                    echo "Coinbase".$txin["vout"];
                    echo "Coinbase".$txin["sequence"];
                    echo "Coinbase".$txin["scriptSig"]["asm"];
                    echo "Coinbase".$txin["scriptSig"]["hex"];
                }
            }
            ?>
        </div>

        <div class="txlist_header">
            Transaction Outputs
        </div>
        <div>
            <?php
                foreach ($raw_tx["vout"] as $key => $txout)
                {
                    echo "Output Transaction ".$key;
                    echo "TX Value".$txout["value"];
                    echo "TX Type".$txout["scriptPubKey"]["type"];
                    echo "Required Sigs".$txout["scriptPubKey"]["reqSigs"];
                    echo "Script Pub Key (ASM)".$txout["scriptPubKey"]["asm"];
                    echo "Script Pub Key (HEX)".$txout["scriptPubKey"]["hex"];
                    echo "Coinbase".$txout["vout"];
                    echo "Coinbase".$txout["vout"];
                    echo "Coinbase".$txout["vout"];
                    echo "Coinbase".$txout["vout"];
                    echo "Coinbase".$txout["vout"];

                
                    if (isset ($txout["scriptPubKey"]["addresses"]))
                    {
                        foreach ($txout["scriptPubKey"]["addresses"] as $key => $address);
                        {
                            echo "Address ".$key.$address;
                        }
                    }
                    
                }
            ?>
        </div>

        <textarea name="rawtrans" rows="10" cols="80" style="text-align:left;">  
        <?php print_r ($raw_tx); ?>
        </textarea>
    </div>

    <?php include('foot.php'); ?>
</body>
</html>



