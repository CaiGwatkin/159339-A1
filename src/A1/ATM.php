<?php
/* GWATKIN 15146508 A1 */

/**
 * ATM class file.
 *
 * PHP version 7.1
 *
 * @package     cgwatkin\A1
 * @author      Cai Gwatkin <caigwatkin@gmail.com>
 * @license     https://opensource.org/licenses/MIT  The MIT License
 */

namespace cgwatkin\A1;

/**
 * # Class ATM
 *
 * Stores an array of accounts and modifies the balance of those accounts.
 *
 * ## Steps to use:
 * * Create new instance of ATM class
 * * Add account information from file
 * * Perform transactions from file
 * * New account data can then be output to file
 * * Other information about use can be extracted
 *
 * ## Uses the following classes from current package:
 * * Account
 * * BadTranz
 * * BadTranzException
 *
 * ## Code examples:
 * ```
 * // Create new instance
 * $atm = new ATM();
 *
 * // Surround following with try/catch block for file access errors
 * try {
 *     // Add account information (surround with try/catch block)
 *     $atm->addAccountsFromFile("inputFileName.txt");
 *
 *     // Perform transactions (surround with try/catch block)
 *     $atm->processTransactions("inputFileName.txt");
 *
 *     // Output new account information (surround with try/catch block)
 *     $atm->outputAccountData($outputFile);
 * }
 * catch (\Exception $ex) { print $ex->getMessage(); }
 *
 * // Get usage data
 * $numTransactions = $atm->getNumTransactions();
 * $numValidTransactions = $atm->getNumValidTransactions();
 * $badTransactions = $atm->getBadTransactions();
 * ```
 *
 * @see ATM::$_accounts                 The accounts loaded into the ATM.
 * @see ATM::$_numValidTransactions     The number of valid transactions processed by the ATM.
 * @see ATM::$_badTransactions          The BadTranz objects containing the details of attempted bad transactions.
 * @see ATM::__construct()              Constructor.
 * @see ATM::addAccountsFromFile()      To add new accounts from file.
 * @see ATM::processTransactions()      To process transactions from file.
 * @see ATM::outputAccountData()        To output account data to file.
 * @see ATM::getNumTransactions()       To get the number of transactions.
 * @see ATM::getNumValidTransactions()  To get the number of valid transactions.
 * @see ATM::getBadTransactions()       To get the bad transactions.
 * @see Account                         The account class.
 * @see BadTranz                        The bad transaction class.
 * @see BadTranzException               The bad transaction exception.
 *
 * @package cgwatkin\A1
 */
class ATM
{
    // {{{ properties

    /**
     * @var array The accounts loaded into the ATM (id => balance).
     */
    private $_accounts;

    /**
     * @var int The number of valid transactions processed by the ATM.
     */
    private $_numValidTransactions;

    /**
     * @var array The BadTranz objects containing the details of attempted bad transactions.
     */
    private $_badTransactions;

    // }}}

    // {{{ methods

    /**
     * ATM constructor.
     *
     * Sets defaults for private variables.
     */
    public function __construct()
    {
        $this->_accounts = array();
        $this->_numValidTransactions = 0;
        $this->_badTransactions = array();
    }

    /**
     * Gets the number of transactions processed.
     *
     * @return int The sum of the number of transactions attempted.
     */
    public function getNumTransactions()
    {
        return $this->_numValidTransactions + count($this->_badTransactions);
    }

    /**
     * Gets the number of valid transactions processed.
     *
     * @return int $this->_numValidTransactions The number of valid transactions
     *      processed.
     */
    public function getNumValidTransactions()
    {
        return $this->_numValidTransactions;
    }

    /**
     * Gets the array of bad transaction objects.
     *
     * @return array $this->_badTransactions An array of bad transaction
     *      objects.
     */
    public function getBadTransactions()
    {
        return $this->_badTransactions;
    }

    /**
     * Checks whether an ID corresponds to a valid account.
     *
     * @param int $id The ID from a transaction.
     * @throws BadTranzException with message detailing the reason why it is a
     *      bad transaction.
     */
    public function checkIfAccount($id)
    {
        if (!array_key_exists($id, $this->_accounts)) {
            throw new BadTranzException('Invalid account ID');
        }
    }

    /**
     * Adds all accounts from file to array of accounts.
     *
     * @param string $inputFile The file name from which accounts are to be
     *      loaded.
     * @throws \Exception Thrown if file unable to be opened.
     */
    public function addAccountsFromFile($inputFile)
    {
        $file = fopen($inputFile, "r");
        if ($file) {
            while (($line = fgets($file)) !== false) {
                list($id, $balance) = explode(" ", $line);
                $this->_accounts[$id] = new Account((int)$id, (float)$balance);
            }
            fclose($file);
        } else {
            $message = "Error opening account file: $inputFile";
            throw new \Exception($message);
        }
    }

    /**
     * Processes transactions from file and updates account balances.
     *
     * @param string $inputFile The file name from which the transaction details
     *      are to be processed.
     * @throws \Exception Thrown if file unable to be opened.
     */
    public function processTransactions($inputFile)
    {
        $file = fopen($inputFile, "r");
        if ($file) {
            $lineNum = 0;
            while (($line = fgets($file)) !== false) {
                list($id, $type, $amount) = explode(" ", $line);
                if ($id == 'ID') {
                    $lineNum++;
                    continue;
                }
                try {
                    $this->checkIfAccount($id);
                    $this->_accounts[$id]->updateBalance($type, (float) $amount);
                    $this->_numValidTransactions++;
                } catch (BadTranzException $badTranzException) {
                    $this->_badTransactions[] = new BadTranz($lineNum, $id,
                        $type, $amount, $badTranzException->getMessage());
                } finally {
                    $lineNum++;
                }
            }
            fclose($file);
        } else {
            $message = "Error opening transaction file: $inputFile";
            throw new \Exception($message);
        }
    }

    /**
     * Saves account data to file.
     *
     * @param string $outputFile The file name to which the output should be
     *      written.
     * @throws \Exception Thrown if file unable to be opened for writing.
     */
    public function outputAccountData($outputFile)
    {
        $file = fopen($outputFile, "w");
        if ($file) {
            foreach ($this->_accounts as $account) {
                fwrite($file, $account->__toString() . PHP_EOL);
            }
        } else {
            $message = "Error opening output file: $outputFile";
            throw new \Exception($message);
        }
    }
    // }}}
}
