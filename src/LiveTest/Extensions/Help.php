<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;

use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class Help implements Extension
{
  private $arguments;
  
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
    $this->arguments = $arguments;
  }
  
  public function preRun(Properties $properties)
  {
    if (array_key_exists('help', $this->arguments))
    {
      var_dump( '--help' );
      return false;
    }
    return true;
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
  }
  
  public function handleResult(Result $result, Response $response)
  {
  }
  
  public function postRun(Information $information)
  {
  }
}