<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\User;
use App\Thread;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;

class CreateThreadTest extends TestCase
{
    public function test_that_a_guest_cannot_create_a_new_thread()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $thread = make(Thread::class);

        $this->post('/threads', $thread->toArray());

        // $this->get($thread->path())
        //     ->assertSee($thread->title)
        //     ->assertSee($thread->body);
    }

    public function test_that_an_authenticated_user_can_create_a_new_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_that_a_guest_cannot_see_the_create_thread_page()
    {
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }
}
