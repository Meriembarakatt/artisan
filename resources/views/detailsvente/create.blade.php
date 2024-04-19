<form id="formAjoutdetail">
    @csrf <!-- Pour Laravel, si vous utilisez des formulaires Blade -->
    <div class="form-group">
            <label for="article_id">Article</label>
            <select class="form-control" id="article_id" name="article_id" required>
                @foreach ($articles as $article)
                    <option value="{{ $article->id }}">{{ $article->designation}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="vente_id">Date détail Vente</label>
            <input type="date" class="form-control" id="vente_id" name="vente_id" required>
            <!-- Ce champ sera automatiquement mis à jour par JavaScript -->
        </div>
        <div class="form-group">
            <label for="qte">Quantité</label>
            <input type="text" class="form-control" id="qte" name="qte" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
        </div>
    <button type="button" onclick="ajouterdetail()" class="btn btn-primary">Ajouter ajouterdetail</button>
</form>
<table id="tabledetail" border=2>
    <thead>
        <tr>
                 <th>Article</th>
                <th>Vente</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Actions</th>
        </tr>
    </thead>
    <tbody id="tbodydetail">
        <!-- Les lignes d'articles seront ajoutées ici dynamiquement -->
    </tbody>
</table>

<button type="button" onclick="enregistrerEnregistrements()" class="btn btn-primary">Enregistrer table</button>


<script>
    function updateDetailDate() {
        var venteDate = document.getElementById('date').value;
        document.getElementById('vente_id').value = venteDate;
    }

    function ajouterdetail() {
        var article = document.getElementById('article_id').value;
        var vente = document.getElementById('vente_id').value;
        var quantite = document.getElementById('qte').value;
        var prix = document.getElementById('prix').value;

        // Créer une nouvelle ligne dans le tableau
        var tbody = document.getElementById('tbodydetail');
        var newRow = tbody.insertRow();

        // Insérer les cellules dans la nouvelle ligne
        var cellArticle = newRow.insertCell();
        cellArticle.innerText = article;

        var cellVente = newRow.insertCell();
        cellVente.innerText = vente;

        var cellQuantite = newRow.insertCell();
        cellQuantite.innerText = quantite;

        var cellPrix = newRow.insertCell();
        cellPrix.innerText = prix;

        // Réinitialiser le formulaire après l'ajout
        document.getElementById('formAjoutdetail').reset();
    }


</script>
