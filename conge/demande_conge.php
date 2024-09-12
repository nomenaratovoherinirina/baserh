<?php 
$servername = "localhost";
$username = "root";
$password = "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$matricule =  isset($_POST['matricule']) ? trim($_POST['matricule']) : '';

if(empty($matricule)){
    header("Location: /baseRH/conge/index.php");
    exit();
}else{
    try {
        $connexion = new PDO("mysql:host=$servername;dbname=baserh", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $connexion->prepare("SELECT Nom, Prenom, Fonction_Poste, service, matricule, interne, tel_direct, tel_mobile, lieu_travail, email FROM rh WHERE matricule = $matricule ");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Demande de congé</title>
</head>
<body>
    <nav class="bg-gray-100 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a class="navbar-brand">
            <img src="../plg.png" alt="Logo" class="max-w-20">
            </a>
            <button class="text-white focus:outline-none md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            </button>
        </div>
    </nav>
    <div class="flex justify-center items-center ml-16">
        <aside class="w-64 flex flex-col">
            <nav class="flex-1">
                <ul class="">
                    <li class="hover:bg-red-700 hover:text-white rounded-lg bg-red-500 text-white mt-3"><a href="demande_abs.php?matricule=<?php echo htmlspecialchars($data['matricule'])?>" class="block p-3">Nouvelle Demande d'abssence</a></li>
                    <li class="hover:bg-gray-700 hover:text-white rounded-lg bg-gray-400 text-white mt-3"><a href="demande_del.php?matricule=<?php echo htmlspecialchars($data['matricule'])?>" class="block p-3">Nouvelle Demande d'abssence(délégation)</a></li>
                </ul>
                <div class="mt-5">
                    <h4 class="rounded-lg bg-red-500 text-white text-center mt-4 p-1">Visualisation</h4>
                    <ul class="ml-2">
                        <li class="p-2"><a href="#" class="text-blue-600 underline">Demandes en attente</a></li>
                        <li class="p-2"><a href="#" class="text-blue-600 underline">Demandes de congés</a></li>
                        <li class="p-2"><a href="#" class="text-blue-600 underline">Nombres de jours pris</a></li>
                        <li class="p-2"><a href="#" class="text-blue-600 underline">Agenda Général</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="flex-1 p-4">
                <h3 class="text-2xl font-bold ml-2">Demande d'abscence</h3>
                <div class="w-3/3 flex justify-between items-center bg-white rounded-lg shadow-md w-full max-w-md mt-3">
                    <table class="m-3">
                    <tbody>
                        <tr>
                            <td class="font-bold">Demandeur :</td>
                            <td class="py-2 px-4 "><?php echo $data['Nom'].' '.$data['Prenom'];?></td>
                        </tr>
                        <tr>
                            <td class="font-bold">Service :</td>
                            <td class="py-2 px-4 "><?php echo $data['service'];?></td>
                        </tr>
                        <tr>
                            <td class="font-bold">Fonction :</td>
                            <td class="py-2 px-4 "><?php echo $data['Fonction_Poste'];?></td>
                        </tr>
                        <tr>
                            <td class="font-bold">Matricule :</td>
                            <td class="py-2 px-4 "><?php echo $data['matricule'];?></td>
                        </tr>
                            </tbody>
                    </table>
                </div>      
        </main>
    </div>
<script>
    
</script>
</body>
</html>