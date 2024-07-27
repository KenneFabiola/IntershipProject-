<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'tcpdf' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
if(isset($_GET['paymentId'])) {
    $paymentId = $_GET['paymentId'];
    $registration_id = $_GET['registrationId'];
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $program = $_GET['program'];
    $levelName = $_GET['levelName'];
    $amount = $_GET['amount'];
    $created_at = $_GET['createdAt'];

    // echo $firstName;
 
$receipt = new TCPDF();

// configuration du  pdf
$receipt->setCreator('fichiertest');
$receipt->setAuthor('Fabiola');
$receipt->setTitle('reçu de payment des étudiants');

// ajout d'une nouvelle page pour le recu de payment
$receipt->addPage();

// police du document
// $receipt->setFont('Heleveticat', 'B',16);

// contenu de la page dans le pdf
$html = '
    <h1 style = "align-items:center">Reçu de paiement</h1>
    <p>Nom Etudiant: ' .$firstName . ' </p>
    <p>Prenom Etudiant: ' .$lastName .'</p>
    <p>Filière: ' .$program .'</p>
    <p>Niveau: ' .$levelName .'</p>
    <p>Montant versé: ' .$amount .'</p>
    <p>Date de paiment: ' .$created_at .'</p>

    
    
  

';


// fonction pour ecrire du contenu Html dans le fichier pdf
// true indique que le contenu html doit être analyser
// false, car aucune image n'est integré à partir de l'url,
// true, indique que le contenu est intégré dans un tableau, ce qui est important pour la mise en forme du pdf
// false, pour eviter que tcpdf choisissent le mode de remplissage
// encodage des caractéres, tcpdf va choisit la façon de le faire
$receipt->writeHTML($html,true,false,true,false,'');

// envoyé le document pdf au navigateur
// mode d'affichage du pdf I
$receipt->Output('reçu.pdf','I');

}else{
    echo "L'id du payement n'a pas été trouvé";
}

?>

<!-- </div>
     <p>Nom Etudiant:
      <div style="border-bottom: 2px solid gray; width: 5px; margin-top: 5px;">
       <span style="font-weight: bold;">' . $firstName . '</span></p>
    </div>  
    <table>
    <thead>
        <tr>
            <th style= "background-color:blue">Nom Etudiant</th>
            <th style= "background-color:blue">Prenom Etudiant</th>
            <th style= "background-color:blue">Filière</th>
            <th style= "background-color:blue">Niveau</th>
            <th style= "background-color:blue">Montant versé</th>
            <th style= "background-color:blue">Date de paiement</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>'. $firstName .'</td>
            <td>' .$lastName .'</td>
            <td>' .$program .'</td>
            <td>' .$levelName .'</td>
            <td>' .$amount .'</td>
            <td>' .$created_at .'</td>
        </tr>
    </tbody>
</table> -->