<?php
namespace Sprint;

class Bot
{

    public $command, $data, $hash;

    public function __construct($data){
            $this->command = $data["command"];
            $this->data = $data["data"];

            return;
    }

    public function generateHash()
    {
        $commandArr = str_split($this->command);
        $dataArr = aystr_split($this->data);

        foreach ($commandArr as $key => $value) {
            $commandArr[$key] = ord($value);
        }

        foreach ($dataArr as $key => $value) {
            $dataArr[$key] = ord($value);
        }

        var_dump($commandArr);
    }
}


/**
 * Return scientific notation if after 'e+' was more than 20.
 * If it was less equal than 20, will return normal integer string.
 *
 * e.g.
 * 1000000000000000000000 => 1e+21
 * => return 1.0000000000000000e+21
 *
 * 10000000000000000000 => 1e+19
 * => return 10000000000000000000
 *
 * @param $num integer
 *
 * @return string
 * Note:
 * Since PHP use scientific notation from 1e+19,
 * this function return value with string.
 */
function scientificNotation($num)
{
    if (overE20($num)) {
        return sprintf("%.16e", $num);
    }
    return sprintf("%.0f", $num);
}

function overE20($num)
{
    $sn = sprintf("%e", $num);
    $e = explode("e+", $sn)[1];
    return $e > 20;
}
