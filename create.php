<?php
include 'functions.php';

$msg = '';
// verifier les champs
if (!empty($_POST)) {
    // Poster les champs
    // objet POST existe t'il?
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $actors = isset($_POST['actors']) ? $_POST['actors'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO film VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $title, $category, $actors, $description]);
    // Output message
    $msg = 'Created Successfully!';
}

module_header('Create');
?>
<div class="content create">
	<h2>Create Movie : 
        <br> Category 1 : Action 
        <br> Category 2 : War 
        <br> Category 3 : Comedy 
        <br> Category 4 : Thriller 
        <br> Category 5 : Science fiction
        <br> Category 6 : Drama </h2>
    <form action="create.php" method="post">

        <label for="id" hidden>ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" hidden>

        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title">

        <label for="category">category</label>
        <input type="text" name="category" placeholder="Category" id="category">

        <label for="actors">actors</label>
        <input type="text" name="actors" placeholder="actors seperate with ','" id="actors">

        <label for="description">description film</label>
        <input type="text" name="description" placeholder="" id="description">

        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<?=module_footer();?>