<?php

namespace LiveTest\Listener;

use Base\Http\Response;
use LiveTest\TestRun\Result\Result;

/**
 * This listener writes all specified html documents in to a defined directory. The 
 * listener creates a directory with the value of the runId within the log path.
 * 
 * @author Nils Langner
 */
class HtmlDocumentLog extends Base
{
  /**
   * The diretory were to log
   * @var string
   */
  private $logPath;

  /**
   * The result statuses to log
   * @var array
   */
  private $logStatuses = array();
  
  /**
   * This function initializes the log path and if given the log statuses
   * 
   * @param string $logPath
   * @param array $logStatuses
   */
  public function init( $logPath, array $logStatuses = null )
  {
    $this->logPath = $logPath . '/' . $this->getRunId() . '/';
    if (!file_exists($this->logPath))
    {
      mkdir($this->logPath);
    }
    
    if (!is_null($logStatuses))
    {
      $this->logStatuses = $logStatuses;
    }
    else
    {
      $this->logStatuses = array(Result::STATUS_ERROR,Result::STATUS_FAILED);
    }
  }
    

  /**
   * This function writes the html documents to a specified directory
   * 
   * @event LiveTest.Run.HandleResult
   */
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
    {
      $filename = $this->logPath . '/' . urlencode($result->getUrl());
      file_put_contents($filename, $response->getBody());
    }
  }
  
}