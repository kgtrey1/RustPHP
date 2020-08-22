<?php
	//2/10/2018
	class Social_manager
	{
		private $db;
		private $id;
		private $content;
		private $link;

		public function edit_social($id, $link, $content)
		{
			require_once($_SERVER["DOCUMENT_ROOT"] . "/config/session.php");

            if (user_is_connected() AND user_is_admin())
            {
                $this->init_db();
                $this->id = htmlspecialchars($id);
                $this->link = htmlspecialchars($link);
                $this->content = htmlspecialchars($content);
                $query = $this->db->prepare('UPDATE rp_social SET link = :link, content = :content WHERE id = :id');
                $query->execute(array('id' => (int)$this->id, 'link' => $this->link, 'content' => $this->content));
                $this->db = $query = NULL;
            }
            else
            {
                die();
            }
		}

		public function get_social($id)
		{
			$this->init_db();
			$this->id = htmlspecialchars($id);
			$query = $this->db->prepare("SELECT * FROM rp_social WHERE id = :id");
			$query->execute(array('id' => (int)$this->id));
			$result = $query->fetch();
			$query->closeCursor();
			$this->content = htmlspecialchars($result['content']);
			$this->link = htmlspecialchars($result['link']);
			$this->db = $query = NULL;
			return (array('id' => $this->id, 'content' => $this->content, 'link' => $this->link));
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