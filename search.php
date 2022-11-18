<?php
    
include 'functions.php'; 

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    
$records_per_page = 6;
//suite 01
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
if (isset($_GET['search']) && !empty($_GET['search'])) {
   $search = $_GET['search'];
   $_SESSION["research"] = $search;
} else {
    $search = ""; 
}
$mySearch = "%".$_SESSION["research"]."%";  

$stmt2 = $pdo->prepare('SELECT film.ID, title, name, actors, description 
                        FROM film, category 
                        WHERE film.category = category.ID 
                        AND title LIKE :search 
                        LIMIT :current_page, :record_per_page');
$stmt2->bindValue(':search', $mySearch, PDO::PARAM_STR);
$stmt2->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt2->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt2->execute();
// Fetch the records so we can display them in our template.
$searchfetch = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of films, this is so we can determine whether there should be a next and previous button
$num_films2 = $pdo->query('SELECT COUNT(*) FROM film')->fetchColumn();

module_header('Results');

?>

<div class="content films">
	<h2>Search results</h2>
    <a href="create.php" class="create-film">New film</a>
    <form action="search.php" method="GET">
   		<input type="search" name="search" value="<?=$_SESSION['research']?>">
   		<input type="submit" value="Research">
	</form>
	<table>
        <thead>
            <tr>
                <td>Title</td>
                <td>Category</td>
                <td>Actors</td>
                <td>Description</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($searchfetch as $s): ?>
            <tr>
                <td><a href="read.php?title=<?=$s['title']?>"><?=$s['title']?></a></td>
                <td><?=$s['name']?></td>
                <td><?=$s['actors']?></td>
                <td><?=$s['description']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$s['ID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$s['ID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="search.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_films2): ?>
		<a href="search.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=module_footer()?>