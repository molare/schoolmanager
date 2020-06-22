/**
 * Created by olivier on 23/03/2020.
 */

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function showAddToast() {
        /*Toast.fire({
            type: 'success',
            title: 'enregistrement de donnee avec succes.'
        })*/
        toastr.success('Les données ont été ajouté avec succes.');
    };

function showUpdateToast() {
    /*Toast.fire({
        type: 'success',
        title: 'Modification de donnee avec succes.',
    })*/
    toastr.success('La ligne a été modifié avec succes.');
};

function showDeleteToast() {
    /*Toast.fire({
        type: 'success',
        title: 'Suppression de donnee avec succes.'
    })*/
    toastr.success('La ligne a été supprimé avec succes.');
};
function showErrorToast() {
/*Toast.fire({
    type: 'error',
    title: 'Impossible d\'effectuer cette action car une erreur est survenu.'
})*/
    toastr.error('Impossible d\'effectuer cette action car une erreur est survenu.');
};
