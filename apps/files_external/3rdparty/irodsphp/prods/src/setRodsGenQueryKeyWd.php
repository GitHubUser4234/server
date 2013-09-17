<?php
$RODS_tree_root = dirname(__FILE__) . "/../../..";

$capi_genque_KeyWd_file = $RODS_tree_root . "/lib/core/include/rodsKeyWdDef.h";
$prods_genque_keywd_file = $RODS_tree_root . "/clients/prods/src/RodsGenQueryKeyWd.inc.php";

// Add more Query keywd here, if you wish. It will be added to the default
// RODS Gen Que number. Note that these number are for web server/client
// only. RODS server does not recongnize them.
$new_genque_keywds = array(//array("SOMEKEYWD", "SOMESTR"),
);

$value_pairs = array();

$lines = explode("\n", file_get_contents($capi_genque_KeyWd_file));
foreach ($lines as $line) {
    if (strlen($line) < 8) continue;
    if (substr($line, 0, 7) == '#define') {
        $rest = trim(substr($line, 7));
        $tokens = preg_split("/\s+/", $rest);
        if (count($tokens) < 2)
            continue;
        $val1 = NULL;
        $val2 = NULL;

        foreach ($tokens as $token) {

            if (strlen($token) > 1) {
                if (empty($val1)) $val1 = trim($token);
                else {

                    if (($token{0} == '"') /*&&($token{strlen($token)-1}=='"')*/) {
                        if (empty($val2))
                            $val2 = trim($token);
                    }
                }
            }
        }
        if ((!empty($val1)) && (!empty($val2))) {
            array_push($value_pairs, array($val1, $val2));
        }
    }
}
foreach ($new_genque_keywds as $new_code_pair) {
    if ((!is_array($new_code_pair)) || (count($new_code_pair) != 2))
        die("unexpected new_code_pair:$new_code_pair\n");
    array_push($value_pairs, $new_code_pair);
}

$outputstr = "<?php \n" .
    "/* This file is generated by " . basename(__FILE__) .
    "   Please modify that file if you wish to update the " .
    "   Gen Query keywords.            */\n";
$outputstr = $outputstr . '$GLOBALS[\'PRODS_GENQUE_KEYWD\']=array(' . "\n";
foreach ($value_pairs as $value_pair) {
    $val1 = $value_pair[0];
    $val2 = $value_pair[1];
    $outputstr = $outputstr . "  '$val1' => $val2,\n";
}
$outputstr = $outputstr . ");\n";

$outputstr = $outputstr . '$GLOBALS[\'PRODS_GENQUE_KEYWD_REV\']=array(' . "\n";
foreach ($value_pairs as $value_pair) {
    $val1 = $value_pair[0];
    $val2 = $value_pair[1];
    $outputstr = $outputstr . "  $val2 => '$val1',\n";
}
$outputstr = $outputstr . ");\n";

$outputstr = $outputstr . "?>\n";
file_put_contents($prods_genque_keywd_file, $outputstr);
