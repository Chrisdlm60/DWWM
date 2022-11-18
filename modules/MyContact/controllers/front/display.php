{extends file='page.tpl'}
 
{block name="page_content"}
<p>Salut tout le monde les gens !</p>
<form action="" method="post">
    <div class="row">
        <div class="col">
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom.." required>
        </div>
        <div class="col">
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom.." required>
        </div>
    </div>
    <div class="form-group">
        <label for="societe">Societe : </label>
        <input type="text" class="form-control" name="societe" id="societe" placeholder="Societe.." required>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse : </label>
        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse.." required>
    </div>
    <div class="form-group">
        <label for="phone">Telephone : </label>
        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Telephone.." pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required>
        <small>Format : 0303033330</small>
    </div>
    <div class="form-group">
        <label for="mail">Mail :</label>
        <input type="email" class="form-control" name="mail" id="mail" placeholder="Mail.." required>
    </div>
    <div class="form-group">
        <label for="Installation">Installation sur : </label>
        <select class="form-control" name="choix" id="choix" required>
            <option selected>Choix...</option>
            <option value="droit">Mur Droit</option>
            <option value="angle">Angle mur</option>
        </select>
    </div>
    <div class="form-group">
        <label for="bouteille">Nombre de bouteilles :</label>
        <input type="number" class="form-control" name="bouteille" id="bouteille" min="1" placeholder="Nombre de bouteilles souhaitées.." required>
    </div>
    <div class="form-group">
        <label for="saveur">Nombre de saveurs :</label>
        <input type="number" class="form-control" name="saveurs" id="saveurs" min="1" placeholder="Nombre de saveurs souhaitées.." required>
    </div>
    <button id="submit" name="submit" type="submit" class="btn btn-primary">Envoyer</button>
    <small>Vous recevrez un mail récapitulatif de votre devis</small>
</form>
{/block}