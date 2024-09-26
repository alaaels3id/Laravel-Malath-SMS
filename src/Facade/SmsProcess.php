<?php

namespace Alaaelsaid\LaravelMalathSms\Facade;

use Illuminate\Support\Facades\Http;

class SmsProcess
{
    /**
     * @param $number
     * @param $message
     * @return array
     */
    public function send($number, $message): array
    {
        $number = is_array($number) ? implode(',', $number) : $number;

        $data = $this->malathData($number, $message);

        $result = Http::get('https://sms.malath.net.sa/httpSmsProvider.aspx', $data);

        $code = (integer)str_replace(" ","", $result);

        return ['code' => $code, 'message' => $this->getMessage($code)];
    }

    /**
     * @param $code
     * @return string
     */
    private function getMessage($code): string
    {
        return match ($code) {
            0       => "Message send successfully",
            101     => "Parameter are missing",
            104     => "Either user name or password are missing or your Account is on hold.",
            105     => "Credit are not available.",
            106     => "Wrong Unicode.",
            107     => "Blocked Sender Name.",
            108     => "Missing Sender name.",
            1010    => "SMS Text Grater that 6 part .",
            1011    => "There is a wrong content in the link",
            default => "Unknown Error !.",
        };
    }

    /**
     * @return int[]
     */
    private function malathErrorCodes(): array
    {
        return [101, 104, 105, 106, 107, 108, 1010];
    }

    /**
     * @param $number
     * @param $message
     * @return array
     */
    private function malathData($number, $message): array
    {
        return [
            'username' => config('malath.username'),
            'password' => config('malath.password'),
            'mobile'   => $number,
            'unicode'  => 'none',
            'message'  => $message,
            'sender'   => config('malath.sender_name'),
        ];
    }
}
