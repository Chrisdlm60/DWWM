<?php
include 'functions.php';

// Get the film from the film table
if (isset($_GET['title'])) {
    $stmt = $pdo->prepare('SELECT * FROM film WHERE title = ?');
    $stmt->execute([$_GET['title']]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$film) {
        exit('Film doesn\'t exist with that title!');
    }
} else {
    exit('No ID specified!'); 
}
?>

<?=module_header($film['title'])?>

<div class="content read">
	<h2>Film "<?=$film['title']?>"</h2>
    <form>
    
        <label for="id" hidden>ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" hidden>

        <label for="title">Title</label>
        <input type="text" name="title" value="<?=$film['title']?>" id="title" readonly>

        <label for="category">category</label>
        <input type="text" name="category" value="<?=$film['category']?>" id="category" readonly>

        <label for="actors">actors</label>
        <input type="text" name="actors" value="<?=$film['actors']?>" id="actors" readonly>

        <label for="description">description film</label>
        <input type="text" name="description" value="<?=$film['description']?>" id="description" readonly>

    </form>
</div>

<?=module_footer()?>