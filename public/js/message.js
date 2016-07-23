/**
 * Created by Iván on 5/07/2016.
 */
    function message(description) {
        var $result =
            '<div id="mensaje" class="modal fade" role="dialog">'
                +'<div class="modal-dialog modal-sm">'
                   +'<div class="modal-content">'
                        + '<div class="modal-header text-center bg-success">'
                            + '<span class="fa fa-check-circle fa-3x" style="color: white;"></span>'
                            + '<button class="close" onclick="closeModal()"><span aria-hidden="true">&times;</span></button>'
                        + '</div>'
                        +'<div class="modal-body">'
                            + '<div class="text-center">'
                                + '<strong><h3 class="modal-title text-success"> Hola</h3></strong>'
                                + '<p class="text-capitalize">'+ description +'</p>'
                            + '</div>'
                        + '</div>'
                   +'</div>'
                +'</div>'
            +'</div>';
        $('#mensaje').replaceWith($result);
        $('#mensaje').modal('show');
    }
function closeModal() {
    $('#mensaje').modal('hide').on('hidden.bs.modal');
    $('.modal-backdrop').remove();
    var $result = '<div id="mensaje"/>';
    $('#mensaje').replaceWith($result);
}