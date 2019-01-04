<?php

use yii\db\Migration;

/**
 * Class m190104_011712_init_db
 */
class m190104_011712_init_db extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $sql = "
            CREATE TABLE IF NOT EXISTS `account` (
                `id` int(11) NOT NULL,
                `username` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `role` enum('Author','Admin') DEFAULT NULL,
                `password` varchar(255) NOT NULL,
                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            --
            -- Dumping data for table `account`
            --

            INSERT INTO `account` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
            (1, 'Fatah', 'fatah@gmail.com', 'Admin', 'super', '2018-01-08 05:52:58', '2018-01-08 05:52:58');

            -- --------------------------------------------------------

            --
            -- Table structure for table `post`
            --

            CREATE TABLE IF NOT EXISTS `post` (
                `id` int(11) NOT NULL,
                `user_id` int(11) DEFAULT NULL,
                `title` varchar(255) NOT NULL,
                `slug` varchar(255) NOT NULL,
                `views` int(11) NOT NULL DEFAULT '0',
                `image` varchar(255) NOT NULL,
                `body` text NOT NULL,
                `published` tinyint(1) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            --
            -- Dumping data for table `post`
            --

            INSERT INTO `post` (`id`, `user_id`, `title`, `slug`, `views`, `image`, `body`, `published`, `created_at`, `updated_at`) VALUES
                (1, 1, '5 Habits that can improve your life', '5-habits-that-can-improve-your-life', 0, 'banner.jpg', 'Read every day', 1, '2018-02-03 00:58:02', '2018-02-01 12:14:31'),
                (2, 1, 'Second post on LifeBlog', 'second-post-on-lifeblog', 0, 'banner.jpg', 'This is the body of the second post on this site', 0, '2018-02-02 04:40:14', '2018-02-01 06:04:36');

            -- --------------------------------------------------------

            --
            -- Table structure for table `post_topic`
            --

            CREATE TABLE IF NOT EXISTS `post_topic` (
                `id` int(11) NOT NULL,
                `post_id` int(11) DEFAULT NULL,
                `topic_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            --
            -- Dumping data for table `post_topic`
            --

            INSERT INTO `post_topic` (`id`, `post_id`, `topic_id`) VALUES
            (1, 1, 1),
            (2, 2, 2);

            -- --------------------------------------------------------

            --
            -- Table structure for table `topic`
            --

            CREATE TABLE IF NOT EXISTS `topic` (
                `id` int(11) NOT NULL,
                `name` varchar(255) DEFAULT NULL,
                `slug` varchar(255) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            --
            -- Dumping data for table `topic`
            --

            INSERT INTO `topic` (`id`, `name`, `slug`) VALUES
            (1, 'Inspiration', 'inspiration'),
            (2, 'Motivation', 'motivation'),
            (3, 'Diary', 'diary');

            --
            -- Indexes for dumped tables
            --

            --
            -- Indexes for table `account`
            --
            ALTER TABLE `account`
            ADD PRIMARY KEY (`id`);

            --
            -- Indexes for table `post`
            --
            ALTER TABLE `post`
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `slug` (`slug`),
            ADD KEY `user_id` (`user_id`);

            --
            -- Indexes for table `post_topic`
            --
            ALTER TABLE `post_topic`
            ADD PRIMARY KEY (`id`),
            ADD KEY `fk_post_idx` (`post_id`),
            ADD KEY `fk_topic_idx` (`topic_id`);

            --
            -- Indexes for table `topic`
            --
            ALTER TABLE `topic`
            ADD PRIMARY KEY (`id`),
            ADD UNIQUE KEY `slug_UNIQUE` (`slug`);

            --
            -- AUTO_INCREMENT for dumped tables
            --

            --
            -- AUTO_INCREMENT for table `account`
            --
            ALTER TABLE `account`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- AUTO_INCREMENT for table `post`
            --
            ALTER TABLE `post`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

            --
            -- Constraints for dumped tables
            --

            --
            -- Constraints for table `post`
            --
            ALTER TABLE `post`
            ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

            --
            -- Constraints for table `post_topic`
            --
            ALTER TABLE `post_topic`
            ADD CONSTRAINT `fk_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
            ADD CONSTRAINT `fk_topic` FOREIGN KEY (`topic_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
            COMMIT;";
        
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m190104_011712_init_db cannot be reverted.\n";

        return false;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m190104_011712_init_db cannot be reverted.\n";

      return false;
      }
     */
}
