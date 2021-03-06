<?php

function queryConversations ($id) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT * FROM `Conversation` WHERE idUser1 = :id1 OR idUser2 = :id2 ORDER BY id";

    $convs = array();

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id1', $id);
        $result->bindParam(':id2', $id);
        $result->execute();
        $convs = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $convs;
}

function queryConversation ($id) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT * FROM `Conversation` WHERE id = :id";

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $conv = $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conv = null;
    }

    return $conv;
}

function queryMessages($idConv) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT * FROM `MessageConv` WHERE idConv = :id ORDER BY dateMsg";

    $messages = array();

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $idConv);
        $result->execute();
        $messages = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $messages;
}

function getReports($filter) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT S.*, U1.pseudo AS 'reporter', U2.pseudo AS 'reported', R.role AS 'reportedRole'
            FROM Signalement S, Utilisateur U1, Utilisateur U2, Role R
            WHERE S.idSignaleur = U1.id 
            AND S.idSignalé = U2.id
            AND U2.idRole = R.id
            AND S.traité LIKE :filter
            GROUP BY S.id
            ORDER BY S.date DESC";

    $filter = "%$filter%";
    try {
        $result = $database->prepare($sql);
        $result->bindParam(':filter', $filter);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }

    return $user;
}

function getAllUsers($s) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT U.*, R.role 
            FROM Utilisateur U, Role R 
            WHERE U.idRole = R.id 
            AND (U.pseudo LIKE :s
            OR U.mail LIKE :s)
            GROUP BY U.id 
            ORDER BY U.pseudo";

    $s = "%$s%";
    try {
        $result = $database->prepare($sql);
        $result->bindParam(':s', $s);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }

    return $user;
}

function queryUser($id) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT U.*, R.role FROM Utilisateur U, Role R WHERE U.id = :id AND U.idRole = R.id GROUP BY U.id";

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }

    return $user;
}

/**
 * Insère dans la BD le message d'une conversation entre 2 personnes
 * @param $idUser
 * @param $idConv
 * @param $message
 */
function insertMessage($idUser, $idConv, $message){
    require(dirname(__FILE__) . '/database.php');
    $sql = "INSERT INTO MessageConv(idAuteur, idConv, content) VALUES (:idAuteur, :idConv, :msg)";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idConv', $idConv);
        $cde->bindParam(':msg', $message);
        $cde->bindParam(':idAuteur', $idUser);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'INSERT : " . $e->getMessage() . "\n");
        die();
    }
}

function insertReport ($idUser, $idReported, $page, $motif, $idTopic, $idPost) {
    $idTopic = $idTopic == -1 ? null : $idTopic;
    $idPost = $idPost == -1 ? null : $idPost;
    require(dirname(__FILE__) . '/database.php');
    $sql = "INSERT INTO `Signalement`(`idSignaleur`, `idSignalé`, `Origine`, `motif`, `idTopic`, `idPost`) 
            VALUES (:idUser, :idReported, :origine, :motif, :idTopic, :idPost)";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser', $idUser);
        $cde->bindParam(':idReported', $idReported);
        $cde->bindParam(':origine', $page);
        $cde->bindParam(':motif', $motif);
        $cde->bindParam(':idTopic', $idTopic);
        $cde->bindParam(':idPost', $idPost);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'INSERT : " . $e->getMessage() . "\n");
        die();
    }
}

function updateRole($idUser, $idRole){
    require(dirname(__FILE__) . '/database.php');
    $sql = "UPDATE Utilisateur SET idRole = :idRole WHERE id = :id";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idRole', $idRole);
        $cde->bindParam(':id', $idUser);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'UPDATE : " . $e->getMessage() . "\n");
        die();
    }
}

function queryBotQuestion($id) {
    $string = file_get_contents(dirname(__FILE__) . "/../Resources/json/bot.json");

    $json_a = json_decode($string, true);

    foreach ($json_a as $question) {
        if ($question['id'] == $id)
            return $question;
    }
    return null;
}


/**
 * Return la conversation associée à deux personnes et la crée si elle n'existe pas
 * @param $user1
 * @param $user2
 * @return mixed
 */
function getIdConv($user1, $user2){
    require(dirname(__FILE__) . '/database.php');
    if ($user1 > $user2){
        $user1 += $user2;
        $user2 = $user1 - $user2;
        $user1 -= $user2;
    }

    $sql = "SELECT id FROM Conversation WHERE idUser1 = :idUser1 AND idUser2 = :idUser2";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser1', $user1);
        $cde->bindParam(':idUser2', $user2);
        $cde->execute();
        $res = $cde->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo utf8_encode("Echec du SELECT : " . $e->getMessage() . "\n");
    }
    if (!$res)
    	return -1;
    
    return $res['id'];
}

/**
 * Crée une conversation entre deux utilisateurs
 * @param $user1
 * @param $user2
 * @return mixed
 */
function createConv($user1, $user2){
    require (dirname(__FILE__) . '/database.php');
    if ($user1 > $user2){
        $user1 += $user2;
        $user2 = $user1 - $user2;
        $user1 -= $user2;
    }
    $sql = "INSERT INTO Conversation(idUser1, idUser2) VALUES (:idUser1, :idUser2)";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser1', $user1);
        $cde->bindParam(':idUser2', $user2);
        $b = $cde->execute();
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
    return getIdConv($user1, $user2);
}

function setAsTraite ($id, $t) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Signalement
			SET traité = :t
			WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->bindParam (':t', $t);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function banUser ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Utilisateur
			SET idRole = 5
			WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function dropDemarche ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "DELETE FROM Demarche WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du DELETE : " . $e->getMessage() . "\n");
	}
}

function setAsAccepted ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Demarche SET isFinie = 1, isAcceptée = 1, isArchivée = 1 WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function setAsRefused ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Demarche SET isFinie = 1, isAcceptée = 0, isArchivée = 1 WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function setAsGivenUp ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Demarche SET isFinie = 0, isAcceptée = 0, isArchivée = 1 WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function setAsGiven ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Document SET isRendu = 1 WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function setAsNotGiven ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Document SET isRendu = 0 WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du UPDATE : " . $e->getMessage() . "\n");
	}
}

function newDocument ($id, $name, $rendu) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "INSERT INTO Document(idDem, libelle, isRendu) VALUES (:id, :name, :rendu)";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->bindParam (':name', $name);
		$req->bindParam (':rendu', $rendu);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
	}
}

function getDemarches($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "SELECT
					 Dem.*,
					 IF(
						  COUNT(Doc.id) <>(
						  SELECT
								COUNT(*)
						  FROM
								Document D
					 ),
					 COUNT(Doc.id),
					 0
					 ) AS 'manquants'
				FROM
					 Demarche Dem,
					 Document Doc
				WHERE
					 Dem.iduser = :id AND(
						  (
								Doc.iddem = Dem.id AND Doc.isrendu = 0
						  ) OR NOT EXISTS(
						  SELECT
								D.*
						  FROM
								Document D
						  WHERE
								D.iddem = Dem.id AND D.isRendu = 0
					 )
					 )
				GROUP BY
					 Dem.id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo utf8_encode ("Echec du SELECT" . $e->getMessage());
	}
	return array();
}

function getDemarche ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "SELECT *
			FROM Demarche
			WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo utf8_encode ("Echec du SELECT" . $e->getMessage());
	}
	return array();
}

function getDocuments ($id) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "SELECT *
			FROM Document
			WHERE idDem = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo utf8_encode ("Echec du SELECT" . $e->getMessage());
	}
	return array();
}

function updateRmq ($id, $rmq) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Demarche
			SET rmq = :rmq
			WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->bindParam (':rmq', $rmq);
		$req->execute();
	} catch (PDOException $e) {
		echo utf8_encode ("Echec du UPDATE" . $e->getMessage());
	}
}

function updateTxt ($id, $txt) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "UPDATE Post
			SET content = :txt,
			    modifie = 1
			WHERE id = :id";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->bindParam (':txt', $txt);
		$req->execute();
	} catch (PDOException $e) {
		echo utf8_encode ("Echec du UPDATE" . $e->getMessage());
	}
}

function getExperts () {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "SELECT id
			FROM Utilisateur
			WHERE idRole = 6";
	
	try {
		$req = $database->prepare($sql);
		$req->execute();
		return $req->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo $e->getMessage();
		return array();
	}
}

function getId($pseudo, $mail) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "SELECT id
			FROM Utilisateur
			WHERE UPPER(pseudo) = UPPER(:pseudo)
			AND UPPER(mail) = UPPER(:mail)";
	
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':pseudo', $pseudo);
		$req->bindParam(':mail', $mail);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC)['id'];
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
}

function createDemarche ($id, $name, $rmq) {
	require (dirname(__FILE__) . '/database.php');
	$sql = "INSERT INTO Demarche(libelle, idUser, rmq) VALUES (:name, :id, :rmq)";
	
	try {
		$req = $database->prepare ($sql);
		$req->bindParam (':id', $id);
		$req->bindParam (':name', $name);
		$req->bindParam (':rmq', $rmq);
		$req->execute ();
	} catch (PDOException $e) {
		echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
	}
}

function getDemarcheId($id, $name, $rmq) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "SELECT id
			FROM Demarche
			WHERE idUser = :id
			AND libelle = :name
			AND rmq = :rmq";
	
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':id', $id);
		$req->bindParam(':name', $name);
		$req->bindParam(':rmq', $rmq);
		$req->execute();
		return $req->fetch(PDO::FETCH_ASSOC)['id'];
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
}

function hideConv ($numUser, $idConv) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Conversation
			SET " . ($numUser == 1 ? "visible1" : "visible2") . " = 0
			WHERE id = :idConv";
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':idConv', $idConv);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

function setConvVisible ($numUser, $idConv) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Conversation
			SET " . ($numUser == 1 ? "visible1" : "visible2") . " = 1
			WHERE id = :idConv";
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':idConv', $idConv);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

function updatePseudo ($id, $pseudo) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Utilisateur
			SET pseudo = :pseudo
			WHERE id = :id";
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':id', $id);
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

function updateMail ($id, $mail) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Utilisateur
			SET mail = :mail
			WHERE id = :id";
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':id', $id);
		$req->bindParam(':mail', $mail);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

function updatePwd ($id, $pwd) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Utilisateur
			SET mdp = :pwd
			WHERE id = :id";
	$pwd = hash("sha256", $pwd);
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':id', $id);
		$req->bindParam(':pwd', $pwd);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}

function updateImg ($id, $img) {
	require (dirname(__FILE__) .  '/database.php');
	$sql = "UPDATE Utilisateur
			SET imageProfil = :img
			WHERE id = :id";
	
	try {
		$req = $database->prepare($sql);
		$req->bindParam(':id', $id);
		$req->bindParam(':img', $img);
		$req->execute();
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}