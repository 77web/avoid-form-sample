<?php

namespace Sample\AvoidForm;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sample\AvoidForm\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class AvoidFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AvoidForm
     */
    private $target;

    public function setUp()
    {
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->target = new AvoidForm($validator);
    }

    /**
     * @test
     * @param array $postValues
     * @dataProvider provideValidData
     */
    public function handleRequest_成功(array $postValues)
    {
        $request = new Request([], $postValues);

        $data = $this->target->handleRequest($request);

        $this->assertInstanceOf(Post::class, $data);
    }

    public function provideValidData()
    {
        return [
            '全項目揃っている' => [[
                'title' => 'test title',
                'body' => 'test body',
                'published_at' => '2016-01-15',
            ]],
            'bodyは空でも良い' => [[
                'title' => 'test title',
                'body' => 'test body',
                'published_at' => '2016-01-15',
            ]],
            'published_atも空でも良い(デフォルト値が入る)' => [[
                'title' => 'test title',
                'body' => 'test body',
                'published_at' => '',
            ]]
        ];
    }

    /**
     * @test
     * @param array $postValues
     * @dataProvider provideInvalidData
     */
    public function handleRequest_失敗(array $postValues)
    {
        $request = new Request([], $postValues);

        $data = $this->target->handleRequest($request);

        $this->assertNotInstanceOf(Post::class, $data);
        $this->assertInstanceOf(ConstraintViolationListInterface::class, $data);
        $this->assertCount(1, $data);
    }

    public function provideInvalidData()
    {
        return [
            'タイトル抜け' => [[
                'title' => '',
                'body' => 'test body',
                'published_at' => '2016-01-15',
            ]],
        ];
    }
}
