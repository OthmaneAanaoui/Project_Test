$(document).ready(function() {
    // Lorsque l'utilisateur tape dans le champ de recherche
    $('#searchInput').keyup(function() {
        var searchValue = $(this).val().toLowerCase();
        filterQuestions(searchValue);
    });

    // Lorsque l'utilisateur clique sur une question
    $(document).on('click', '.question', function() {
        $(this).next('.answer').slideToggle();
    });

    // Fonction pour filtrer les questions
    function filterQuestions(searchValue) {
        $.ajax({
            url: 'faq_data.php',
            type: 'GET',
            dataType: 'html',
            data: { search: searchValue },
            success: function(response) {
                $('#faqContainer').html(response);
            },
            error: function() {
                $('#faqContainer').html('<p>Erreur lors de la récupération des données de la FAQ.</p>');
            }
        });
    }

    filterQuestions(''); // Charger toutes les questions initialement
});
