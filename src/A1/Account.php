<?php
/* GWATKIN 15146508 A1 */

/**
 * Account class file.
 *
 * PHP version 7.1
 *
 * @package     cgwatkin\A1
 * @author      Cai Gwatkin <caigwatkin@gmail.com>
 * @license     https://opensource.org/licenses/MIT  The MIT License
 */

namespace cgwatkin\A1;

/**
 * # Class Account
 *
 * A bank account with an ID and balance which can process transactions.
 *
 * ## Code examples:
 * ```
 * // Create new instance
 * $account = new Account((int) $id, (float) $balance);
 *
 * // Update balance, surround in try/catch block as exception is thrown if bad transaction.
 * try {
 *     $account.updateBalance($type, (float) $amount);
 * }
 * catch (BadTranzException) { // Deal with bad transaction. }
 *
 * // Get data
 * $id = $account->getId();
 * $balance = $account->getBalance();
 * ```
 *
 * @package cgwatkin\A1
 * @see     BadTranzException The exception generated when a bad transaction is attempted to be processed.
 */
class Account
{
    // {{{ properties

    /**
     * @var int $_id The account ID number.
     */
    private $_id;

    /**
     * @var float The balance of the account.
     */
    private $_balance;

    // }}}

    // {{{ methods
    /**
     * Account constructor.
     *
     * @param int $id The ID of the account.
     * @param float $balance The initial balance of the account.
     */
    public function __construct(int $id, float $balance)
    {
        $this->_id = $id;
        $this->_balance = $balance;
    }

    /**
     * Gets the account ID.
     *
     * @return int $this->_id The ID of the account.
     */
    public function getID()
    {
        return $this->_id;
    }

    /**
     * Gets the account balance.
     *
     * @return float $this->_balance The balance of the account.
     */
    public function getBalance()
    {
        return $this->_balance;
    }

    /**
     * Updates the balance of the account.
     *
     * Uses the passed parameter to increase/decrease the account balance.
     *
     * @param string $type The type of transaction (Deposit or Withdrawal).
     * @param float $amount The change in balance (positive or negative).
     * @throws BadTranzException
     */
    public function updateBalance($type, float $amount)
    {
        if ($amount < 0.0) {
            throw new BadTranzException('Negative transaction amount', 1);
        } else if ($type == 'W') {
            if ($amount > $this->_balance) {
                throw new BadTranzException('Insufficient balance', 2);
            } else {
                $this->_balance = $this->_balance - $amount;
            }
        } else {
            $this->_balance = $this->_balance + $amount;
        }
    }

    /**
     * Creates and returns a string of data about the account.
     *
     * @return string The Account object as a string: "ID BALANCE"
     */
    public function __toString()
    {
        return $this->_id . ' ' . $this->_balance;
    }

    // }}}
}
