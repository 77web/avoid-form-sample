<?php

namespace Sample\AvoidForm;

use Sample\AvoidForm\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AvoidForm
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function handleRequest(Request $request)
    {
        // Requestの値をデータにセットする
        $post = new Post();
        $post
            ->setTitle($request->get('title'))
            ->setBody($request->get('body'))
            ->setPublishedAt(new \DateTime($request->get('published_at', 'now'))) // 場合によってはRequestの値そのままでなく適切な形式に変換する
        ;

        // データを検証する
        $violations = $this->validator->validate($post);
        if (count($violations) == 0) {
            // 検証OK：データを何か処理する（DBに保存するとか）
            return $post;
        }

        // 検証エラー：エラー情報を返す
        return $violations;
    }
}
