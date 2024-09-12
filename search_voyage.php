<?php
$servername = "localhost";
$username = "root";
$password = "";
$search = isset($_GET['searchVoyage']) ? $_GET['searchVoyage'] : '';

if ($search) {
    $pdo = new PDO("mysql:host=$servername;dbname=baserh", $username, $password);
    $stmt = $pdo->prepare("SELECT Nom, Prenom, Fonction_Poste, service, matricule, interne, tel_direct, tel_mobile, lieu_travail, email FROM rh WHERE Nom LIKE :search OR Prenom LIKE :search2");
    $stmt->execute(['search' => "%$search%", 'search2' => "%$search%"]);
    $results = $stmt->fetchAll();
} else {
    $results = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md mt-4">
			<h1 class="text-2xl font-bold mb-4">Résultats de Recherche</h1>
			<a href="demande_voyage.php" class="text-blue-500 hover:underline">Nouvelle recherche</a>
			<div class="bg-white p-6 rounded-lg shadow-md mt-4">
				<?php if ($results): ?>
					<table class="table-auto">
						<thead>
							<tr>
								<th class="px-4 py-2">Nom</th>
								<th class="px-4 py-2">Prénom</th>
								<th class="px-4 py-2">Fonction Poste</th>
								<th class="px-4 py-2">Service</th>
								<th class="px-4 py-2">Matricule</th>
								<th class="px-4 py-2">Lieu de travail</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($results as $row): ?>
								<tr data-matricule="<?php echo htmlspecialchars($row['matricule']);?>" fonction="<?php echo htmlspecialchars($row['Fonction_Poste']);?>">
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['Nom']); ?></td>
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['Prenom']); ?></td>
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['Fonction_Poste']); ?></td>
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['service']); ?></td>
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['matricule']); ?></td>
									<td class="border px-4 py-2"><?php echo htmlspecialchars($row['lieu_travail']); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php else: ?>
					<p class="text-gray-700">Aucun utilisateur trouvé pour "<?php echo htmlspecialchars($search); ?>"</p>
				<?php endif; ?>
			</div>
        </div>
    </div>
<script>
	document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tr[data-matricule]');
            rows.forEach(row => {
             row.addEventListener('click', () => {
            const matricule = row.getAttribute('data-matricule');
            const fonction = row.getAttribute('fonction');
            window.location.href = `confirm_voyage.php?matricule=${encodeURIComponent(matricule)}&Fonction_poste=${encodeURIComponent(fonction)}`;
        });
        });
        });
</script>
</body>
</html>
