<?php


namespace App\tests\core;

use PHPUnit\Framework\TestCase;
use App\core\App;
use App\controllers\BookController;
use App\controllers\Page404;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class TestApp extends TestCase
{
    public function testParseUrl()
    {
        define('ROOT', 'http://books-crud.test/');
        define('ROOT_PATH', "C:\laragon\www\books-crud\/");

        $app = new App();
        $method = $this->getPrivateMethod('App\core\App', 'parseURL');

        $_GET['url'] = "book/index";
        $result = $method->invoke($app);
        $this->assertSame($result, ["book", "index"]);

        $_GET['url'] = "category/add";
        $result = $method->invoke($app);
        $this->assertSame($result, ["category", "add"]);

        $_GET['url'] = "book/edit/10";
        $result = $method->invoke($app);
        $this->assertSame($result, ["book", "edit", "10"]);

        unset($_GET['url']);
        $result = $method->invoke($app);
        $this->assertSame($result, ["book"]);
    }

    public function testControllerExists()
    {
        $app = new App();

        $_GET['url'] = "book/index";
        $bookController = new BookController();
        $method = $this->getPrivateMethod('App\core\App', 'getController');

        $_GET['url'] = "book/index";
        $url = ['book'];
        $result = $method->invokeArgs($app, [$url]);
        $this->assertEquals($result, $bookController);

        $property = $this->getPrivateProperty('App\core\App', 'controller');
        $result = $property->getValue($app);

        $this->assertEquals($bookController, $result);
    }


    public function testControllerDoesntExist()
    {
        $app = new App();
        $page404 = new Page404();
        $method = $this->getPrivateMethod('App\core\App', 'getController');
        $url = ['movies'];
        $result = $method->invokeArgs($app, [$url]);
        $this->assertEquals($page404, $result);

        
    }


    /**
     * getPrivateMethod
     *
     * @param  string $className
     * @param  string $methodName
     * @return ReflectionMethod
     */
    private function getPrivateMethod(string $className, string $methodName): ReflectionMethod
    {
        $reflector = new ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }


    /**
     * getPrivateProperty
     *
     * @param  mixed $className
     * @param  mixed $propertyName
     * @return ReflectionProperty
     */
    private function getPrivateProperty(string $className, string $propertyName): ReflectionProperty
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }
}
