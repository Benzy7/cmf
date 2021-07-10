const typeValeurs = document.getElementById('typeValeurs');

if (typeValeurs) {
    typeValeurs.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-tval btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/typevaleur/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}