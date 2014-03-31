<?php

class UserScholarshipControllerTest extends TestCase {

  // public function __construct()
  // {
  //     // We have no interest in testing Eloquent
  //     $this->mock = Mockery::mock('Eloquent', 'ScholarshipQuiz');
  // }

  // public function tearDown()
  // {
  //     Mockery::close();
  // }

  public function testIndex()
  {
      $this->call('GET', '/scholarship');
  }

}