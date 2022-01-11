<?php

use Illuminate\Support\Facades\Http;

class SmsProcess
{
    /**
     * @param $number
     * @param $message
     * @return array
     */
    public static function send($number, $message)
    {
        $data = self::malathData(config('malath.username'), config('malath.password'), $number, config('malath.sender_name'), $message);

        $result = Http::get('http://sms.malath.net.sa/httpSmsProvider.aspx', $data);

        $code = (integer)str_replace(" ","", $result);

        return ['code' => $code, 'message' => self::get_malath_message_by_code($code)];
    }

    /**
     * @param $code
     * @return string
     */
    private static function get_malath_message_by_code($code)
    {
        switch ($code)
        {
            case 0:
                return "Message send successfully";
                break;

            case 101:
                return "Parameter are missing";
                break;

            case 104:
                return "Either user name or password are missing or your Account is on hold.";
                break;

            case 105:
                return "Credit are not available.";
                break;

            case 106:
                return "Wrong Unicode.";
                break;

            case 107:
                return "Blocked Sender Name.";
                break;

            case 108:
                return "Missing Sender name.";
                break;

            case 1010:
                return "SMS Text Grater that 6 part .";
                break;

            default:
                return "Unknown Error !.";
        }
    }

    /**
     * @return int[]
     */
    private static function malathErrorCodes()
    {
        return [101, 104, 105, 106, 107, 108, 1010];
    }

    /**
     * @param $username
     * @param $password
     * @param $number
     * @param $sms_sender
     * @param $message
     * @return array
     */
    private static function malathData($username, $password, $number, $sms_sender, $message)
    {
        return [
            'username' => $username,
            'password' => $password,
            'mobile'   => $number,
            'unicode'  => 'none',
            'message'  => $message,
            'sender'   => $sms_sender,
        ];
    }
}
