<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_contact_form_is_accessible(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('contact.index'));

        $response->assertStatus(200);
        $response->assertViewIs('contact.contact_form');
    }

    public function test_contact_form_submission_sends_email(): void
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        Mail::fake();

        $response = $this->post(route('contact.store'), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'content' => 'This is a test message.',
        ]);

        Mail::assertSent(ContactMail::class, function ($mail) {
            $mail->build();

            return $mail->hasTo('my@mail.com') &&
                $mail->replyTo[0]['address'] === 'john.doe@example.com' &&
                $mail->subject === 'New mail';
        });

        $response->assertStatus(302);

        $response->assertRedirect(route('movies.index'));
    }
}
