var idModal = 1;

function openModal(titre)
{


  var html = '<div id="modal'+idModal+'" role="dialog" aria-hidden="true" class="modal fade" style="display: none;">\n' +
    '                    <div class="modal-dialog modal-md modal-dialog-centered">\n' +
    '                        <div tabindex="-1" class="modal-content">\n' +
    '                            <header class="modal-header"><h5 class="modal-title">\n' +
    '                                    '+ titre +'</h5>\n' +
    '                                <button type="button" data-dismiss="modal" class="close">×</button>\n' +
    '                            </header>\n' +
    '                            <div class="modal-body"><p class="my-4"></p></div>\n' +
    '                            <footer class="modal-footer">\n' +
    '                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>\n' +
    '                            </footer>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                </div>';


}