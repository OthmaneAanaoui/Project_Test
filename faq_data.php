<?php
// Récupérer la valeur de recherche de la requête AJAX
$searchValue = $_GET['search'];

// Lire le fichier JSON contenant les données de la FAQ
$data = file_get_contents('./questions.json');
$faqData = json_decode($data, true);

$html = '';

// Parcourir chaque catégorie de la FAQ
foreach ($faqData as $faq) {
    $faqCategory = $faq['category-name'];
    $questions = $faq['lesQuestions'];

    $html .= '<div class="faq-category"><h2>' . $faqCategory . '</h2>';
    
    // Parcourir chaque question dans la catégorie
    foreach ($questions as $question) {
        $questionText = $question['question'];
        $answerText = $question['reponse'];

        // Vérifier si la valeur de recherche correspond au texte de la question ou de la réponse
        if (empty($searchValue) || stristr($questionText, $searchValue) !== false || stristr($answerText, $searchValue) !== false) {
            $html .= '<ul>';
            $html .= '<li>';
            $html .= '<p class="question">' . $questionText . '</p>';
            $html .= '<div class="answer"><p>' . $answerText . '</p></div>';
            $html .= '</li>';
            $html .= '</ul>';
        }
    }

    $html .= '</div>';
}

// Afficher le code HTML généré
echo $html;
?>
