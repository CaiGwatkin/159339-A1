<?php
/* GWATKIN 15146508 A1 */

/**
 * Index file to run ATM simulator.
 *
 * Simulates an ATM loading account data and processing transactions. The ATM class is used to load account information
 * from file and process transactions from file.
 *
 * PHP version 7.1
 *
 * @package     cgwatkin\A1
 * @license     https://opensource.org/licenses/MIT  The MIT License
 * @see         \cgwatkin\A1\ATM The ATM class used for the simulation.
 */

namespace cgwatkin\A1;

/**
 * This file uses an autoloader to load classes from the cgwatkin\A1 package.
 */
require 'autoloader.php';

// {{{ constants

/**
 * The input file containing account information.
 */
define("IN_ACC_FILE",   "acct.txt");

/**
 * The input file containing transaction information.
 */
define("IN_TRANZ_FILE", "tranz.txt");

/**
 * The output file for storing account information.
 */
define("OUT_ACC_FILE",  "update.txt");

// }}}

// {{{ Running simulation

/**
 * The following code runs the ATM simulation using the ATM class. HTML is then generated to display the result of the
 * simulation.
 *
 * @see \cgwatkin\A1\ATM The ATM class.
 */
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

// }}}
