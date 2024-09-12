<?php 
$servername = "localhost";
$username = "root";
$password = "";
$matricule =  isset($_GET['matricule']) ? trim($_GET['matricule']) : '';

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
    <title>Nouvelle demande abscence</title>
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
    <div class="flex justify-center items-center ml-2">
        <aside class="flex flex-col">
            <nav class="flex-1">
                <ul class="">
                    <li class="hover:bg-red-700 hover:text-white rounded-lg bg-red-500 text-white mt-3"><a href="#" class="block p-3">Nouvelle Demande d'abssence</a></li>
                    <li class="hover:bg-gray-900 hover:text-white rounded-lg bg-gray-700 text-white mt-3"><a href="demande_del.php?matricule=<?php echo htmlspecialchars($data['matricule'])?>" class="block p-3">Nouvelle Demande d'abssence(délégation)</a></li>
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
        <main class="flex-1 p-2">
                <h3 class="text-2xl font-bold ml-3">Demande d'abscence</h3>
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
                <div class="w-3/3 justify-between items-center bg-white rounded-lg shadow-md w-full mt-4">
                    <h4 class="text-xl font-bold ml-2"> Motif :</h4>
                    <p class="text-blue-500 p-2">Suivant article 16 de la convention collective: Dans la limite de 10 jours par an , tout salarié a droit , sur justification aux 
                        permissions exceptionnelles payées. Ces permissions sont decomptées en jours calendaires et doivent être pris concomitamment à l'évènement déclencheur.
                    </p>
                    <form>
                            <div class="m-5 pb-8">
                                <div>
                                    <label class=" items-center">
                                        <input type="radio" name="option" value="option1" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés payés</span>
                                    </label>
                                </div>
                                <div>
                                    <label class=" items-center">
                                        <input type="radio" name="option" value="option2" class="form-radio text-blue-500">
                                        <span class="ml-2">Récupération d'heures</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Abscence non rémunérée</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Repos maladie</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés de maternité ( 98 jours dont 42 jours avt DPA et 56 jours aprs ACC )</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Mariage travailleur (4 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Mariages collatéraux (1 jour)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Mariage enfant légitime (2 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Décés Conjoit(e) (4 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Décés enfant légitime (4 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Décés parents ou beau-parents (4 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Décés frère, souer ou beau-frère, belle-soeur (2 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Exhumation Conjoint(e) (3 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Exhumation enfant légitime (3 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Exhumation parents ou beau-parents (2 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Exhumation frère, soeur ou beau frère, belle-soeur (2 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Circoncision enfant légitime (2 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Naissance enfant légitime (3 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Hospitalisation conjoint(e) (dans la limite de 10 jours)</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="items-center">
                                        <input type="radio" name="option" value="option3" class="form-radio text-blue-500">
                                        <span class="ml-2">Congés Exceptionnels - Hospitalisation enfant légitime (dans la limite des 10 jours)</span>
                                    </label>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="w-3/3 justify-between items-center bg-white rounded-lg shadow-md w-full mt-4 pb-5">
                    <h4 class="text-xl font-bold ml-2">Durée de l'abscence :</h4>
                    <div class="m-3">
                        <span>Sollicite une autorisation de</span>
                        <input type="number" name="njours" id="" class="bg-gray-300 p-1 rounded-lg" placeholder="nombre de jours ici">
                        <span>jour(s) ouvré(s). (working days)</span>
                    </div>
                    <div class="flex">
                        <div class="ml-2">
                            <span>Du</span>
                            <input type="date" name="debuAbs" id="" class="bg-gray-300 p-1 rounded-lg">
                        </div>
                        <div class="ml-2">
                            <span>Au</span>
                            <input type="date" name="finAbs" id="" class="bg-gray-300 p-1 rounded-lg">
                        </div>
                        <div class="ml-2">
                            <span>Reprise le</span>
                            <input type="date" name="reprise" id="" class="bg-gray-300 p-1 rounded-lg">
                        </div>
                    </div>
                    <p class="text-blue-500 p-2 mt-5">Veuillez préciser l'abscence en cas de journée incomplete.</p>
                    <div class="ml-4">
                        <div class="flex">
                            <label class="items-center">
                                <input type="radio" name="option" value="matin" class="form-radio text-blue-500">
                                <span class="ml-2">Matin</span>
                            </label>
                        </div>
                        <div class="flex">
                            <label class="items-center">
                                <input type="radio" name="option" value="aprem" class="form-radio text-blue-500">
                                <span class="ml-2">Après-midi</span>
                            </label>
                        </div>
                        <div class="">
                            <button class="bg-blue-400 rounded-lg text-white p-2">Effacer</button>
                        </div>
                    </div>
                </div> 
                <div class="w-3/3 justify-between items-center bg-white rounded-lg shadow-md w-full mt-4 pb-5">
                    <h4 class="text-xl font-bold ml-2">Remarque :</h4>
                    <textarea name="remarque" id="" cols="30" rows="4" class="bg-gray-300 p-1 rounded-lg ml-2"></textarea>
                </div>
                <div class="w-3/3 justify-between items-center bg-white rounded-lg shadow-md w-full mt-4 pb-5">
                    <h4 class="text-xl font-bold ml-2">Pièce Jointe :</h4>
                    <input type="file" name="pieceJoin" id="" class="ml-2">
                </div>   
        </main>
    </div>
</body>
</html>