<?php
/* GWATKIN 15146508 A1 */

namespace caigwatkin\A1;

/**
 * Class BadTranzException
 *
 * An exception to be thrown when a bad transaction is attempted to be
 * processed.
 *
 * @package caigwatkin\A1
 */
class BadTranzException extends \Exception
{
    /**
     * BadTranzException constructor.
     *
     * @param string $message The exception message.
     * @param int $code The code of the exception.
     */
    public function BadTranzException($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
