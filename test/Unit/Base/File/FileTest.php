<?php
namespace Unit\Base\File;

use Base\File\File;

/**
 * Test class for File.
 * Generated by PHPUnit on 2011-02-18 at 17:42:36.
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
  /**
   * @var File
   */
  protected $file;

  private $filename = 'tmp/mikelohmann/test.txt';

  private function getFilePath()
  {
    return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->filename;
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->file = new File($this->getFilePath());
    $this->file->create();
  }

  public function testIsWritable()
  {

    $this->assertTrue($this->file->isWritable());
    $tmpFile = new File('/tmp/mikelohmann/test1.txt');
    $this->assertFalse($tmpFile->isWritable());
  }

  public function testSave()
  {
    $this->file->setContent('testtesttest');
    $this->file->save();
    $this->assertFileExists($this->getFilePath());
    $this->assertEquals(file_get_contents($this->getFilePath()), 'testtesttest');
  }

  /**
   * @expectedException Base\File\Exception
   */
  public function testChangeFilePermissions()
  {
    $tmpFile = new File($this->getFilePath());
    $tmpFile->setFilePermission('hsdjd');

  }

  protected function tearDown()
  {
    $this->file->remove(true);
    rmdir(dirname($this->getFilePath()));
    rmdir(dirname(__FILE__) . '/tmp');
  }
}