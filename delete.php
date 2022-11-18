<?php
include 'functions.php';

$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM film WHERE ID = ?');
    $stmt->execute([$_GET['id']]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$film) {
        exit('Film doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM film WHERE ID = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the film!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: film.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=module_header('Delete')?>

<div class="content delete">
	<h2>Delete Film "<?=$film['title']?>"</h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<span id="alert">Are you sure you want to delete film "<?=$film['title']?>"?</span>
    <div class="yesno">
        <a href="delete.php?id=<?=$film['ID']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$film['ID']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=module_footer()?>