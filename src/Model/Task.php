
<?php
class Task {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Busca todas as tarefas
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Salva uma nova tarefa (agora com os campos do desafio!)
    public function save($title, $descript, $dueDate, $responsible) {
        if (empty(trim($title)) || empty(trim($dueDate)|| empty(trim($responsible)))) {
            throw new Exception("Título, Data e Responsável são obrigatórios.");
        }
       
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, due_date, responsible) VALUES (:title, :descript, :due_date, :responsible)");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':descript', $descript);
        $stmt->bindValue(':due_date', $dueDate);
        $stmt->bindValue(':responsible', $responsible);
        return $stmt->execute();
    }

    public function complete($id) {
        return $this->pdo->exec("UPDATE tasks SET done = 1 WHERE id = " . (int)$id);
    }

    public function delete($id) {
        return $this->pdo->exec("DELETE FROM tasks WHERE id = " . (int)$id);
    }
}
?>