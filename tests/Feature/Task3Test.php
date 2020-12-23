<?php

namespace Tests\Feature;

use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Tests\TestCase;

class Task3Test extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected $modelFields = [
        "name",
        "address",
        "card_code"
    ];
    protected $modelClass = Employer::class;
    protected $modelPluralName = "employers";
    protected $modelSingleName = "employer";


    /* Checks json model updating */
    public function testUpdateOk()
    {
        $model = Employer::factory()->create();
        $data = Employer::factory()->make([
            'name' => 'test name',
            'address' => 'test address',
            'card_code' => 'test card code',
        ])->toArray();
        $routeName = $this->modelPluralName . ".update";
        $response = $this->putJson(route($routeName, [$this->modelSingleName => $model->id]), $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data' => $this->modelFields]);
        $response->assertJsonFragment($data);
    }
    /* Checks json model updating validation */
    public function testUpdateError()
    {
        $model = Employer::factory()->create();
        $routeName = $this->modelPluralName . ".update";
        $response = $this->putJson(route($routeName, [$this->modelSingleName => $model->id]), []);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['message', 'errors' => $this->modelFields]);
    }

    /* Checks json model showing */
    public function testShow()
    {
        $model = Employer::factory()->create();
        $routeName = $this->modelPluralName . ".show";
        $response = $this->getJson(route($routeName, [$this->modelSingleName => $model->id]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data' => $this->modelFields]);
    }

    /* Checks json model showing error */
    public function testShowError()
    {
        $routeName = $this->modelPluralName . ".show";
        $response = $this->getJson(route($routeName, [$this->modelSingleName => 1]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(['message' => "Not found"]);
    }

    /* Checks json model deleting error*/
    public function testDeleteError()
    {
        $routeName = $this->modelPluralName . ".destroy";
        $response = $this->deleteJson(route($routeName, [$this->modelSingleName => 1]));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(['message' => "Not found"]);
    }

    /* Checks json model deleting */
    public function testDelete()
    {
        $model = Employer::factory()->create();
        $routeName = $this->modelPluralName . ".destroy";
        $response = $this->deleteJson(route($routeName, [$this->modelSingleName => $model->id]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => $this->modelFields
        ]);
    }
}
