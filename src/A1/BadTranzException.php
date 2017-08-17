<?php
/* GWATKIN 15146508 A1 */

/**
 * BadTranzException exception class file.
 *
 * PHP version 7.1
 *
 * @package     cgwatkin\A1
 * @author      Cai Gwatkin <caigwatkin@gmail.com>
 * @license     https://opensource.org/licenses/MIT  The MIT License
 */

namespace cgwatkin\A1;

/**
 * Class BadTranzException
 *
 * An exception to be thrown when a bad transaction is attempted to be
 * processed. Extends \Exception class.
 *
 * ## Code example:
 * ```
 * // Throw new bad transaction exception
 * throw new BadTranzException($message, $code);
 * ```
 *
 * @package cgwatkin\A1
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
