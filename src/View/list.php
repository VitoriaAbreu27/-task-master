
<!DOCTYPE html>
<html lang="pt-BR">
<!-- ... (Mantenham a tag <head> e o CSS antigo aqui) ... -->
<body>
<div class="container">
    <h1>Task Master (MVC Edition)</h1>
   
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- O formulário agora aponta para a action 'create' -->
      <form method="POST" action="index.php" class="form-group">
        <input type="text" name="title" placeholder="O que precisa ser feito?" autocomplete="off">
        <input type="text" name="descript" placeholder="Descrição Opcional" autocomplete="off">
        <input type="date" name="due_date" placeholder="Data de Vencimento" autocomplete="off">
        <input type="text" name="responsable" placeholder="Responsável" autocomplete="off">
        <button type="submit">Adicionar</button>
    </form>

    <ul>
         <?php foreach ($tasks as $task): ?>
            <li class="<?php echo $task['done'] ? 'done' : ''; ?>">
                <span><?php echo htmlspecialchars($task['title']); ?></span> 
                 <?php if (!empty($task['discript'])): ?>
                    <span> - <?php echo htmlspecialchars($task['discript']); ?></span>
                <?php endif; ?>
                <small>Vencimento: <?php echo htmlspecialchars($task['due_date']); ?> | Responsável: <?php echo htmlspecialchars($task['responsible']); ?></small>
                
                 <div class="actions">
                    <?php if (!$task['done']): ?>
                        <a href="index.php?action=complete&id=<?php echo $task['id']; ?>">✅</a>
                    <?php endif; ?>
                    <a href="index.php?action=delete&id=<?php echo $task['id']; ?>">❌</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>