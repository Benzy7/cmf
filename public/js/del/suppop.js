const operation = document.getElementById('operation');

if (operation) {
    operation.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-codeop btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/codeop/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}