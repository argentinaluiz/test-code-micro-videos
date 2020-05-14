<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    //use DatabaseMigrations;
    private $category;

    // Executado uma vez por classe de teste
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    // Executado a cada método de teste
    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    // Executado a cada método de teste
    protected function tearDown(): void
    {
        parent::tearDown();
    }

    // Executado uma vez por classe de teste
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    public function testFillable()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable,$this->category->getFillable());        
    }

    public function testIfUseTraits()
    {
        //Genre::create(['name' => 'test']);

        // print_r(class_uses(Category::class));
        // print_r("Fim");
        $traits = [
            SoftDeletes::class, Uuid::class
        ];
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        //print_r($category->getDates());
        //print_r($dates);
        //dd($category->getDates(), $dates);
        //$this->assertEquals($dates,$category->getDates());        

        foreach ($dates as $date){
            $this->assertContains($date, $this->category->getDates());
        }
        $this->assertCount(count($dates), $this->category->getDates());
    }

    public function testCasts()
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts,$this->category->getCasts());        
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->category->incrementing);
    }
}
