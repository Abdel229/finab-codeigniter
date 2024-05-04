<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Form</title>
</head>
<body>
    <form id="galleryForm" action="<?php echo base_url('/galleries/store'); ?>" method="post" enctype="multipart/form-data">
        <button type="button" onclick="addInput()">Ajouter un champ</button>
        <button type="button" onclick="removeInput()">Supprimer le dernier champ</button>
        <div id="inputsContainer">
            <!-- Les champs d'entrée seront ajoutés ici dynamiquement -->
        </div>
        <label for="">catégories</label>
        <select name="category" id="category">
            <option value="">Sélectionnez une catégorie</option>
            <?php foreach ($gallerycategory as $category) : ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Enregistrer</button>
    </form>

    <script>
        function addInput() {
            var container = document.getElementById("inputsContainer");
            var input = document.createElement("input");
            input.type = "file";
            input.name = "photos[]";
            container.appendChild(input);
        }

        function removeInput() {
            var container = document.getElementById("inputsContainer");
            var inputs = container.getElementsByTagName("input");
            if (inputs.length > 0) {
                container.removeChild(inputs[inputs.length - 1]);
            }
        }
    </script>
</body>
</html>
