<?php
    class News_manager
    {
        private $id;
        private $author;
        private $date;
        private $summary;
        private $content;
        private $db;

        public function get_news($title)
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            if (user_is_connected() AND user_is_admin())
            {
                $this->init_db();
                $query = $this->db->prepare('SELECT * FROM rp_news WHERE title = :title');
                $query->execute(array('title' => htmlspecialchars($title)));
                $result = $query->fetch();
                $query->closeCursor();
                $this->id = htmlspecialchars($result['id']);
                $this->title = htmlspecialchars($result['title']);
                $this->summary = htmlspecialchars($result['summary']);
                $this->content = htmlspecialchars($result['content']);
                $this->db = $query = NULL;
                $news = array('id' => $this->id, 'title' => $this->title, 'summary' => $this->summary, 'content' => $this->content);
                return $news;
            }
            else
            {
                die();
            }
        }

        public function get_latests_news()
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            $this->init_db();
            $query = $this->db->prepare('SELECT * FROM rp_news ORDER BY id DESC LIMIT 0,2');
            $query->execute();
            $it = 1;
            while ($result = $query->fetch())
            {
                $news[$it]['author'] = htmlspecialchars($result['author']);
                $news[$it]['date'] = htmlspecialchars($result['datte']);
                $news[$it]['title'] = htmlspecialchars($result['title']);
                $news[$it]['summary'] = htmlspecialchars($result['summary']);
                $news[$it]['content'] = htmlspecialchars($result['content']);
                $it = $it + 1;
            }
            $query->closeCursor();  
            $this->db = $query = NULL;
            return $news;
        }

        public function get_all_news_title()
        {
            $this->init_db();
            $query = $this->db->prepare('SELECT title FROM rp_news ORDER BY id DESC');
            $query->execute();
            $it = 0;
            while($result = $query->fetch())
            {
                $news_list[$it]['title'] = $result['title'];
                $it = $it + 1;
            }
            $query->closeCursor();
            $this->db = $query = NULL;
            return $news_list;
        }

        public function add_news($author, $title, $summary, $content)
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            if (user_is_connected() AND user_is_admin())
            {
                $this->init_db();
                $this->author = htmlspecialchars($author);
                $this->date = date("d") . "/" . date("m") . "/" . date("Y");
                $this->title = htmlspecialchars($title);
                $this->summary = htmlspecialchars($summary);
                $this->content = htmlspecialchars($content);
                $query = $this->db->prepare('INSERT INTO rp_news(author, datte, title, summary, content) VALUES(:author, :datte, :title, :summary, :content)');
                $query->execute(array('author' => $this->author, 'datte' => $this->date, 'title' => $this->title, 'summary' => $this->summary, 'content' => $this->content));
                $this->db = $query = NULL;
            }
            else
            {
                die();
            }
        }

        public function edit_news($id, $title, $summary, $content)
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            if (user_is_connected() AND user_is_admin())
            {
                $this->init_db();
                $this->id = htmlspecialchars($id);
                $this->title = htmlspecialchars($title);
                $this->summary = htmlspecialchars($summary);
                $this->content = htmlspecialchars($content);
                $query = $this->db->prepare('UPDATE rp_news SET title = :title, summary = :summary , content = :content WHERE id = :id');
                $query->execute(array('id' => (int)$this->id, 'title' => $this->title, 'summary' => $this->summary, 'content' => $this->content));
                $this->db = $query = NULL;
            }
            else
            {
                die();
            }
        }

        public function delete_news_by_title($title)
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            if (user_is_connected() AND user_is_admin())
            {
                $this->init_db();
                $this->title = htmlspecialchars($title);
                $query = $this->db->prepare("DELETE FROM rp_news WHERE title = :title");
                $query->execute(array('title' => $this->title));
                $this->db = $query = NULL;
            }
            else
            {
                die();
            }
        }

        public function news_to_html($content)
        {
            require_once($_SERVER["DOCUMENT_ROOT"] . "/class/bbcode.class.php");
            require_once($_SERVER["DOCUMENT_ROOT"] . "/class/tag.class.php");


            $bbcode = new ChrisKonnertz\BBCode\BBCode();
            $rendered = $bbcode->render($content);
            return $rendered;
        }

        private function init_db()
        {
            require($_SERVER["DOCUMENT_ROOT"] . "/config/config.php");

            try
            {
                $this->db = new PDO($db_host, $db_user, $db_pass);
            }
            catch (Exception $e)
            {
                die ('Erreur : ' . $e->getMessage());
            }
        }
    }
?>