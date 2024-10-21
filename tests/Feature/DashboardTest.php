<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard()
    {
        // If the user is not logged in, they should be redirected to login
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard()
    {
        // Create a user instance
        $user = User::factory()->create();

        // Act as the created user
        $this->actingAs($user);

        // Perform the GET request to the dashboard
        $response = $this->get('/dashboard');

        // Assert the status is 200 (OK) and that the dashboard view is returned
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_dashboard_displays_user_reservations()
    {
        // Create a user
        $user = User::factory()->create();

        // Create lessons and reservations for the user
        $lesson = Lesson::factory()->create();
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
        ]);

        // Act as the created user
        $this->actingAs($user);

        // Perform the GET request to the dashboard
        $response = $this->get('/dashboard');

        // Assert that the response is OK and contains the reservations
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertSee($lesson->date);
        $response->assertSee($reservation->id);
    }
}

