const statMvt = document.getElementById('statMvt');

if (statMvt) {
    statMvt.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-stat btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/cnslt/mvt/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}