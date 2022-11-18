<?php
include "functions.php";

module_header("film");

// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 6;

$stmt = $pdo->prepare("SELECT film.ID, title, name, actors, description FROM film, category WHERE film.category = category.ID ORDER BY film.ID LIMIT :current_page, :record_per_page");
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
//Fetch the result
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
//suite02
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_films = $pdo->query('SELECT COUNT(*) FROM film')->fetchColumn();
?>

<div class="content films">
    <div class="body-header">
        <a href="create.php" class="create-film" id="newfilm">New film</a>

        <div id="researchbytitle">
            <form action="search.php" method="GET">
                <input type="search" name="search" placeholder="Research by title.." id="research" />
                <input type="submit" value="Research" />
            </form>
        </div>
    </div>
   <!-- <form action="categorie.php" method="GET">
                    <h>Research By Category</h>
   					<input type="search" name="search" placeholder="Recherche par Catégorie" />
   					<input type="submit" value="Valider" />
				</form> -->
	<table>
        <thead>
            <tr>
                <td>Title</td>
                <td>Category</td>
                <td>Actors</td>
                <td>Description</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($films as $films): ?>
            <tr>
                <td><a href="read.php?title=<?=$films['title']?>"><?=$films['title']?></a></td>
                <td><?=$films['name']?></td>
                <td><?=$films['actors']?></td>
                <td><?=$films['description']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$films['ID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$films['ID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="film.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_films): ?>
		<a href="film.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<!-- <div1 class="contente read">
<form action="categorie.php" method="GET">
                    <h>Research By Category</h>
   					<input type="search" name="search" placeholder="Recherche par Catégorie" />
   					<input type="submit" value="Valider" />
				</form>
</div1> -->

<?php
module_footer();