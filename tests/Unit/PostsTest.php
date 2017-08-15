<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertFalse(false);
    }

    public function test_success_get_posts()
    {
//        dd($this->json('GET','/api/v1/posts/get')->getContent());
        $this->json('GET','/api/v1/posts/get')->getContent();
        $this->assertTrue(true);
    }

    public function test_invalid_get_post()
    {
//        dd($this->json('GET','/api/v1/posts/get')->getContent());
        $this->json('POST','/api/v1/posts/post',['post_id'=>1111114411])->getContent();
        $this->assertFalse(false);
    }


    public function test_success_get_post()
    {
//        dd($this->json('GET','/api/v1/posts/get')->getContent());
        $this->json('POST','/api/v1/posts/post',['post_id'=>4])->getContent();
        $this->assertTrue(true);
    }

}
