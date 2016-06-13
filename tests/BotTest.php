<?php
namespace Sprint;

class BotTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateHash()
    {
        $data = [
            "command" => "color",
            "data" => "red",
        ];
        $bot = new Bot($data);
        $bot->generateHash();

        $this->assertEquals($data["command"], $bot->command);
        $this->assertEquals($data["data"], $bot->data);
        $this->assertEquals("5a2421317676", $bot->hash);
    }

    public function testGenerateHashWithLongData()
    {
        $data = [
            "command" => "xxxxxxxx",
            "data" => "yyyyyyyyy",
        ];
        $bot = new Bot($data);
        $bot->generateHash();

        $this->assertEquals($data["command"], $bot->command);
        $this->assertEquals($data["data"], $bot->data);
        $this->assertEquals("5b92ee76ecdc285", $bot->hash);
    }

    public function testGenerateHashParse()
    {
        $data = [
            "command" => "daaaaaaaaaaaaaaaaaa",
            "data" => "dl",
        ];
        $bot = new Bot($data);
        $bot->generateHash();

        $this->assertEquals($data["command"], $bot->command);
        $this->assertEquals($data["data"], $bot->data);
        $this->assertEquals("22cf35f16189ca", $bot->hash);
    }
}
