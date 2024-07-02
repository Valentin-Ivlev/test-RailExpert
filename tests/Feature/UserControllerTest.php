<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_list_has_non_empty_skills()
    {
        // Создаем несколько пользователей
        User::factory()->count(5)->create();

        $response = $this->get('/api/users');

        $response->assertStatus(200);

        $users = $response->json();

        $this->assertNotEmpty($users);

        $expectedSkills = ['PHP', 'JS', 'Golang', 'Java'];

        foreach ($users as $user) {
            $this->assertNotEmpty($user['description']);

            $hasExpectedSkill = false;
            foreach ($expectedSkills as $skill) {
                if (strpos($user['description'], $skill) !== false) {
                    $hasExpectedSkill = true;
                    break;
                }
            }

            $this->assertTrue($hasExpectedSkill, "User description does not contain any expected skills: {$user['description']}");
        }
    }
}
