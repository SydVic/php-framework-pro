<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\DBAL\Connection;

class PostRepository
{
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function findById(int $id): ?Post
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->select('id', 'title', 'body', 'created_at')
            ->from('posts')
            ->where('id = :id')
            ->setParameter('id', $id)
        ;

        $result = $queryBuilder->executeQuery();

        $row = $result->fetchAssociative();

        if (!$row) {
            return null;
        }

        $post = Post::create(
            title: $row['title'],
            body: $row['body'],
            id: $row['id'],
            createdAt: new \DateTimeImmutable($row['created_at'])
        );

        return $post;
    }
}