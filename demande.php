<?php
$servername = "localhost";
$username = "root";
$password = "";
    try {
        $connexion = new PDO("mysql:host=$servername;dbname=baserh", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connexion->prepare("SELECT Nom, Prenom, Fonction_Poste, service, matricule, interne, tel_direct, tel_mobile, lieu_travail, email FROM rh ORDER BY Nom ");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Demande de voyage</title>
</head>
<style>
.ask_quit{
    height:200px;
    width:300px;
    border-radius:10px;
    border: 2px gray solid;
    padding: 5px;
}
.cursor{
    cursor: pointer;
}
.mt-16{
    margin-top: 100px;
}
</style>
<body class="bg-gray-100">
    <div class="fixed top-0 left-0 right-0 bg-gray-200 p-4 z-50">
        <div class="container mx-auto flex items-center space-x-2">
        <a class="navbar-brand">
            <img src="plg.png" alt="Logo" class="max-w-20">
        </a>
        <div class="">
                    <form action="search_voyage.php?" >
                        <div class="">
                            <input type="search" name="searchVoyage" id="" placeholder="Rechercher par Nom ou Prenom" class="p-2 rounded-lg">
                            <button type="submit" class="rounded-lg bg-gray-500 text-white p-2">Recherche</button>
                        </div>
                    </form>
        </div>
        </div>
    </div>
    <div class="mt-16">
            <h2 class="text-2xl font-bold text-center">Demande d'accord préalable à un voyage/mission</h2>
            <div class="">
                <div class="">
                    <h3 class="text-xl font-bold mt-3">Demandeur</h3>
                    <p class="italic text-green-500 mt-2">Choisir le nom de la personne qui doit voyager.</p>
                </div>
            </div>
        </div>
    <div class="">
    <div class="search_name mt-4 ">
        <table class="table-auto min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-500 text-white">
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Fonction Poste</th>
                    <th>Service</th>
                    <th>Matricule</th>
                    <th>Lieu de Travail</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>      
                <?php
                    foreach ($rows as $row) {
                        echo "<tr data-matricule='" . htmlspecialchars($row['matricule'] ?? '', ENT_QUOTES) . "'fonction='".htmlspecialchars($row['Fonction_Poste']?? '',ENT_QUOTES)."'>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['Nom'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['Prenom'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['Fonction_Poste'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['service'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['matricule'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['lieu_travail'] ?? '', ENT_QUOTES) . "</td>";
                        echo "<td class='border py-3 px-4 cursor'>" . htmlspecialchars($row['email'] ?? '', ENT_QUOTES) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="fixed bottom-4 right-4" >
        <a href="menu.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="askQuit()"> 
        ← Retour au menu
        </a>
    </div>
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>Copyright &copy 2024</p>
    </footer>
    <script>
    // Afficher les recherches apres l'evenemment click 
        document.addEventListener('DOMContentLoaded', () => {
    // Sélectionner toutes les lignes du tableau
            const rows = document.querySelectorAll('tr[data-matricule]');

    // Ajouter un gestionnaire d'événements pour chaque ligne
            rows.forEach(row => {
             row.addEventListener('click', () => {
            // Récupérer le matricule depuis l'attribut data
            const matricule = row.getAttribute('data-matricule');
            const fonction = row.getAttribute('fonction');
            // Rediriger vers une autre page en utilisant le matricule dans l'URL
            window.location.href = `confirm_voyage.php?matricule=${encodeURIComponent(matricule)}&Fonction_poste=${encodeURIComponent(fonction)}`;
        });
        });
        });

    </script>
</body>
</html>