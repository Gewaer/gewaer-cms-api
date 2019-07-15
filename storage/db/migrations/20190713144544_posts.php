<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Posts extends AbstractMigration
{
    public function change()
    {
        /**
         * Posts
         */
        $table = $this->table('posts', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('author', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('post_types_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'author'])
            ->addColumn('games_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'post_types_id'])
            ->addColumn('title', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'games_id'])
            ->addColumn('summary', 'text', ['null' => false, 'limit' => MysqlAdapter::TEXT_REGULAR,'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'title'])
            ->addColumn('content', 'text', ['null' => false, 'limit' => MysqlAdapter::TEXT_MEDIUM,'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'summary'])
            ->addColumn('media_url', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'content'])
            ->addColumn('likes_count', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'media_url'])
            ->addColumn('shares_count', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'likes_count'])
            ->addColumn('views_count', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'shares_count'])
            ->addColumn('is_published', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'views_count'])
            ->addColumn('published_at', 'datetime', ['null' => false, 'after' => 'is_published'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'published_at'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
        /**
         * Posts Types
         */
        $table = $this->table('posts_types', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('title', 'string', ['null' => false, 'limit' => 32, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'title'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
        /**
         * Tags
         */
        $table = $this->table('tags', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('title', 'string', ['null' => false, 'limit' => 32, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'id'])
            ->addColumn('slug', 'string', ['null' => false, 'limit' => 32, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'title'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'slug'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Posts Tags
         */
        $table = $this->table('posts_tags', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('posts_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('tags_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'posts_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'tags_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
        /**
         * Posts Likes
         */
        $table = $this->table('posts_likes', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('posts_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('users_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'posts_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'users_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
        /**
         * Posts Shares
         */
        $table = $this->table('posts_shares', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('posts_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('users_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'posts_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'users_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
    }
}
