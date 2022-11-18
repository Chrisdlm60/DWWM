<?php 
include 'functions.php';

$msg = '';
// Check if the film id exists, for example update.php?id=1 will get the film with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $actors = isset($_POST['actors']) ? $_POST['actors'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE films SET ID = ?, title = ?, category = ?, actors = ?, description = ? WHERE ID = ?');
        $stmt->execute([$_GET['id'], $title, $category, $actors, $description, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the film from the film table
    $stmt = $pdo->prepare('SELECT * FROM film WHERE ID = ?');
    $stmt->execute([$_GET['id']]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$film) {
        exit('Film doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=module_header('Update')?>

<div class="content update">
	<h2>Update Film "<?=$film['title']?>"</h2>
    <form action="update.php?id=<?=$film['id']?>" method="post">
    
        <label for="id" hidden>ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" hidden>

        <label for="title">Title</label>
        <input type="text" name="title" value="<?=$film['title']?>" id="title">

        <label for="category">category</label>
        <input type="text" name="category" value="<?=$film['category']?>" id="category">

        <label for="actors">actors</label>
        <input type="text" name="actors" value="<?=$film['actors']?>" id="actors">

        <label for="description">description film</label>
        <input type="text" name="description" value="<?=$film['description']?>" id="description">

        <input type="submit" value="Create">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=module_footer()?>