<?php

declare(strict_types=1);

namespace App\State;

use App\ApiResource\Comment;
use App\Service\CommentService;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

/**
 * @implements ProviderInterface<Comment>
 */
class CommentsProvider implements ProviderInterface
{
    public function __construct(
        private CommentService $service,
    ) {
    }

    /**
     * @param Operation $operation
     * @param string[] $uriVariables
     * @param string[][] $context
     * @return Comment
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Comment
    {
        $slug = $uriVariables['slug'];
        $result = new Comment();
        $result->slug = $slug;
        $result->comments = $this->service->getArticleComments($slug);
        return $result;
    }
}
