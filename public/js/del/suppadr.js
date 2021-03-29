const adhrents = document.getElementById('adhrents');

if (adhrents) {
    adhrents.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-adhrent btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/adherent/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}