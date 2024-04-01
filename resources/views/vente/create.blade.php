{{-- resources/views/ventes/create.blade.php --}}

<div class="container">
    <h1>Ajouter une Vente</h1>
    <form action="{{ route('vente.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date vente</label>
            <input type="date" class="form-control" id="date" name="date" required onchange="updateDetailDate()">
            <!-- Ajoutez l'événement onchange pour appeler la fonction JavaScript lorsqu'une date est sélectionnée -->
        </div>
        <div class="form-group">
            <label for="client_id">Client</label>
            <select class="form-control" id="client_id" name="client_id" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }}</option>
                @endforeach
            </select>
        </div>
        <!-- Ajoutez d'autres champs si nécessaire -->

        <button type="submit" class="btn btn-primary">Ajouter Vente</button>
    </form>
</div>

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
<table id="tabledetail">
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

<button type="button" onclick="enregistrerEnregistrements()" class="btn btn-primary">Enregistrer Enregistrements</button>


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


    function enregistrerEnregistrements() {
    var tableRows = document.querySelectorAll('#tabledetail tbody tr');
    var data = [];

    tableRows.forEach(function(row) {
        var cells = row.querySelectorAll('td');
        var enregistrement = {
            article: cells[0].innerText,
            vente: cells[1].innerText,
            quantite: cells[2].innerText,
            prix: cells[3].innerText
        };
        data.push(enregistrement);
    });

    // Envoi des données au serveur
    fetch('{{ route("vente.detail.bulkstore") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Gérer la réponse du serveur si nécessaire
        alert('Enregistrements sauvegardés avec succès !');
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur s\'est produite lors de l\'enregistrement des enregistrements');
    });
}

</script>
