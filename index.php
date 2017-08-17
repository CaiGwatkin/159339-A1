<?php
/* GWATKIN 15146508 A1 */

namespace caigwatkin\A1;

require 'autoloader.php';

define("IN_ACC_FILE",   "acct.txt");            // Sets the input file containing account information.
define("IN_TRANZ_FILE", "tranz.txt");           // Sets the input file containing transaction information.
define("OUT_ACC_FILE",  "update.txt");          // Sets the output file for storing account information.

$atm = new ATM();
try {
    $atm->addAccountsFromFile(IN_ACC_FILE);
    $atm->processTransactions(IN_TRANZ_FILE);
    $atm->outputAccountData(OUT_ACC_FILE);
    $numTransactions = $atm->getNumTransactions();
    $numValidTransactions = $atm->getNumValidTransactions();
    $badTransactions = $atm->getBadTransactions();
    
    print   "<p>There were $numTransactions transactions in total.</p>";
    print   "<p>There were $numValidTransactions valid transactions.</p>";
    print   "<p>The following transactions are invalid:</p>";
    print   "<table>";
    print       "<tr>";
    print           "<th>Line #</th>";
    print           "<th>ID</th>";
    print           "<th>Type</th>";
    print           "<th>Amount</th>";
    print           "<th>Reason</th>";
    print       "</tr>";
    foreach ($badTransactions as $transaction) {
        /* @var $transaction BadTranz */
        $line = $transaction->getLine();
        $id = $transaction->getID();
        $type = $transaction->getType();
        $amount = $transaction->getAmount();
        $reason = $transaction->getReason();
        print   "<tr>";
        print       "<td>$line</td>";
        print       "<td>$id</td>";
        print       "<td>$type</td>";
        print       "<td>$amount</td>";
        print       "<td>$reason</td>";
        print   "</tr>";
    }
    print   "</table>";
}
catch (\Exception $ex) {
    $message = $ex->getMessage();
    print "<h1>$message</h1>";
}
