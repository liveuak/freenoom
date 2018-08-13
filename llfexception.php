<?php
/**
 * 业务逻辑异常时抛出
 * @author mybsdc <mybsdc@gmail.com>
 * @date 2018/8/10
 * @time 14:48
 */

class LlfException extends \Exception
{
    /**
     * @var array 语言包
     */
    public static $lang;

    public function __construct($code, $additional = null, \Exception $previous = null)
    {
        self::$lang === null && self::$lang = require 'lang.php';

        $message = isset(self::$lang[$code]) ? self::$lang[$code] : '';

        if ($additional !== null) {
            if (is_array($additional)) {
                array_unshift($additional, $message);
                $message = call_user_func_array('sprintf', $additional);
            } else if (is_string($additional)) {
                $message = sprintf($message, $additional);
            }
        }

        parent::__construct($message . "(Error code: {$code})", $code, $previous);
    }
}