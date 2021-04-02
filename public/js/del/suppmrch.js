const marches = document.getElementById('marches');

if (marches) {
    marches.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-cpt btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/marchec/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}