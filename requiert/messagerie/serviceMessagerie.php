<?php
	namespace ServiceMessagerie;

	class Messagerie
	{
		private $pdo = null;
		private $response = ['code' => 500, 'errors' => []];
		public function __construct($pdo)
		{
			$this->pdo = $pdo;
		}

		public function send($senderId, $recevorId, $box, $sujet = null, $discussionId = null)
		{
			$res = $this->response;
			
			if (!$box || empty($box)){$res['errors'][] = 'message';}
			if (!$senderId || empty($senderId)) {$res['errors'][] = 'senderId';}
			if (!$recevorId || empty($recevorId)) {$res['errors'][] = 'recevorId';}
			
			if (!count($res['errors'])) {
				
				$sender = $this->findUser($senderId);
				if (!$sender || !isset($sender['id'])) {$res['errors'][] = 'senderId';}

				$recevor = $this->findUser($recevorId);
				if (!$recevor || !isset($recevor['id'])) {$res['errors'][] = 'recevorId';}
				
				if (!$discussionId || empty($discussionId)) {
					
					$discussionId = null;
					if (!$sujet || empty($sujet)){$res['errors'][] = 'sujet';}
					else{
						$discussionId = $this->createNew($senderId, $recevorId,$sujet);
					}
				}
				
				if (!count($res['errors'])) {
					$discussion = $discussionId?$this->findDiscussion($discussionId):null;
					if (!$discussion) {$res['errors'][] = 'discussionId';}
				}
				
				if (!count($res['errors'])) {
					
					$id = $this->addNew($senderId, $recevorId,$box, $discussionId);
					if ($id && is_numeric($id)) {
						$res['code'] = 200;
						$res['data'] = [
							'discussion' => $discussionId,
							'message' => $id
						];
					}
				}
			}

			return $res;
		}

		private function addNew($senderId, $recevorId,$box, $discussionId)
		{
			$query = $this->pdo->prepare("INSERT INTO `messagerie` (`senderId`, `recevorId`,`boit_message_id`, `message`, `date`) VALUES (:senderId, :recevorId, :boxId, :boxContent, :boxTime)");
			$update = $this->pdo->prepare("UPDATE boitMessagerie SET lastBoxDate=:t WHERE id=:dsicID");
			
			$query->execute([ 'senderId' => $senderId, 'recevorId' => $recevorId, 'boxId' => $discussionId,  'boxContent' => $box,  'boxTime' => time()]);
			$id = $this->pdo->lastInsertId();

			$update->execute(['t' => time(), 'dsicID' => $discussionId]);

        	return $id;
		}

		public function list($userId)
		{
			$query = $this->pdo->prepare("SELECT BT.id, BT.lastBoxDate, BT.sujet_message, BT.senderId, BT.recevorId, CONCAT(RECEVOR.nom,' ', RECEVOR.prenom) as recevorName, CONCAT(SENDER.nom,' ', SENDER.prenom) as senderName FROM boitMessagerie AS BT INNER JOIN users AS SENDER ON SENDER.id = BT.senderId INNER JOIN users AS RECEVOR ON RECEVOR.id = BT.recevorId  WHERE (BT.senderId=:userID OR BT.recevorId=:userID) ORDER BY BT.lastBoxDate DESC");
			$query->execute(['userID' => $userId]);
			return $query->fetchAll();
		}

		public function discussion($userId, $discussionId)
		{
			$query = $this->pdo->prepare("SELECT MSG.id as msgId, MSG.senderId, MSG.recevorId, MSG.message, MSG.date, MSG.lu, CONCAT(RECEVOR.nom,' ', RECEVOR.prenom) as recevorName, CONCAT(SENDER.nom,' ', SENDER.prenom) as senderName FROM messagerie AS MSG LEFT JOIN boitMessagerie AS BT ON BT.id = MSG.boit_message_id LEFT JOIN users AS SENDER ON SENDER.id = BT.senderId LEFT JOIN users AS RECEVOR ON RECEVOR.id = BT.recevorId WHERE MSG.boit_message_id=:dsicID AND (MSG.senderId=:userID OR MSG.recevorId=:userID)  ORDER BY MSG.id");
			$query->execute(['userID' => $userId, 'dsicID' => $discussionId]);
			return $query->fetchAll();
		}

		public function createNew($senderId, $recevorId, $sujet)
		{
			$disc = $this->pdo->prepare("INSERT INTO `boitMessagerie` (`senderId`, `recevorId`, `sujet_message`, lastBoxDate)  VALUES (:senderId, :recevorId, :sujet, :t)");
			$disc->execute([ 'senderId' => $senderId,  'recevorId' => $recevorId,  'sujet' => $sujet, 't' => time()]);
        	return $this->pdo->lastInsertId();
		}
		
		public function markSee($userId, $discussionId)
		{
			$query = $this->pdo->prepare("UPDATE messagerie SET lu = '1' WHERE recevorId=:userID AND boit_message_id=:dsicID");
			$query->execute(['userID' => $userId, 'dsicID' => $discussionId]);
		}

		public function findDiscussion($id)
		{
			$user = $this->pdo->prepare("SELECT BM.*, U.nom, U.prenom FROM boitMessagerie BM INNER JOIN users U ON U.id = BM.senderId WHERE BM.id=? LIMIT 1");
			$user -> execute([$id]);
			return $user->fetch();
		}

		public function findUser($id)
		{
			$user = $this->pdo->prepare("SELECT * FROM users  WHERE id=? LIMIT 1");
			$user -> execute([$id]);
			return $user->fetch();
			
		}
	}
	
?>