const valeurs = document.getElementById('valeurs');

if (valeurs) {
    valeurs.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-val btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/valeur/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}