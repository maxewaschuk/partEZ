<?php

use App\Poll;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PollTest extends TestCase
{

    use DatabaseMigrations;

    public function startup()
    {
        $this->seed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /*
     * input
     * retrieve
     * update
     * delete
     */

    public function testInputPoll()
    {
        // make sure the seeds work
        $all_polls = Poll::all();
        $this->assertNotNull($all_polls);
    }

    public function testRetrievePoll()
    {
        //Poll::create(array('eid'=>'1', 'polltype'=>'test_type'));
        $this->startup();

        $poll = new Poll;
        $poll->eid = '1';
        $poll->polltype = 'test_type';

        $poll->save();


        $this->seeInDatabase('polls', array('polltype'=>'test_type'));
    }

    public function testUpdatePoll()
    {
        $this->startup();

        $poll = Poll::create(array('eid'=>'1', 'polltype'=>'test_type'));

        $poll->polltype = 'some_other_type';

        $this->seeInDatabase('polls', array('polltype'=>'some_other_type'));
    }

    public function testDeletePoll()
    {
        $this->startup();
        
        $poll = Poll::create(array('eid'=>'1', 'polltype'=>'delete_me'));

        $poll->delete();

        $this->notSeeInDatabase('polls', array('polltype'=>'delete_me'));
    }
}
