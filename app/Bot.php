<?php
namespace Sprint;

class Bot
{

    public $command, $data, $hash;

    public function __construct($data){
        /* メンバ変数を設定 */
        $this->command = $data["command"];
        $this->data = $data["data"];

        return;
    }

    public function generateHash() {

        /* commandとdataを足してハッシュを求める */
        $num = $this->generateNum($this->command) + $this->generateNum($this->data);
        $this->hash = dechex($num);

        var_dump($this->hash);

        return;
    }

    private function generateNum($word){

        /* 文字ごとにASCII値が入った配列を生成 */
        $wordArr = str_split($word);
        foreach ($wordArr as $key => $value) {
            $wordArr[$key] = ord($value);
        }

        /* 連結して文字列にする(22桁以上は桁以上は指数表記に変える) */
        $wordNumStr = scientificNotation((float)implode($wordArr));

        /* 指数表記である時、".""から"e+"までと"e+"から後を連結 */
        if(preg_match("/e\+/", $wordNumStr)){
            $t = explode("e+", explode(".", $wordNumStr)[1]);
            $t[0] = ltrim($t[0], "0");
            $wordNumStr = implode($t);
        }

        return (int)$wordNumStr;
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
function scientificNotation($num) {
    if (overE20($num)) {
        return sprintf("%.16e", $num);
    }
    return sprintf("%.0f", $num);
}

function overE20($num) {
    $sn = sprintf("%e", $num);
    $e = explode("e+", $sn)[1];
    return $e > 20;
}
