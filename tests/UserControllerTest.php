<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    /**
     * Test Auth user profile data
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 10,
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }

    public function testStoreSuccessWithStringScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'A',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }

    public function testStoreSuccessWithBScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'B',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }

    public function testStoreSuccessWithCScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'C',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }
    public function testStoreSuccessWithDScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'D',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }
    public function testStoreSuccessWithEScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'E',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }
    public function testStoreSuccessWithFScore()
    {
        $data = [
            "name" => "TienTTT",
            "email" => "tien.tran3@monstar-lab.com",
            "score" => 'F',
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'insert success',
            ]);
    }
    public function testStoreFail()
    {
        $data = [
            "name" => "TienTTT",
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => null,
                'message' => 'insert fail',
            ]);
    }

    public function testShowSuccess()
    {
        $id = 1;
        $user = User::find($id);
        $response = $this->json('GET', '/api/users/'.$id);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => $user,
                'message' => 'success',
            ]);
    }
    public function testShowNull()
    {
        $response = $this->json('GET', '/api/users/999999');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => null,
                'message' => 'success',
            ]);
    }
    public function testUpdateDataNotFound()
    {
        $id = 1111;
        $params = [
            'name' => 'Test update'
        ];
        $response = $this->json('PUT', '/api/users/'.$id, $params);

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => null,
                'message' => 'data not found',
            ]);
    }
    public function testUpdateSuccess()
    {
        $user = $this->createData();

        $id = $user->id;
        $params = [
            'name_user' => 'Test update'
        ];
        $response = $this->json('PUT', '/api/users/'.$id, $params);
        $response->assertStatus(200)
            ->assertExactJson([
                'data' => true,
                'message' => 'updated',
            ]);
    }
    public function testIndexSuccess()
    {
        $this->createData();
        $users = User::get();

        $response = $this->json('GET', '/api/users');
        $response->assertStatus(200)
            ->assertExactJson([
                'data' => $users->toArray()
            ]);
    }

//    public function testDestroySuccess()
//    {
//        $user = $this->createData();
//        $response = $this->json('DELETE', '/api/users/'.$user->id);
//        $response->assertStatus(200)
//            ->assertExactJson([
//                'message' => 'deleted',
//            ]);
//    }
    public function createData()
    {
        $user = new User();
        $user->name = 'name1';
        $user->password = '123456789';
        $user->score = '6';
        $user->email = 'test@gmail.com';
        $user->ranking = null;
        $user->remember_token = null;
        $user->email_verified_at = null;
        $user->save();

        return $user;
    }
}
