<?php
use Codeception\Util\Stub;
use lib\DataProvider;

require_once 'DBALConnectionTrait.php';

class DataProviderTest extends \Codeception\TestCase\Test
{
    use DBALConnectionTrait;

   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
        $this->dp = new DataProvider($this->getDBALConnectionMock());
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {

    }

}
