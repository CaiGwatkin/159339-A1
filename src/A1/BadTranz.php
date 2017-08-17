<?php
/* GWATKIN 15146508 A1 */

namespace caigwatkin\A1;

/**
 * Class BadTranz
 *
 * Stores details about bad transactions that have been caught.
 *
 * @package caigwatkin\A1
 */
class BadTranz
{
    private $_line;
    private $_id;
    private $_type;
    private $_amount;
    private $_reason;

    /**
     * BadTranz constructor.
     *
     * @param int $line The line on which the transaction existed.
     * @param int $id The ID for the bad transaction.
     * @param string $type The type of transaction.
     * @param float $amount The amount for the transaction.
     * @param string $reason The reason why it is a bad transaction.
     */
    public function __construct($line, $id, $type, $amount, $reason)
    {
        $this->_line = $line;
        $this->_id = $id;
        $this->_type = $type;
        $this->_amount = $amount;
        $this->_reason = $reason;
    }

    /**
     * Gets the line.
     *
     * @return int $this->_line The line on which the transaction existed.
     */
    public function getLine()
    {
        return $this->_line;
    }

    /**
     * Gets the ID.
     *
     * @return int $this->_id The ID for the bad transaction.
     */
    public function getID()
    {
        return $this->_id;
    }

    /**
     * Gets the type.
     *
     * @return string $this->_type The type of transaction.
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Gets the amount.
     *
     * @return float $this->_amount The amount for the transaction.
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Gets the reason.
     *
     * @return string $this->_reason The reason why it is a bad transaction.
     */
    public function getReason()
    {
        return $this->_reason;
    }
}
