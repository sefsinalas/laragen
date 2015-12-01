<?php namespace Mayconbordin\Generator\Tests;

use Mayconbordin\Generator\Migrations\SchemaParser;

class SchemaParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new SchemaParser;
        
        $schema = "username:string, email:string:unique:index, test:string:default(hello),"
                . "user_type_id:integer:unsigned:nullable:foreign";
        $result = $parser->parse($schema);

        $this->assertEquals("username", $result[0]->getName());
        $this->assertEquals("string", $result[0]->getType());

        $this->assertEquals("email", $result[1]->getName());
        $this->assertEquals("string", $result[1]->getType());
        $this->assertEquals(true, $result[1]->isUnique());

        $this->assertEquals("test", $result[2]->getName());
        $this->assertEquals("string", $result[2]->getType());
        $this->assertEquals("hello", $result[2]->getDefault());

        $this->assertEquals("user_type_id", $result[3]->getName());
        $this->assertEquals("integer", $result[3]->getType());
        $this->assertEquals(true, $result[3]->isUnsigned());
        $this->assertEquals(true, $result[3]->isNullable());

        $foreign =  $result[3]->getForeign();
        $this->assertEquals("id", $foreign['references']);
        $this->assertEquals("user_types", $foreign['on']);
    }
}
